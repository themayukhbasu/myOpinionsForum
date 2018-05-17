<?php  
	include 'api-database-methods.php';
	$flag = 1;
	if(!isset($_POST['parent_id'])) $flag = 0;
	if(!isset($_POST['offset'])) $flag = 0;
	if(!isset($_POST['sort'])) $flag = 0;
	if($flag === 0)
		header("Location: error.php");

	$parent_id= $_POST['parent_id'];
	$offset = $_POST['offset'];
	$sort = $_POST['sort'];
	
	echo postReplyGetDB($parent_id,$offset,$sort);
	

?>