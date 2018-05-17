<?php
	include 'api-database-methods.php';
	$flag = 1;
	if ( !isset($_POST['user_name']) ) $flag = 0;
	if (!isset($_POST['pass'])) $flag = 0;
	if($flag === 0)
	    header("Location:error.php");
	$user_name = $_POST['user_name'];
	$pass = $_POST['pass'];
	$pass = hash('sha512',$pass);

	$result = loginGetDB($user_name,$pass);
	if($result['code']  != 0) {
		echo json_encode($result);
	}
	else{
		//echo 0;
		session_start();
		$_SESSION['user']=$user_name;
		$_SESSION['user_id']=$result['description'];
		echo json_encode($result);
		// header("Location: ../index.php");
	}
?>