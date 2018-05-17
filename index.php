<?php 
  include './util/variables.php';
  $pageTitle = "Home"; 
  $page = "index";
  $navBrand = '<i class="fa fa-shield" aria-hidden="true"></i>&nbsp;Dashboard';
  include './util/header.php'; 

?>
    <!-- Page Content -->
    <div class="container">

      <!-- Page Features -->
      <div class="row my-5">
        <div class="col-lg-8 col-md-8 offset-md-2" id="main">  
          <!-- Filled with JS -->
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
    <script src="vendor/moment/moment.min.js"></script>
    <script src="js/script_index.js"></script>
    <script src="js/common.js"></script>
    
  </body>

</html>
