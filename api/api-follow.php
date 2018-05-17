<?php  
	include 'api-database-methods.php';
	include 'random-token.php';
	include 'api-mail-methods.php';
	$code = -1;
	$des = '';

	if(isset($_POST['id']))	{
		$data = userFollowByIdGetDB($_POST['id']);
	}
	else {
		$code = -1;
		$des = 'An error occurred. Please try again!';
		$data = ['code' => $code, 'description' => $des];
	}
	
	echo json_encode($data);
?>