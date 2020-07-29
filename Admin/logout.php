<?php
	
	session_start();

	if(isset($_SESSION['login'])):
		session_destroy();
		header("Location: login.php");
		
	else:
		header("Location: login.php");

	endif;
?>