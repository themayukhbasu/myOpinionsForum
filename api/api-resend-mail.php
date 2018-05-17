<?php  
	include 'api-database-methods.php';
	include 'random-token.php';
	include 'api-mail-methods.php';
	
	$flag = 0;
	if ( isset($_POST['email']) ) $flag = 1;
	$code = -1;
	$des = '';
	if($flag == 0) {
		$des = 'Email is required';
	}
	else {
		$email = $_POST['email'];
		$id = emailGetDB($email);
		if($id == 0) {
			$des = 'Email is not registered with us.';
		
		}
		else{
			$token = randomToken();
			$val = userTokenUpdateDB($email,$token);
			if($val == 0){
				$code = -1;
				$des = 'An error occurred. Please try again!';
			}
			else {
				$link = 'localhost/forum/verifyEmail.php?token='.$token;
				$subject = 'Account Verification';
				$emailBody = 'Please click on the link below to verify your email and activate your account <br/> <br/> <a href="'.$link.'">'.$link.'</a>';
				$altBody = 'Please copy paste this link to verify your email : '.$link;
				$resultDes = 'A link has been sent to your email address. Please click on the link to verify your email.';
				$result = sendMail($email, $subject, $emailBody, $altBody, $resultDes);
				$code = $result['code'];
				$des = $result['description'];
			}
		}
	}
	$data = ['code' => $code, 'description' => $des];
	echo json_encode($data);
	
?>