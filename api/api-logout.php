<?php  
	function logout($flag)
	{
		include '../session.php';
		if ($flag === 440) {
			@session_unset();
			@session_destroy();
			
			return 1;
		}
		else
			return 0;
	}

	if ( isset($_POST['flag']) ) $flag = $_POST['flag'];
	echo json_encode(logout(440));
?>

