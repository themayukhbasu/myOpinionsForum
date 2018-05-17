<?php  
	include 'api-database-methods.php';
	if(isset($_POST['id']))	echo postTitleByIdGetDB($_POST['id']);
	else {
		if(isset($_POST['offset'])) $offset = $_POST['offset']; else $offset = 0;
		if(isset($_POST['sort'])) $sort = $_POST['sort']; else $sort = 0;
		
		echo postTitleGetDB($offset,$sort);
	}

?>