<?php
	function dataSecurityProcess($data){
		/* Returns processed data to prevent cross-sit scripting */
		$trimmedData = trim($data);
		$trimmedData = stripslashes($trimmedData);
		$data = htmlspecialchars( $trimmedData );
		if ( empty( $data ) ) return 0;
		else return $data;
	}

	function registerPutDB($user_name,$email_id,$password,$mob_number){
		$user_name = dataSecurityProcess($user_name);
		/* Creates New user and returns verification */
		include 'database_init.php';
		$query = "INSERT INTO `user`(`user_name`,`email`, `password`, `mob_number`) VALUES (?,?,?,?)";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('sssi',$uname,$email,$pass,$mob_num);
		$uname = $user_name;
		$email = $email_id;
		$pass = $password;
		$mob_num = $mob_number;
		$success = $stmt->execute();
		if(!$success) return 0;
		else return 1;
	}

	function loginGetDB($user_name,$password){
		$user_name = dataSecurityProcess($user_name);
		/* Performs Login Check and returns verification */
		include 'database_init.php';
		$query = "select `user_id` from `user` WHERE `user_name` = ? AND `password` = ?";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('ss',$uname,$pass);
		$uname = $user_name;
		$pass = $password;
		$success = $stmt->execute();
		if(!$success) return 0;
		$stmt->bind_result($user_id);
		if (!$stmt->fetch()) return 0;
		$dat = $user_id;
		$jsonVar = json_encode($dat);
		return $jsonVar;
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
		include 'database_init.php';
		//INSERT INTO `data`(`data_id`, `fk_user_id`, `fk_parent_id`, `timestamp`, `num_child`, `type`, `title`, `data`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8])
		$query = "INSERT INTO `data`(`fk_user_id`,`type`, `title`, `data`) VALUES (?,?,?,?)";

		$stmt = $connection->prepare($query);
		$stmt->bind_param('iiss',$uid,$type,$title,$input);
		$uid = $user_id;
		$type = $post_type;
		$title = $post_title;
		$input = $post_input;

		$success = $stmt->execute();
		if(!$success) return 0;
		else return 1;
	}

	function postTitleGetDB($offset,$sort,$type){
		include 'database_init.php';
		$query = "SELECT * FROM `data` WHERE `type` = ? ORDER BY `timestamp` DESC LIMIT 1 OFFSET ?";

		$stmt = $connection->prepare($query);
		$stmt->bind_param('ii', $type_val,$offset_val);
		$offset_val = $offset;
		$type_val = $type;

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
		$query = "SELECT * FROM `data` WHERE `data_id` = ? LIMIT 1";

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
		include 'database_init.php';
		//INSERT INTO `data`(`data_id`, `fk_user_id`, `fk_parent_id`, `timestamp`, `num_child`, `type`, `title`, `data`) VALUES ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8])
		$query = "INSERT INTO `data`(`fk_user_id`,`fk_parent_id`,`type`, `data`) VALUES (?,?,?,?)";
		$stmt = $connection->prepare($query);
		$stmt->bind_param('iiis',$uid,$pid,$type,$input);
		$uid = $user_id;
		$pid = $parent_id;
		$type = $post_type;
		$input = $post_input;

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