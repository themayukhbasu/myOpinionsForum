<?php
	include 'api-database-methods.php';
	if(isset($_FILES["file"]["type"]))
	{
		$validextensions = array("jpeg", "jpg", "png");
		$temporary = explode(".", $_FILES["file"]["name"]);
		$file_extension = end($temporary);
		if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
		) && ($_FILES["file"]["size"] < 1000000)//Approx. 100kb files can be uploaded.
		&& in_array($file_extension, $validextensions)) {
			if ($_FILES["file"]["error"] > 0)
			{
				echo "<span class='invalid'>Return Code: " . $_FILES["file"]["error"] . "</span>";
			}
			else{
				
				//echo $_FILES['file']['tmp_name'];
				$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
				$targetPath = "../upload/".$_FILES['file']['name']; // Target path where file is to be stored
				move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
				session_start();
				$dpPath = "upload/".$_FILES['file']['name'];
				$val = uploadDPByIdDB($dpPath,$_SESSION['user_id']);
				if($val == 0){
					echo "<span class='invalid'>An error occurred. Please try again!<span>";
				}
				else{
					echo "<span class='success'>File uploaded successfully. Please wait... <span>";
				}
				//echo $val;
			}
		}
		else
		{
			echo "<span class='invalid'>Invalid file Size or Type<span>";
		}
	}
?>