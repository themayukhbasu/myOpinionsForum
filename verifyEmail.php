<?php 
  include './util/variables.php';
  include 'session.php';
  if ( isset( $_SESSION['user_id'] ) )
    header("Location: index.php");
  $token = NULL;
  if( isset($_GET['token'])){
    $token = $_GET['token'];
  }
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title><?php echo $mainTitle; ?></title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="css/heroic-features.css" rel="stylesheet">
    <style>
    
    .special{
      background-color: black;
      opacity: 0.75;
    }
    .form-header{
      margin-left: 15px;
      font-size:20px;
    }
    .span-a{
      color : #007bff;
      text-decoration: none;
      cursor :pointer;
    }
    .span-a:hover{
      color: #0056b3;
      text-decoration: underline;
    }
    .forget-pass-form{
      display: none;
    }
    .success{
      margin-left:15px;
      color : #28a745;
      font-size:14px;
    }
    .error{
      margin-left:15px;
      color : #dc3545;
      font-size:14px;
    }
    </style>
  </head>

  <body class="wrapper">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">My Opinions</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="row my-5"></div>
      <div class="row my-5">
        <div class="col-lg-2 col-md-2 ">
          <img src="assets/img/discussion-forum.jpg" alt="discussion-forum">
        </div>
        <div class="col-lg-7 col-md-7 offset-md-3">
          <p class="form-header verify">Verifying your email address...</p>
          <p class="success" id="success-msg"></p>
          <p class="error" id="error-msg"></p>
        </div>

      </div>

    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
          var token = "<?php echo $token ?>";
              if(!token || token == ''){
                $('#error-msg').text('Token is required');
              return false;
          }
          //console.log(token);
          //console.log(data);
          $.ajax({
            type: "POST",
            url: './api/api-verify-email.php',
            dataType: "json",
            data: { "token" : token},
            success: function(dat) {
              //console.log(dat);
              if(dat.code == 0){
                $('.verify').css('display','none');
                $('#success-msg').text(dat.description);
                $('#error-msg').text('');
              }
              else{
                $('#error-msg').text(dat.description);
                $('#success-msg').text('');
              }
              setTimeout(function(){ window.location.href = 'login.php'; }, 3000);
            },
            error: function(data,code){
              //console.log(data);
            }
          });
      });
      // $('.change-pass-form').on("submit",function(ev){
      //   ev.preventDefault();
      //   //console.log("I am here");
      //   $('#success-msg').text('');
      //   $('#error-msg').text('');
      //   if(!$('#pass').val() || $('#pass').val() == ''){
      //     $('#error-msg').text('Password is required');
      //     return false;
      //   }
      //   if($('#pass').val() != $('#confirm-pass').val()){
      //     $('#error-msg').text('Passwords do not match');
      //     return false;
      //   }
      
      //   return true;
      // });
    </script>
  </body>

</html>
