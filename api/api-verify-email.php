<?php  
	include 'api-database-methods.php';
	include 'api-mail-methods.php';
	$flag = 0;
	if ( isset($_POST['token'])) $flag = 1;
	$code = -1;
	$des = '';
	if($flag == 0) {
		$des = 'Token is required';
	}
	else {
		$token = $_POST['token'];
		//echo $pass;
		$result = emailVerifyDB($token);
		$code = $result['code'];
		if($code != 0){
			$code = -1;
			$des = 'An error occurred. Please try again!';
		}
		else {
			$code = 0;
			$des = "Your account has been verified. Redirecting to login page";
			$subject = 'Welcome to My Opinions';
			$emailBody = 'We at my opinions welcome you to our discussion forum. <br/> <br/> Team My Opinions';
			$altBody = 'We at my opinions welcome you to our discussion forum.';
			$resultDes = 'Message sent';
			$result = sendMail($result['description'], $subject, $emailBody, $altBody, $resultDes);
			//$des = $result['description'];
		}
	}
	$data = ['code' => $code, 'description' => $des];
	echo json_encode($data);
	
?>