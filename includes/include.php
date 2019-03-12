<?php
	$server = 'localhost';
	$dbuser = 'Jeremy';
	$dbpwd = 'WeruMwangi';
	$dbname = '6470';
	$conn = mysqli_connect($server, $dbuser, $dbpwd, $dbname);
	if (!$conn) {
		die("Connection error ");
	}
?>