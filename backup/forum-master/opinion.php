<?php 
  $flag = 0;
  if(!isset($_GET['id'])) $flag = 1;
  if(!isset($_GET['token'])) $flag = 1;
  if($_GET['token'] != hash('sha512',$_GET["id"])) $flag = 1;
  $id = $_GET['id'];
  $token = $_GET['token'];
  if($flag === 1) header("Location:index.php");
  include './util/variables.php';
  $pageTitle = "Opinion"; 
  $page = "opinion";
  $navBrand = "Opinion";
  include './util/header.php'; 

?>
    <!-- Page Content -->
    <div class="container">

      <!-- Page Features -->
      <div class="row my-5">
        <div class="col-lg-9 col-md-9 offset-md-1" id="main">  
          <!-- Filled with JS -->
        </div>
      </div>
      <div class="row my-5">
        <div class="card col-lg-7 col-md-7 offset-md-2" id="reply">  
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

    <script>
      var post_id = <?php echo $id; ?>;
    </script>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/script_opinion.js"></script>
    <script src="js/common.js"></script>

  </body>

</html>