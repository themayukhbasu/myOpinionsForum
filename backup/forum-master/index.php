<style>
    .post{
      padding: 20px;
      border: 1px solid #343a40;
      background-color: #fbfbfb;
      margin-bottom:20px;
    }
    .post-title{
      color:#222;
      font-size:20px;
      
    }
    .post-title:hover{
      color:#666;
    }
    .post-data{
      color: #666;
      margin-top:10px;
    }
    .post-subtitle{
      margin-bottom:0px;
      font-size:14px;
    }
    .post-time{
      margin-right:15px;
      float:right;
    }
  </style>
<?php 
  include './util/variables.php';
  $pageTitle = "Home"; 
  $page = "index";
  $navBrand = "Dashboard";
  include './util/header.php'; 

?>


    <!-- Page Content -->
    <div class="container">

      <!-- Page Features -->
      <div class="row my-5">
        <div class="col-lg-8 col-md-8 offset-lg-2" id="main">
           <h2 class="text-center" style="margin-bottom:20px;letter-spacing: 2px">MY FORUM</h2> 
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
    <script src="js/script_index.js"></script>
    <script src="js/common.js"></script>
    <script src="js/moment.js"></script>
    
  </body>
  

</html>
