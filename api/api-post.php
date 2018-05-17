<?php 

	include '../session.php';
	include 'api-database-methods.php';
	if (!isset($_SESSION['user_id'])) header("location: ../login.php");
	$flag = 1;
	if ( !isset($_POST['post_type']) ) $flag = 0;
	if ( !isset($_POST['post_title']) ) $flag = 0;
	if ( !isset($_POST['post_input']) ) $flag = 0;

	if($flag === 0)
	    header("Location:error.php");

	$user_id = $_SESSION['user_id'];
	$post_type = $_POST['post_type'];
	$post_title = mb_convert_encoding(substr($_POST['post_title'], 0, 100), "ASCII");
	$post_input =  mb_convert_encoding(substr($_POST['post_input'],0,20000), "ASCII");
	

	$res = postPutDB($user_id,$post_type,$post_title,$post_input);
	if($res != 1) echo "Failure: Error while Inserting Into Database: ".$res;
	else header("Location: ../index.php");

?>

