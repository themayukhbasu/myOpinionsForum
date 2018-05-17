<?php  
	include 'api-database-methods.php';
	if(isset($_POST['user_id'])) $id = $_POST['user_id'];
	if(isset($_POST['offset'])) $offset = $_POST['offset']; else $offset = 0;
	if(isset($_POST['sort'])) $sort = $_POST['sort']; else $sort = 0;
	echo postTitleByUserGetDB($offset,$sort,$id);

?>