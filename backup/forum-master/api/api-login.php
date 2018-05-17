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

	$id = loginGetDB($user_name,$pass);
	if($id == 0) echo "Failure: Error while Checking From Database";
	else{
		session_start();
		$_SESSION['user']=$user_name;
		$_SESSION['user_id']=$id;
		header("Location: ../index.php");
	}
?>