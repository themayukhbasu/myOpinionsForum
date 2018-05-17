<?php 
  include './util/variables.php';
  $pageTitle = "Home"; 
  $page = "post"; 
  $navBrand = "Post Your Opinion";
  include './util/header.php'; 

?>

    <!-- Page Content -->
    <div class="container">

      <!-- Page Features -->
      <div class="row my-5">
        <div class="col-lg-8 col-md-8 offset-lg-2">  
          <form class="form-horizontal" action="./api/api-post.php?post_type=0" method="POST">
            <div class="form-group">
              <label class="control-label col-sm-2" for="post_title">Title:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="post_title" name="post_title" placeholder="Enter title">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="post_input">My Opinion:</label>
              <div class="col-sm-10">
                <textarea class="form-control" id="post_input" name="post_input" rows="7"></textarea>
              </div>
            </div>
            <input type="hidden" value=0 name="type" />
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" id="post_submit">Post</button>
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
