<?php
	function dataSecurityProcess($data){
		/* Returns processed data to prevent cross-site scripting */
		$trimmedData = trim($data);
		$trimmedData = stripslashes($trimmedData);
		$data = htmlspecialchars( $trimmedData );
		if ( empty( $data ) ) return 0;
		else return $data;
	}

	function postModeration(){
		include 'api-moderation.php';
	}

	/* Updated by Diksha */
	function registerPutDB($user_name,$email_id,$password,$mob_number){
		$token = randomToken();
		$user_name = dataSecurityProcess($user_name);
		include 'database_init.php';
		$query = "select * from `user` WHERE `email` = ? ";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('s',$email);
		$email = $email_id;
		$success = $stmt->execute();
		if(!$success) return ['code' => -1, 'description' => 'An error occured. Please try again!'];
		$result = $stmt->get_result();
		$stmt->close();
		if(mysqli_num_rows($result) !== 0) {
			$user_err = 'Email id already registered.';
			return ['code' => -2, 'description' => $user_err];
		}
		$query = "select * from `user` WHERE `user_name` = ? ";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('s',$uname);
		$uname = $user_name;
		$success = $stmt->execute();
		if(!$success) return ['code' => -1, 'description' => 'An error occured. Please try again!'];
		$result = $stmt->get_result();
		$stmt->close();
		if(mysqli_num_rows($result) !== 0) {
			$user_err = 'User name already present. Try a different user name.';
			return ['code' => -3, 'description' => $user_err];
		}
		$query = "INSERT INTO `user`(`user_name`,`email`, `password`, `mob_number`,`user_token`) VALUES (?,?,?,?,?)";
		$stmt = $connection->prepare($query);

		$stmt->bind_param('sssis',$uname,$email,$pass,$mob_num,$uToken);
		$uname = $user_name;
		$email = $email_id;
		$pass = $password;
		$mob_num = $mob_number;
		$uToken = $token;
		$success = $stmt->execute();
		if(!$success) return ['code' => -1, 'description' => 'An error occured. Please try again!'];
		$link = 'localhost/forum/verifyEmail.php?token='.$token;
		$subject = 'Account Verification';
		$emailBody = 'Please click on the link below to verify your email and activate your account <br/> <br/> <a href="'.$link.'">'.$link.'</a>';
		$altBody = 'Please copy paste this link to verify your email : '.$link;
		$resultDes = 'An link has been sent to your email address. Please click on the link to verify your email.';
		$result = sendMail($email, $subject, $emailBody, $altBody, $resultDes);
		$code = $result['code'];
		$des = $result['description'];
		return ['code' => $code, 'description' => $des];
	}

	/* Updated by Diksha */
	function loginGetDB($user_name,$password){
		$user_name = dataSecurityProcess($user_name);
		$email_id = $user_name;
		/* Performs Login Check and returns verification */
		include 'database_init.php';
		$query = "select * from `user` WHERE (`user_name` = ? OR `email` = ?) AND `password` = ?";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('sss',$uname,$email,$pass);
		$uname = $user_name;
		$email = $email_id;
		$pass = $password;
		$success = $stmt->execute();
		$code = -1;
		if(!$success) {
			$user_err = 'An error occured. Please try again!';
			return ['code' => $code, 'description' => $user_err];
		}
		$result = $stmt->get_result();
		$stmt->close();
		if(mysqli_num_rows($result) === 0) {
			$user_err = 'Username or password is incorrect';
			return ['code' => $code, 'description' => $user_err];
		}
		$arr = $result->fetch_array(MYSQLI_ASSOC);
		$user_id = $arr['user_id'];
		if($arr['is_active'] == 0){
			$user_err = 'An email had been sent to your account. Please verify using that link.';
			$code = -2;
			return ['code' => $code, 'description' => $user_err];
		}
		$code = 0;
		return ['code' => $code, 'description' => $user_id];
		// $stmt->bind_result($user_id);
		// if (!$stmt->fetch()) return 0;
		// $dat = $user_id;
		// $jsonVar = json_encode($dat);
		// return $jsonVar;
	}

	/* New Method by Diksha */
	function emailGetDB($email){
		$email = dataSecurityProcess($email);
		/* Performs Login Check and returns verification */
		include 'database_init.php';
		$query = "select `user_id` from `user` WHERE `email` = ? ";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('s',$user_email);
		$user_email = $email;
		$success = $stmt->execute();
		if(!$success) return 0;
		$stmt->bind_result($user_id);
		if (!$stmt->fetch()) return 0;
		$dat = $user_id;
		$jsonVar = json_encode($dat);
		return $jsonVar;
	}

	/* New Method by Diksha */
	function uploadDPByIdDB($path,$id){
		include 'database_init.php';
		//echo $id;
		$query = "UPDATE `user` SET `user_dp`= ? WHERE `user_id` = ?";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('ss',$user_dp_path,$id_user);
		$user_dp_path = $path;
		$id_user = $id;
		$success = $stmt->execute();
		if(!$success) return 0;
		else return 1;
	}

	/* New Method by Diksha */
	function userProfileByIdGetDB ($user_id){
		include 'database_init.php';
		$query = "SELECT `user_name`,`user_dp` from user WHERE `user_id`=? ";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('i',$id);
		$id = $user_id;
		$success = $stmt->execute();
		$user_arr = [];
		$user_err = [];
		$code = -1;
		if(!$success) {
			$user_err = 'An error occured. Please try again!';
			return ['code' => $code, 'description' => $user_err];
		}
		$result = $stmt->get_result();
		$stmt->close();
		if(mysqli_num_rows($result) === 0) {
			$user_err = 'User not found';
			return ['code' => $code, 'description' => $user_err];
		}
		$arr = $result->fetch_array(MYSQLI_ASSOC);
		
		$user_arr['user_name'] = $arr["user_name"];
		$user_arr['user_dp'] = $arr['user_dp'];
		$query= "SELECT DISTINCT `follow_user_id` from follow WHERE `user_id` = ?";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('i',$id);
		$id = $user_id;
		$success = $stmt->execute();
		$des = '';
		if(!$success) {
			$user_err = 'An error occured. Please try again!';
			return ['code' => $code, 'description' => $user_err];
		}
		$result = $stmt->get_result();
		$stmt->close();
		$user_arr['following'] = mysqli_num_rows($result);
		$query= "SELECT DISTINCT `user_id` from follow WHERE `follow_user_id` = ?";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('i',$id);
		$id = $user_id;
		$success = $stmt->execute();
		$des = '';
		if(!$success) {
			$user_err = 'An error occured. Please try again!';
			return ['code' => $code, 'description' => $user_err];
		}
		$result = $stmt->get_result();
		$stmt->close();
		$user_arr['follower'] = mysqli_num_rows($result);
		$query= "SELECT `data_id` from data where `type`=0 and `fk_user_id` = ? ";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('i',$id);
		$id = $user_id;
		$success = $stmt->execute();
		$des = '';
		if(!$success) {
			$user_err = 'An error occured. Please try again!';
			return ['code' => $code, 'description' => $user_err];
		}
		$result = $stmt->get_result();
		$stmt->close();
		$user_arr['no_discussions'] = mysqli_num_rows($result);
		$query= "SELECT `data_id` from data where `type`=1 and `fk_user_id` = ? ";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('i',$id);
		$id = $user_id;
		$success = $stmt->execute();
		$des = '';
		if(!$success) {
			$user_err = 'An error occured. Please try again!';
			return ['code' => $code, 'description' => $user_err];
		}
		$result = $stmt->get_result();
		$stmt->close();
		$user_arr['no_replies'] = mysqli_num_rows($result);
		session_start();
		$curr_user_id = $_SESSION['user_id'];
		$query= "SELECT * from follow where `user_id`= ? and `follow_user_id` = ? ";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('ii',$cid,$fid);
		$cid = $curr_user_id;
		$fid = $user_id;
		$success = $stmt->execute();
		$des = '';
		if(!$success) {
			$user_err = 'An error occured. Please try again!';
			return ['code' => $code, 'description' => $user_err];
		}
		$result = $stmt->get_result();
		$stmt->close();
		if(mysqli_num_rows($result) === 0) 
			$user_arr['is_following'] = false;
		else
			$user_arr['is_following'] = true;
		$code = 0;
		return ['code' => $code, 'description' => $user_arr];
	}

	/* New Method by Diksha */
	function userFollowByIdGetDB ($user_id){
		include 'database_init.php';
		$query = "INSERT INTO `follow`(`user_id`,`follow_user_id`) VALUES (?,?)";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('ii',$cid,$uid);
		session_start();
		$cid = $_SESSION['user_id'];
		$uid = $user_id;
		$success = $stmt->execute();
		$des = '';
		if(!$success) {
			$user_err = 'An error occured. Please try again!';
			return ['code' => $code, 'description' => $user_err];
		}
		$code = 0;
		$user_succ = "Followed user.";
		return ['code' => $code, 'description' => $user_succ];
	}

	/* New Method by Diksha */
	function userUnFollowByIdGetDB ($user_id){
		include 'database_init.php';
		$query = "DELETE FROM `follow` WHERE `user_id` = ? AND `follow_user_id` = ?";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('ii',$cid,$uid);
		session_start();
		$cid = $_SESSION['user_id'];
		$uid = $user_id;
		$success = $stmt->execute();
		$des = '';
		if(!$success) {
			$user_err = 'An error occured. Please try again!';
			return ['code' => $code, 'description' => $user_err];
		}
		$code = 0;
		$user_succ = "UnFollowed user.";
		return ['code' => $code, 'description' => $user_succ];
	}

	/* New Method by Diksha */
	function userTokenUpdateDB ($email,$token){
		include 'database_init.php';

		$query = "UPDATE `user` SET `user_token`= ? WHERE `email` = ?";
		
		$stmt = $connection->prepare($query);
		$stmt->bind_param('ss',$user_token,$user_email);
		$user_email = $email;
		$user_token = $token;
		$success = $stmt->execute();
		if(!$success) return 0;
		else return 1;
	}

	/* New Method by Diksha */
	function passUpdateDB($password,$token){
		include 'database_init.php';
		$pass = hash('sha512',$password);
		//echo $pass;
		$query = "UPDATE `user` SET `password`= ? WHERE `user_token` = ?";
		
		$stmt = $connection->prepare($query);
		$stmt->bind_param('ss',$user_pass,$user_token);
		$user_pass = $pass;
		$user_token = $token;
		$success = $stmt->execute();
		if(!$success) return 0;
		else return 1;
		//return $pass;
	}

	/* New Method by Diksha */
	function emailVerifyDB($token){
		include 'database_init.php';
		$query = "UPDATE `user` SET `is_active`= ? WHERE `user_token` = ?";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('is',$isActive,$user_token);
		$isActive = 1;
		$user_token = $token;
		$success = $stmt->execute();
		if(!$success) {
			$user_err = 'An error occured. Please try again!';
			return ['code' => -1, 'description' => $user_err];
		}
		$query = "select `email` from `user` WHERE `user_token` = ? ";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('s',$user_token);
		$user_token = $token;
		$success = $stmt->execute();
		if(!$success) {
			$user_err = 'An error occured. Please try again!';
			return ['code' => -1, 'description' => $user_err];
		}
		$stmt->bind_result($user_email);
		if (!$stmt->fetch()) {
			$user_err = 'An error occured. Please try again!';
			return ['code' => -1, 'description' => $user_err];
		}
		$email = $user_email;
		return ['code' => 0, 'description' => $email];
		
	}


	function usernameGetDB($user_id){
		/* Returns Some User Information */
		include 'database_init.php';
		$query = "SELECT `user_name` FROM `user` WHERE `user_id` = ?";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('i',$uid);
		$uid = $user_id;

		$success = $stmt->execute();
		if(!$success) return 0;
		$stmt->bind_result($user_name);
		if (!$stmt->fetch()) return 0;

		return $user_name;
	}
	

	function postPutDB($user_id,$post_type,$post_title,$post_input){
		/* $post_type -> 0 for main post || 1 for reply posts*/
		$post_title = dataSecurityProcess($post_title);
		$post_input = dataSecurityProcess($post_input);
		postModeration();
		$moderation = -1;
		include 'database_init.php';
		$query = "INSERT INTO `data`(`fk_user_id`,`type`, `title`, `data`, `moderation`) VALUES (?,?,?,?,?)";

		$stmt = $connection->prepare($query);
		$stmt->bind_param('iissi',$uid,$type,$title,$input,$mod);
		$uid = $user_id;
		$type = $post_type;
		$title = $post_title;
		$input = $post_input;
		$mod = $moderation;

		$success = $stmt->execute();
		if(!$success) return mysqli_error($connection);
		else return 1;
	}

	function postTitleGetDB($offset,$sort){
		include 'database_init.php';
		$query = "SELECT * FROM `data` WHERE `type`=0 AND (`moderation`= 0 or `moderation`= -1) ORDER BY `timestamp` DESC LIMIT 1 OFFSET ?";

		$stmt = $connection->prepare($query);
		$stmt->bind_param('i', $offset_val);
		$offset_val = $offset;

		$success = $stmt->execute();
		if ( !$success ) return 0;
	    $result = $stmt->get_result();
		$stmt->close();
		if(mysqli_num_rows($result) === 0) return 0;

		$arr = $result->fetch_array(MYSQLI_ASSOC);
		$user_name = usernameGetDB($arr["fk_user_id"]);
		if($user_name === 0) return 0; /* Error while fetching username */
		$arr["user_name"] = $user_name;
		$arr["token"] = hash('sha512',$arr["data_id"]);
		$jsonVar = json_encode($arr);
		return $jsonVar;
	}

	/* New Method by Diksha */
	function postTitleByUserGetDB($offset,$sort,$id){
		include 'database_init.php';
		$query = "SELECT * FROM `data` WHERE `type`=0 AND `moderation`=0 AND `fk_user_id` = ? ORDER BY `timestamp` DESC LIMIT 1 OFFSET ?";
		//return $id;
		$stmt = $connection->prepare($query);
		$stmt->bind_param('ii', $user_id, $offset_val);
		$user_id = $id;
		$offset_val = $offset;
		$success = $stmt->execute();
		if ( !$success ) return 0;
	 	$result = $stmt->get_result();
		$stmt->close();
		if(mysqli_num_rows($result) === 0) return 0;

		$arr = $result->fetch_array(MYSQLI_ASSOC);
		$user_name = usernameGetDB($arr["fk_user_id"]);
		if($user_name === 0) return 0; /* Error while fetching username */
		$arr["user_name"] = $user_name;
		$arr["token"] = hash('sha512',$arr["data_id"]);
		$jsonVar = json_encode($arr);
		return $jsonVar;
	}

	function postTitleByIdGetDB($id){
		include 'database_init.php';
		$query = "SELECT * FROM `data` WHERE `data_id` = ? AND (`moderation`= 0 or `moderation`= -1) LIMIT 1";

		$stmt = $connection->prepare($query);
		$stmt->bind_param('i', $data_id);
		$data_id = $id;

		$success = $stmt->execute();
		if ( !$success ) return 0;
	    $result = $stmt->get_result();
		$stmt->close();
		if(mysqli_num_rows($result) === 0) return 0;

		$arr = $result->fetch_array(MYSQLI_ASSOC);
		$user_name = usernameGetDB($arr["fk_user_id"]);
		if($user_name === 0) return 0; /* Error while fetching username */
		$arr["user_name"] = $user_name;
		$arr["token"] = hash('sha512',$arr["data_id"]);
		$jsonVar = json_encode($arr);
		return $jsonVar;
	}

	function incrementChild($data_id){
		/* Increments the num_child attribute */
		include 'database_init.php';

		$query = "UPDATE `data` SET `num_child`=`num_child`+1 WHERE `data_id` = ?";
		
		$stmt = $connection->prepare($query);
		$stmt->bind_param('i',$did);
		$did = $data_id;

		$success = $stmt->execute();
		if(!$success) return 0;

		return $success;
	}

	function replyPutDB($user_id,$post_type,$post_input,$parent_id){
		/* $post_type -> 0 for main post || 1 for reply posts*/
		$post_input = dataSecurityProcess($post_input);
		postModeration();
		$moderation = -1;
		include 'database_init.php';
		//INSERT INTO `data`(`data_id`, `fk_user_id`, `fk_parent_id`, `timestamp`, `num_child`, `type`, `title`, `data`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8])
		$query = "INSERT INTO `data`(`fk_user_id`,`fk_parent_id`,`type`, `data`, `moderation`) VALUES (?,?,?,?,?)";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('iiisi',$uid,$pid,$type,$input,$mod);
		$uid = $user_id;
		$pid = $parent_id;
		$type = $post_type;
		$input = $post_input;
		$mod = $moderation;

		$success = $stmt->execute();
		if(!$success) return 0;
		else {
			incrementChild($parent_id);
			return 1;
		}
	}

	function postReplyGetDB($parent_id,$offset,$sort){
		include 'database_init.php';
		$query = "SELECT * FROM `data` WHERE `fk_parent_id`=? LIMIT 1 OFFSET ?";

		$stmt = $connection->prepare($query);
		$stmt->bind_param('ii',$pid,$offset_val);
		$pid = $parent_id;
		$offset_val = $offset;

		$success = $stmt->execute();
		if ( !$success ) return 0;
	    $result = $stmt->get_result();
		$stmt->close();
		if(mysqli_num_rows($result) === 0) return 0;

		$arr = $result->fetch_array(MYSQLI_ASSOC);
		$user_name = usernameGetDB($arr["fk_user_id"]);
		if($user_name === 0) return 0; /* Error while fetching username */
		$arr["user_name"] = $user_name;
		$arr["token"] = hash('sha512',$arr["data_id"]);
		$jsonVar = json_encode($arr);
		return $jsonVar;
	}
?>