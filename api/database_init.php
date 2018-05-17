<?php
	include '../util/variables.php';

	$debug = False; /* Debug Code Flag */

	$connection = new mysqli($host,$user,$pass,$db);

	if ($connection->connect_error) {
	    die("Failed: railway || ERROR : " . $connection->connect_error);
	}
	else if ($debug==True){echo "db works";}	

?>