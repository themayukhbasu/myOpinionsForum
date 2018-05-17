<?php 
  $flag = 0;
  if(!isset($_GET['id'])) $flag = 1;
  //if(!isset($_GET['token'])) $flag = 1;
  //if($_GET['token'] != hash('sha512',$_GET["id"])) $flag = 1;
  
  //$token = $_GET['token'];
  session_start();
  if($flag === 1) $id = $_SESSION['user_id'];
  else $id = $_GET['id'];
  include './util/variables.php';
  $pageTitle = "User Profile"; 
  $page = "user";
  $navBrand = "User Profile";
  include './util/header.php';

?>
    <div class="container">
      <div class="row">
        <div class="col col-md-3 offset-md-2" style="text-align:center">
          <!-- <img id="user_dp" alt="No image" style="height:100px;margin-top:20px;margin-bottom:20px"> -->
          <div id="image-preview-other" style="display:none"><img id="other-previewing" style="height: 150px;width:150px;margin-bottom: 20px;margin-top: 20px;"/></div>
          <form id="uploadimage" action="" method="post" enctype="multipart/form-data" style="display:none">
            <div id="image_preview"><img id="cur-previewing" style="height: 150px;width:150px;margin-bottom: 20px;margin-top: 20px;"/></div>
            <div id="selectImage" style="text-align:center;">
              <input id='dpid' type='file' name="file" required hidden/>
              <input id='dp-update-btn' class="btn btn-outline-primary btn-sm" type='button' value='Upload DP' title="DP must be less than 100KB" style="margin:0px auto 5px auto"/>
              <input id='dp-submit-btn' class="btn btn-outline-primary btn-sm" type='submit' value='Submit' style="margin:0px auto 5px auto;display:none"/>
            </div>
            <div id="message"><span class='hint text-secondary'>Please upload DP less than 100KB</span></div>
            <div id="loading" style="display:none;font-size:10px">Loading...</div>
          </form>
          <button id="follow-btn" class="btn btn-outline-primary btn-sm" style="margin:0px auto 20px auto;display: none">Follow</button>
          <button id="un-follow-btn" class="btn btn-outline-primary btn-sm" style="margin:0px auto 20px auto;display: none">UnFollow</button>
        </div>
        <div class="col col-md-5" style="padding:0px">
          <p id='user_name' style="margin-top:20px;margin-bottom:5px;font-size:20px;font-weight:500;letter-spacing: 1px"></p>
          <p style="margin-bottom:5px;font-weight:300;"><span id='no_discussions'></span> discussions | <span id="no_replies"></span> replies</p>
          <p style="margin-bottom:5px;font-weight:300;"><span id='followers'></span> followers | <span id='following'></span> following</p>
        </div>
      </div>
      <div class="row my-5">
        <div class="col-lg-8 col-md-8 offset-md-2" id="main">  
        </div>
      </div>
    </div>
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; <?php echo $mainTitle; ?> 2017</p>
      </div>
    </footer>

    <script>
      var user_id = <?php echo $id; ?>;
      var current_user_id = <?php echo $_SESSION['user_id']; ?>;
    </script>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/moment/moment.min.js"></script>
    <script src="js/script_user_profile.js"></script>
    <script src="js/common.js"></script>

  </body>

</html>