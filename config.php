<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "shopping_db";

	$connection = mysqli_connect($servername,$username,$password,$dbname);

	if(!$connection):
		die("Connection failed");
		
	endif;
?>