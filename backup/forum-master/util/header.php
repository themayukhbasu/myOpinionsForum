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
	?>
    <title><?php echo $pageTitle." | ".$mainTitle; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
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

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#"><?php echo $navBrand ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item <?php if ($page === 'index') echo 'active'; ?>">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item <?php if ($page === 'post') echo 'active'; ?>">
              <a class="nav-link" href="post.php">Post Your Opinion </a>
            </li>            
            <li class="nav-item">
              <a class="nav-link" href="#" id="logout">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
<!-- End Header -->