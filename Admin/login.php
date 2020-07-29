<?php
	include 'config.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Simpla Admin | Sign In</title>
<link rel="stylesheet" href="resources/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="resources/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="resources/css/invalid.css" type="text/css" media="screen" />	
<script type="text/javascript" src="resources/scripts/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="resources/scripts/simpla.jquery.configuration.js"></script>
<script type="text/javascript" src="resources/scripts/facebox.js"></script>
<script type="text/javascript" src="resources/scripts/jquery.wysiwyg.js"></script>
</head>
  
	<body id="login">
		
		<div id="login-wrapper" class="png_bg">
			<div id="login-top">
			
				<h1>Simpla Admin</h1>
				<!-- Logo (221px width) -->
				<img id="logo" src="resources/images/logo.png" alt="Simpla Admin logo" />
			</div> <!-- End #logn-top -->
			
			<div id="login-content">
				
				<form action="" method="POST">

					<?php
						//$count = array();
	
						if(isset($_POST['signin'])):
							$adname = $_POST['admin_name'];
							$adpwd = $_POST['admin_pwd'];

							$check = "SELECT Admin_ID, Admin_Name, Admin_Password FROM admin WHERE Admin_Name='$adname' AND Admin_Password='$adpwd'";

							$result = $connection->prepare($check);

							if($result->execute()):
								$result->store_result();

								if($result->num_rows == 1):
									$result->bind_result($id, $username, $password);

									if($result->fetch()):
										if($adpwd == $password):
											session_start();
											$_SESSION['login'] = $result;
											header('Location: index.php');

										else:
											echo "<div class='notification information png_bg'>
												<div>Invalid Username or Password!</div></div>";
										endif;
									endif;

								else:
									echo "<div class='notification information png_bg'>
									<div>Invalid Username or Password!</div></div>";
								endif;
							endif;
							$result->close();
						endif;
					?>

					<p>
						<label>Username</label>
						<input class="text-input" type="text" name="admin_name" required />
					</p>
					<div class="clear"></div>
					<p>
						<label>Password</label>
						<input class="text-input" type="password" name="admin_pwd" required />
					</p>
					<div class="clear"></div>
					<p id="remember-password">
						<input type="checkbox" />Remember me
					</p>
					<div class="clear"></div>
					<p>
						<input class="button" type="submit" name="signin" value="Sign In" />
					</p>
					
				</form>
			</div> <!-- End #login-content -->
			
		</div> <!-- End #login-wrapper -->
  </body>
</html>