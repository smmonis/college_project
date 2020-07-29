<?php
	session_start();

	if(empty($_SESSION['login'])):
		header('Location:login.php');

	endif;

	include 'header.php'
?>

	<body><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
		
		<?php include 'sidebar.php'?>

	<?php include 'maincontent.php';?>

	<?php include 'footer.php'?>