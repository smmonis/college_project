<?php
	session_start();
	if(empty($_SESSION['login'])):
		header('Location:login.php');

	endif;

	//$arr_c = array();
	
	include 'config.php';	
	
	if(isset($_POST['add'])):
		$prcategory = $_POST['category'];

		$insertion = "INSERT INTO category (Category) VALUES ('$prcategory')";

		if(mysqli_query($connection,$insertion)):
			echo "<script type='text/javascript'>alert('Category added successfully!');</script>";

		else:
			echo "Error: " . $insertion . "<br>" . mysqli_error($connection);

		endif;
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
				<label>Category</label>
					<input class="text-input small-input" type="text" id="small-input" name="category" required />
					<br />
			</p>

			<p>
				<input class="button" type="submit" value="Submit" name="add" />
			</p>
		</fieldset>
							
	<div class="clear"></div><!-- End .clear -->
							
	</form>
						
	</div> <!-- End #tab2 -->
	</div>	
	<?php include 'footer.php';?>
	</div> <!-- End #main-content -->