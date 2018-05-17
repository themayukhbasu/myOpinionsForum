<?php  
	include '../session.php';
	if (!isset($_SESSION['user_id'])) header("location: ../login.php");
	include 'api-database-methods.php';
	$flag = 1;
	if(!isset($_POST['parent_id'])) $flag=0;
	if(!isset($_POST['reply_input'])) $flag=0;
	if(!isset($_POST['post_id'])) $flag=0;

	if($flag === 0)
	    header("Location:error.php");
	$parent_id = $_POST['parent_id'];
	$reply_input = $_POST['reply_input'];
	$user_id = $_SESSION['user_id'];
	$post_type = 1;
	$post_id = $_POST['post_id'];
	$token = hash('sha512',$post_id);

	$res = replyPutDB($user_id,$post_type,$reply_input,$parent_id);
	if($res === 0) echo "Failed: Error while inserting in db";
	$url = "../opinion.php?token=".$token."&id=".$post_id;
	header("Location:".$url);
?>