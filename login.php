<?php 
  include './util/variables.php';
  include 'session.php';
  if ( isset( $_SESSION['user_id'] ) )
    header("Location: index.php");
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title><?php echo "Login | ".$mainTitle; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
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

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#"><?php echo $mainTitle; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
     
      <!-- Page Features -->
      <div class="row my-5"></div>
      <div class="row my-5">
        <div class="col-lg-2 col-md-2 ">
          <img src="assets/img/discussion-forum.jpg" alt="discussion-forum">
        </div>
        <div class="col-lg-7 col-md-7 offset-md-3">
          <p class="form-header">Log In</p>
          <form class="form-horizontal login-form">
            <div class="form-group">
              <label class="control-label col-sm-2" for="user_name">Username:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter username or email" required>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="pass">Password:</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Enter password" required>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
            <p style="margin-left:15px"><a href="register.php" >Not yet registered? Sign up</a> | <span class="span-a forgot-pass">Forgot Password</span></p>
            <p class="error" id="login-error-msg"></p><span class="span-a resend-mail" style="display:none;margin-left:15px">Resend Mail</span>
          </form> 
          <form class="form-horizontal forget-pass-form">
            <div class="form-group">
              <label class="control-label col-sm-2" for="user_name">Email:</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
            <p style="margin-left:15px"><a href="register.php" >Not yet registered? Sign up</a> | <span class="span-a back-pass">Back</span></p>
            <p class="success" id="success-msg"></p>
            <p class="error" id="error-msg"></p>
          </form> 
          <form class="form-horizontal resend-mail-form" style="display:none">
            <div class="form-group">
              <label class="control-label col-sm-2" for="user_name">Email:</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="resend-email" name="email" placeholder="Enter email">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div>
            <p style="margin-left:15px"><a href="register.php" >Not yet registered? Sign up</a> | <span class="span-a back-resend">Back</span></p>
            <p class="success" id="mail-success-msg"></p>
            <p class="error" id="mail-error-msg"></p>
          </form>
        </div>
  
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/common.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
