<?php 

	include '../session.php';
	include 'api-database-methods.php';
	if (!isset($_SESSION['user_id'])) header("location: ../login.php");
	$flag = 1;
	if ( !isset($_GET['post_type']) ) $flag = 0;
	if ( !isset($_POST['post_title']) ) $flag = 0;
	if ( !isset($_POST['post_input']) ) $flag = 0;

	if($flag === 0)
	    header("Location:error.php");

	$user_id = $_SESSION['user_id'];
	$post_type = $_GET['post_type'];
	$post_title = $_POST['post_title'];
	$post_input = $_POST['post_input'];

	$res = postPutDB($user_id,$post_type,$post_title,$post_input);
	if($res == 0) echo "Failure: Error while Inserting Into Database";
	else header("Location: ../index.php");

?>