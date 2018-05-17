<?php  
	include 'api-database-methods.php';
	if(isset($_GET['src'])) $src = $_GET['src'];
	if(isset($_GET['dst'])) $dst = $_GET['dst'];
	echo trainFilteredGetDB($src,$dst);

?>