<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../PHPMailer/src/Exception.php';
	require '../PHPMailer/src/PHPMailer.php';
	require '../PHPMailer/src/SMTP.php';
	header('Content-type: application/json');

	function sendMail($rec, $sub, $body, $alt, $description){
		$mail = new PHPMailer(true);  
		try {
			$mail->SMTPDebug = 0;
			$mail->isSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true;
			$mail->Username = 'com.myopinions@gmail.com';
			$mail->Password = 'Myopinion1995';
			$mail->SMTPSecure = 'ssl';
			$mail->Port = 465;
			$mail->setFrom('com.myopinions@gmail.com', 'My Opinions');
			$mail->addAddress($rec); 
			$mail->isHTML(true);
			$mail->Subject = $sub;
			$mail->Body    = $body;
			$mail->AltBody = $alt;
			$mail->send();
			$code = 0;
			$des = $description;
		} catch (Exception $e) {
			$code = -1;
			$des = 'Message could not be sent';
		}	
		return ['code'=>$code, 'description'=>$des];
	}
?>
