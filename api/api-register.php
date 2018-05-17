<?php
	include '../session.php';
	include 'random-token.php';
	include 'api-mail-methods.php';
	include 'api-database-methods.php';
	$flag = 1;
	if ( !isset($_POST['user_name']) ) $flag = 0;
	if ( !isset($_POST['email']) ) $flag = 0;
	if ( !isset($_POST['mob_number'])) $flag = 0;
	if (!isset($_POST['pass'])) $flag = 0;
	if($flag === 0)
	    header("Location:error.php");
	$user_name = $_POST['user_name'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$mob_number = $_POST['mob_number'];
	$pass = hash('sha512',$pass);

	$result = registerPutDB($user_name,$email,$pass,$mob_number);
	//$result = registerPutDB($user_name,$email,$pass,$mob_number);
	//echo $result;
	// // if($id == 0) echo "Failure: Error while Inserting Into Database";
	// // else header("Location: ../login.php");
	echo json_encode($result);
?>