<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<?php
		include 'session.php';
		if (!isset($_SESSION['user_id'])) header("location:login.php");
    $f = 0;
    if($page=='user'){
      if(isset($_GET['id'])) {
        if($_GET['id'] == $_SESSION['user_id'])
          $f = 1;
        else
          $f = 0;
      }
      else{
        $f = 1;
      }
    }
	?>
    <title><?php echo $pageTitle." | ".$mainTitle; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome core CSS -->
    <link rel="stylesheet" href="vendor/font-awesome/css/font-awesome.min.css">
    <!-- Custom styles for this template -->
    <link href="css/heroic-features.css" rel="stylesheet">

	<style type="text/css">
		/* For Firefox */
		input[type='number'] {
		    -moz-appearance:textfield;
		}
    
		/* Webkit browsers like Safari and Chrome */
		input[type=number]::-webkit-inner-spin-button,
		input[type=number]::-webkit-outer-spin-button {
		    -webkit-appearance: none;
		    margin: 0;
		}
	</style>
  </head>

  <body class="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php"><?php echo $navBrand ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item <?php if ($page === 'index') echo 'active'; ?>">
              <a class="nav-link" href="index.php"><i class="fa fa-home" aria-hidden="true"></i>
&nbsp;Home</a>
            </li>
            <li class="nav-item <?php if ($page === 'post') echo 'active'; ?>">
              <a class="nav-link" href="post.php"><i class="fa fa-paper-plane" aria-hidden="true"></i>
&nbsp;Post Your Opinion </a>
            </li>   
            <li class="nav-item <?php if ($page === 'user' && $f == 1) echo 'active'; ?>">
              <a class="nav-link" href="profile.php"><i class="fa fa-user" aria-hidden="true"></i>
&nbsp;My Profile </a>
            </li>          
            <li class="nav-item">
            <a class="nav-link" href="#" id="logout" data-toggle="tooltip" title="Logout!"><i class="fa fa-power-off" aria-hidden="true"></i>&nbsp;</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<!-- End Header -->