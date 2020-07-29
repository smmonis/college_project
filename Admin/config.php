<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "shopping_db";

	$connection = new mysqli($servername,$username,$password,$dbname);

	if(!$connection):
		die("Connection failed");
		
	endif;
?>