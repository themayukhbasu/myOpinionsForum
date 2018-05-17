$(document).ready(function(){ 

  var flag = 1;
  user_id = user_id;
  //console.log(user_id);
  //console.log(current_user_id);
  var isCurrentUser = false;
  if(user_id === current_user_id)
    isCurrentUser = true;
  if(isCurrentUser){
    $('#uploadimage').css('display','block');
    document.getElementById('dp-update-btn').addEventListener('click', openDialog);
    function openDialog() {
      document.getElementById('dpid').click();
    }
  }
  if(!isCurrentUser){
    $('#image-preview-other').css('display','block');
  }
  $(function() {
    $("#dpid").change(function() {
      $("#message").empty(); // To remove the previous error message
      var file = this.files[0];
      var imagefile = file.type;
      var match= ["image/jpeg","image/png","image/jpg"];
      if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
      {
        //$('#previewing').attr('src','assets/img/profile-img.png');
        $("#message").html("<p id='error'>Please Select A valid Image File</p>"+"<h4>Note</h4>"+"<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
        return false;
      }
      else
      {
        var reader = new FileReader();
        reader.onload = imageIsLoaded;
        reader.readAsDataURL(this.files[0]);
      }
    });
    $("#uploadimage").on('submit',(function(e) {
      e.preventDefault();
      $('#userId').val(user_id);
      $("#message").empty();
      $("#loading").css("display",'block');
      $.ajax({
        url: "./api/api-upload-dp.php", // Url to which the request is send
        type: "POST",             // Type of request to be send, called as method
        data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
        contentType: false,       // The content type used when sending data to the server.
        cache: false,             // To unable request pages to be cached
        processData:false,        // To send DOMDocument or non processed data file it is set to false
        success: function(data)   // A function to be called if request succeeds
        {
          $('#loading').css("display","none");
          $("#message").html(data);
          setTimeout(function(){$("#message").css("display","none"); location.reload();}, 2000);

        }
      });
    }));
    $('#un-follow-btn').on('click',function(e){
      $.ajax({
        url: "./api/api-unfollow.php",
        type: "POST",
        data: {id:user_id},
        success: function(data)
        {
          if(data.code == -1)alert(data.description);
          else{
            $('#un-follow-btn').css('display','none');
            $('#follow-btn').css('display','block');
          }
        }
      });
    });
    $('#follow-btn').on('click',function(e){
      $.ajax({
        url: "./api/api-follow.php",
        type: "POST",
        data: {id:user_id},
        success: function(data)
        {
          if(data.code == -1)alert(data.description);
          else{
            $('#un-follow-btn').css('display','block');
            $('#follow-btn').css('display','none');
          }
        }
      });
    });
  });
  
  function imageIsLoaded(e) {
    $('#image_preview').css("display", "block");
    $('#previewing').attr('src', e.target.result);
    $('#previewing').attr('height', '150px');
    $('#previewing').attr('width', '150px');
    $('#dp-submit-btn').css("display","inline");
  };
  $.ajaxGetUser = function(id){
    $.when($.ajax({
      url: './api/api-user-profile-get.php',
      type: "POST",
        dataType: "json",
        data: { 
          id:id
        },
      success: function(data){
        console.log(data);
        if (data.code === -1) {alert(data.description);} 
        else {
          $('#user_name').text(data.description['user_name']);
          $('#no_discussions').text(data.description['no_discussions']);
          $('#no_replies').text(data.description['no_replies']);
          $('#followers').text(data.description['follower']);
          $('#following').text(data.description['following']);
          
          if(!isCurrentUser){
            $('#other-previewing').attr('src',data.description['user_dp']);
            if(data.description.is_following){
              $('#un-follow-btn').css('display','block');
            }
            else{
              $('#follow-btn').css('display','block');
            }
          }
          else{
            $('#cur-previewing').attr('src',data.description['user_dp']);
          }
        }
      }
    }));
  }; 

  $.ajaxGetUser(user_id);
  
  var first = 0, last = 5; /* Initial Pull Offset Values */
  var flag = 1;
  var sort = 0;

  $.ajaxCallPost = function(i,j,flag){
    if (flag==0) return;
    if (i === j) return;
    $.when($.ajax({
      url: './api/api-post-title-pull-user.php',
      type: "POST",
        dataType: "json",
        data: { 
          offset: i,
          sort: sort,
          user_id : user_id
        },
      success: function(dat){
        if (dat === 0) flag = 0; //this is a hackish way, if db pull fails, 0 is being returned
        else{         
          var fromNow = moment(dat.timestamp).fromNow();
          var html = '<div class="row margin-10"><div class="col col-lg-12 col-md-12"><div class="card">'+
              '<div class="card-body">'+
              '<h4 class="card-title"><a href=opinion.php?token='+dat.token+'&id='+dat.data_id+'>'+dat.title+'</a></h4>'+
              '<div class="row">'+
              '<div class="col"><h6 class="card-subtitle mb-2 text-muted small">posted by: '+dat.user_name+'&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-comment" aria-hidden="true"></i>&nbsp;'+dat.num_child+
              '</h6></div>'+
              '<div class="col offset-6"><h6 class="card-subtitle mb-2 text-muted small"><i class="fa fa-clock-o"></i>&nbsp;<em>'+fromNow+'</em></h6></div>'+
              '</div>'+
              '<hr>'+
              '<p class="card-text">'+dat.data+'</p>'+              
              '</div></div></div></div>';
          $('#main').append(html);
        }
      }
    })).done(function() {
      $.ajaxCallPost(i + 1, j,flag);
    });
  };        
  $.ajaxCallPost(first,last,flag);

  $(window).scroll(function() {
     if($(window).scrollTop() + screen.height > $('body').height()) {
    first = last;
    last = first + 2;
    $.ajaxCallPost(first, last);
     }
  });
})