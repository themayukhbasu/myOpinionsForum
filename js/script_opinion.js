$(document).ready(function(){ 

  var flag = 1;
  post_id = post_id;
  $.ajaxCallPostById = function(id,flag){
    
    if (flag==0) return;
    $.when($.ajax({
      url: './api/api-post-title-pull.php',
      type: "POST",
        dataType: "json",
        data: { 
          id:id
        },
      success: function(dat){

        if (dat === 0) {flag = 0;} //this is a hackish way, if db pull fails, 0 is being returned
        else{
          var form_id = "reply_form"+dat.data_id;          
          var fromNow = moment(dat.timestamp).fromNow();
          var html = '<div class="row"><div class="col col-lg-12 col-md-12"><div class="card border-primary">'+
              '<div class="card-body">'+
              '<h4 class="card-title text-primary">'+dat.title+'</h4>'+
              '<div class="row">'+
              '<div class="col"><h6 class="card-subtitle mb-2 text-muted small">posted by <strong>'+dat.user_name+'</strong></h6></div>'+
              '<div class="col offset-6"><h6 class="card-subtitle mb-2 text-muted small"><i class="fa fa-clock-o"></i>&nbsp;<em>'+fromNow+'</em></h6></div>'+
              '</div>'+
              '<hr>'+
              '<p class="card-text">'+dat.data+'</p>'+
              '<hr>'+
              '<button type="button" data-form-id="'+form_id+'" data-data-id='+dat.data_id+' title="Reply" class="btn btn-outline-primary btn-sm" id="reply_link"><i class="fa fa-reply" aria-hidden="true"></i> Reply</button>'+
              '<form action="./api/api-reply-post.php" method="POST" class="reply_form" id="'+form_id+'"></form></div></div>'+
              '</div></div></div></div>';
          $('#main').append(html);
          if (dat.num_child > 0) {
            
            $.ajaxCallReply(dat.data_id,0,flag,'#reply',"");
          }
        }
      }
    }));
  }; 

  $.ajaxCallPostById(post_id,flag);

  $.ajaxCallReply = function(parent_id,i,flag,div,tabbing) {
    /*
      - parent_id - the id for which the replies are being searched
      - i - counter for recursion
      - flag - acts as the error checking or dummy variable
      - div - id of the division where the reply html will be appended

      function does a recursive DFS search for the discussion tree
    */
    var sort = 0;
    if (flag==0) return;
    $.when($.ajax({
      url: './api/api-post-reply-pull.php',
      type: "POST",
        dataType: "json",
        data: { 
          parent_id: parent_id,
          offset: i,
          sort:sort
        },
      success: function(dat){
        if (dat === 0) {flag = 0;} //this is a hackish way, if db pull fails, 0 is being returned
        else{ 
          var next_id = dat.data_id; 
          var form_id = "reply_form"+dat.data_id;        
          var next_div = "reply" + dat.data_id; // div_id works as the id of the division of a specific reply
          var fromNow = moment(dat.timestamp).fromNow(); 
          if (dat.moderation == 0 || dat.moderation == -1){                       
            var html = '<div class="row"><div class="col col-lg-12 col-md-12"><div class="card bg-light reply '+tabbing+'" id="'+next_div+'">'+
                        '<div class="card-body"><p>'+dat.data+'</p>'+
                        '<hr><div class="row">'+
                        '<div class="col"><p class="text-muted small">posted '+fromNow+' by <strong>'+dat.user_name+'</strong></p></div>'+
                        '</div>'+
                        '<button type="button" data-form-id="'+form_id+'" data-data-id='+dat.data_id+' title="Reply" class="btn btn-outline-primary btn-sm" id="reply_link"><i class="fa fa-reply" aria-hidden="true"></i> Reply</button>'+                        
                        '<form action="./api/api-reply-post.php" method="POST" class="reply_form" id="'+form_id+'"></form>'+
                        '</div></div></div></div>';
          }
          else{
            var html = '<div class="row"><div class="col col-lg-12 col-md-12"><div class="card bg-light reply '+tabbing+'" id="'+next_div+'">'+
                        '<div class="card-body"><p class="mark">Comment has been removed due to moderation</p>'+ 
                        '<div class="row"><div class="col"><p class="text-muted small">posted '+fromNow+' by <strong>'+dat.user_name+'</strong></p></div></div>'+                    
                        '</div></div></div></div>';
          }
          $(div).append(html);
          if (dat.num_child > 0) {            
            next_div = "#"+next_div;
            $.ajaxCallReply(next_id,0,1,next_div,"ml-5");
            
          }
        }
      }
    })).done(function() {
      $.ajaxCallReply(parent_id,i + 1,flag,div,"");
    });

  };

  
  $(document).on("click",'#reply_link', function(){
      /* Dynamically Binded Click Trigger */
   
      var form_id = $(this).attr('data-form-id');
      var data_id = $(this).attr('data-data-id');
      form_id = "#"+form_id;
      var html = '<textarea class="form-control" id="post_input" name="reply_input" rows="2" required></textarea>';
      html += '<input type="hidden" value='+data_id+' name="parent_id" />';
      html += '<input type="hidden" value='+post_id+' name="post_id" />';
      html += '<button type="submit" class="btn btn-primary btn-sm" id="post_submit">Reply</button>';
      $(this).hide();
      $(form_id).append(html);
      return false;
  });

  $(document).on("click",'#post_submit', function(){
          if ($('#post_input').val() == "" || $('#post_input').val() == null) {
            alert('All fields are required');
          }
        });
  $.post("./py/run_classifier.php");
})