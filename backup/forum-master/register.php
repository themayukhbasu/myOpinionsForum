<?php include './util/variables.php'; ?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	<?php
		require_once 'session.php';
		if ( isset( $_SESSION['user_id'] ) )
			header("Location: index.php");
	?>
    <title><?php echo $main."Sign Up"; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

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
        <a class="navbar-brand" href="#">Sign Up</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <!-- Jumbotron Header -->
      <header class="my-4">
        <h1 class="display-3">Register</h1>
      </header>

      <!-- Page Features -->
      <div class="row my-5">
        <div class="col-lg-8 col-md-8 offset-md-2">
          
          <form class="form-horizontal" action="./api/api-register.php" method="POST">
          <div class="form-group">
              <label class="control-label col-sm-2" for="user_name">Username:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Enter username">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="email">Email:</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="pass">Password:</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="pass" name="pass" placeholder="Enter password">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-3" for="mobile nmber">Mobile Number:</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="mob_number" name="mob_number" placeholder="Enter Mobile No.">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="register">Sign Up</button>
              </div>
            </div>
          </form> 
        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; <?php echo $mainTitle; ?> 2017</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
