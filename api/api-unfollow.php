<?php  
	include 'api-database-methods.php';

	$code = -1;
	$des = '';

	if(isset($_POST['id']))	{
		$data = userUnFollowByIdGetDB($_POST['id']);
	}
	else {
		$code = -1;
		$des = 'An error occurred. Please try again!';
		$data = ['code' => $code, 'description' => $des];
	}
	
	echo json_encode($data);
?>