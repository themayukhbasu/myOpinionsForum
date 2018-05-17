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
          var html = "<div class='card text-primary'><div class=\"card-header\">"+dat.title+"</div> <div class='card-body'><p class='card-text'>"+dat.data+"</p></div>";
          html += '<div class="card-footer">'+dat.user_name;
          html += '<button type="button" data-form-id="'+form_id+'" data-data-id='+dat.data_id+' class="btn btn-light btn-sm" id="reply_link">Reply</button>';
          html += '<form style="display:none;" action="./api/api-reply-post.php" method="POST" class="reply_form" id="'+form_id+'"></form></div></div>';
          $('#main').append(html);
          if (dat.num_child > 0) {

            $.ajaxCallReply(dat.data_id,0,flag,'#reply');
          }
        }
      }
    }));
  }; 

  $.ajaxCallPostById(post_id,flag);

  $.ajaxCallReply = function(parent_id,i,flag,div) {
    alert("DEBUG: parent_id "+parent_id);
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
          var next_div = "#reply" + dat.data_id; // div_id works as the id of the division of a specific reply
          var html = "<div class='reply' id='"+next_div+"'><p>"+dat.data+" "+dat.user_name+"</p>";
          html += '<button type="button" data-form-id="'+form_id+'" data-data-id='+dat.data_id+' class="btn btn-light btn-sm" id="reply_link">Reply</button>';
          html += '<form action="./api/api-reply-post.php" method="POST" class="reply_form" id="'+form_id+'"></form></div>';
          $(div).append(html);
          if (dat.num_child > 0) {

            $.ajaxCallReply(next_id,0,flag,next_div);
             alert("DEBUG");
          }
        }
      }
    })).done(function() {
      $.ajaxCallReply(parent_id,i + 1,flag,'#reply');
    });

  };

  
  $(document).on("click",'#reply_link', function(){
      /* Dynamically Binded Click Trigger */
   
      var form_id = $(this).attr('data-form-id');
      var data_id = $(this).attr('data-data-id');
      form_id = "#"+form_id;
      var html = '<textarea class="form-control" id="post_input" name="reply_input" rows="2"></textarea>';
      html += '<input type="hidden" value='+data_id+' name="parent_id" />';
      html += '<input type="hidden" value='+post_id+' name="post_id" />';
      html += '<button type="submit" class="btn btn-primary" id="post_submit">Reply</button>';
      $(this).hide();
      $(form_id).append(html);
      return false;
  });
  
})