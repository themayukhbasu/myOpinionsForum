<?php

function randomToken(){
	$token = openssl_random_pseudo_bytes(16);
	$token = bin2hex($token);
	return $token;

}

?>