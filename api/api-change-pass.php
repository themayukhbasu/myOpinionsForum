<?php  
	include 'api-database-methods.php';
	$flag = 0;
	if ( isset($_POST['pass']) &&  isset($_POST['token'])) $flag = 1;
	$code = -1;
	$des = '';
	//echo $flag;
	$des = $_POST['pass'];
	if($flag == 0) {
		$des = 'Password and token is required';
	}
	else {
		$pass = $_POST['pass'];
		$token = $_POST['token'];
		//echo $pass;
		$val = passUpdateDB($pass,$token);
		if($val == 0){
			$code = -1;
			$des = 'An error occurred. Please try again!';
		}
		else {
			$code = 0;
			$des = "Successfully changed password. Redirecting to login page";
		}
	}
	$data = ['code' => $code, 'description' => $des];
	echo json_encode($data);
	
?>