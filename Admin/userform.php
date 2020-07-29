<?php
	session_start();

	if(empty($_SESSION['login'])):
		header('Location:login.php');

	endif;

	include 'User.inc.php';

	include 'config.php';
	
	if(isset($_POST['addusers'])):
		$uid = $_POST['id-input'];
		$uname = $_POST['name-input'];
		$uemail = $_POST['email-input'];
		$uadd = $_POST['add-input'];
		$upin = $_POST['pin-input'];
		$ucity = $_POST['city-input'];
		$ucountry = $_POST['country-input'];
		$upwd = $_POST['pwd-input'];

		$user_data = new User($uid,$uname,$uemail,$uadd,$upin,$ucity,$ucountry,$upwd);
		$user_data->add();

	endif;
	
	include 'header.php';
	include 'sidebar.php';
	include 'maincontent.php';

?>

<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">
		<ul class="content-box-tabs">
			<li><a href="#tab2" class="default-tab">Forms</a></li>
		</ul>
					
	<div class="clear"></div>

<div class="content-box-content">

<div class="tab-content default-tab" id="tab2">
					
	<form action="" method="POST" enctype="multipart/form-data">
					
		<fieldset> <!-- Set class to "column-left" or "column-right" on fieldsets to divide the form into columns -->
								
			<p>
				<label>User ID</label>
					<input class="text-input small-input" type="number" id="small-input" name="id-input" required /> <!-- <span class="input-notification success png_bg">Successful message</span> --> <!-- Classes for input-notification: success, error, information, attention -->
					<br /><!-- <small>A small description of the field</small> -->
			</p>
								
			<p>
				<label>User Name</label>
					<input class="text-input small-input" type="text" id="medium-input" name="name-input" required /> <!-- <span class="input-notification error png_bg">Error message</span> -->
			</p>
								
			<p>
				<label>User Email</label>
				<input class="text-input small-input" type="text" id="large-input" name="email-input" required />
			</p>
								
			<p>
				<label>User Address</label>
				<input class="text-input small-input" type="text" id="large-input" name="add-input" required /><!--  This is a checkbox <input type="checkbox" name="checkbox2" /> And this is another checkbox -->
			</p>

			<p>
				<label>User Pincode</label>
					<input class="text-input small-input" type="text" id="small-input" name="pin-input" required /> <!-- <span class="input-notification success png_bg">Successful message</span> --> <!-- Classes for input-notification: success, error, information, attention -->
					<br /><!-- <small>A small description of the field</small> -->
			</p>

			<p>
				<label>User City</label>
					<input class="text-input small-input" type="text" id="small-input" name="city-input" required /> <!-- <span class="input-notification success png_bg">Successful message</span> --> <!-- Classes for input-notification: success, error, information, attention -->
					<br /><!-- <small>A small description of the field</small> -->
			</p>

			<p>
				<label>User Country</label>
					<input class="text-input small-input" type="text" id="small-input" name="country-input" required /> <!-- <span class="input-notification success png_bg">Successful message</span> --> <!-- Classes for input-notification: success, error, information, attention -->
					<br /><!-- <small>A small description of the field</small> -->
			</p>

			<p>
				<label>User Password</label>
					<input class="text-input small-input" type="password" id="small-input" name="pwd-input" required /> <!-- <span class="input-notification success png_bg">Successful message</span> --> <!-- Classes for input-notification: success, error, information, attention -->
					<br /><!-- <small>A small description of the field</small> -->
			</p>
								
			<p>
				<input class="button" type="submit" value="Submit" name="addusers" />
			</p>
								
		</fieldset>
							
	<div class="clear"></div><!-- End .clear -->
							
	</form>
						
	</div> <!-- End #tab2 -->
	</div>
	<?php include 'footer.php';?>
	</div> <!-- End #main-content -->
			