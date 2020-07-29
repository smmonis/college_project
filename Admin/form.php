<?php
	session_start();

	if(empty($_SESSION['login'])):
		header('Location:login.php');

	endif;

	include 'Product.inc.php';
	
	include 'config.php';	
	
	if(isset($_POST['add'])):
		$prsku = $_POST['sku-input'];
		$prname = $_POST['name-input'];
		$prname = mysqli_real_escape_string($connection,$prname);
		$prprice = $_POST['price-input'];

		$prsprice = $_POST['sale-price-input'];

		$sale = array("--Select--","Yes","No");
		$prsale = $sale[$_POST['sale-dropdown']];

		$primage = "";

		if(isset($_FILES['image-upload']['name'])):
		
		$address = "Product_Images/";
		$file = $address . basename($_FILES["image-upload"]["name"]);		

			if(move_uploaded_file($_FILES['image-upload']['tmp_name'],$file)):
				$primage = $_FILES['image-upload']['name'];

			endif;
		endif;

		$prcategory = implode(", ", $_POST['category-dropdown']);

		$prbrand = $_POST['brand-input'];
		
		$prcolor = $_POST['color-input'];

		$clothing_size_value = array("--Select--","S","M","L","XL");
		$prcsize = $clothing_size_value[$_POST['clothing-size-dropdown']];

		$footwear_size_value = array("--Select--","4","5","6","7","8","9","10");
		$prfsize = $footwear_size_value[$_POST['footwear-size-dropdown']];

		$tag = $_POST['tag-input'];
		$tag = mysqli_real_escape_string($connection,$tag);

		$br_desc = $_POST['br-desc-input'];

		$intro = $_POST['intro-input'];

		$feature = $_POST['feature-input'];

		$prstatus = $_POST['status-input'];

		$product_data = new Product();

		echo $product_data->add($prsku,$prname,$prprice,$prsprice,$prsale,$primage,$prcategory,$prbrand,$prcolor,$prcsize,$prfsize,$tag,$br_desc,$intro,$feature,$prstatus);

	endif;

	$category = "SELECT * FROM category";
	$x = $connection->prepare($category);
	$x->execute();
	$x->store_result();

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
				<label>Product SKU</label>
					<input class="text-input small-input" type="number" id="small-input" name="sku-input" required /> <!-- <span class="input-notification success png_bg">Successful message</span> --> <!-- Classes for input-notification: success, error, information, attention -->
					<br /><!-- <small>A small description of the field</small> -->
			</p>
								
			<p>
				<label>Product Name</label>
					<input class="text-input small-input" type="text" id="medium-input" name="name-input" required /><!-- <span class="input-notification error png_bg">Error message</span> -->
			</p>
								
			<p>
				<label>Product Price</label>
				<input class="text-input small-input" type="number" id="large-input" name="price-input" required />
			</p>

			<p>
				<label>Product Sale Price</label>
				<input class="text-input small-input" type="number" id="large-input" name="sale-price-input" required />
			</p>

			<p>
				<label>Sale On Product</label>              
				<select name="sale-dropdown" class="small-input" required />
					<option value="0">--Select--</option>
					<option value="1">Yes</option>
					<option value="2">No</option>									
				</select> 
			</p>
								
			<p>
				<label>Product Image</label>
				<input type="file" name="image-upload" required /><!--  This is a checkbox <input type="checkbox" name="checkbox2" /> And this is another checkbox -->
			</p>

			<p>
				<label>Product Category</label>              
				<select name="category-dropdown[]" class="small-input js-example-basic-single" multiple="multiple" required />

					<?php foreach ($x as $key => $value):
						
						echo "<option value='".$value['Category']."'>".$value['Category']."</option>";					

					endforeach;?>

				</select> 
			</p>

			<p>
				<label>Product Brand</label>              
				<input class="text-input small-input" type="text" id="large-input" name="brand-input" required />
			</p>

			<p>
				<label>Product Color</label>              
				<input class="text-input small-input" type="text" id="large-input" name="color-input" required />
			</p>
								
			<p>
				<label>Clothing Size</label>              
				<select name="clothing-size-dropdown" class="small-input" />
					<option value="0">--Select--</option>
					<option value="1">S</option>
					<option value="2">M</option>
					<option value="3">L</option>
					<option value="3">XL</option>				
				</select> 
			</p>

			<p>
				<label>Footwear Size</label>              
				<select name="footwear-size-dropdown" class="small-input" />
					<option value="0">--Select--</option>
					<option value="1">4</option>
					<option value="2">5</option>
					<option value="3">6</option>
					<option value="4">7</option>
					<option value="5">8</option>
					<option value="6">9</option>
					<option value="7">10</option>				
				</select>
			</p>

			<p>
				<label>Tag</label>
					<input class="text-input small-input" type="text" id="medium-input" name="tag-input" required /> <!-- <span class="input-notification error png_bg">Error message</span> -->
			</p>

			<p>
				<label>Product Brief Description</label>
					<textarea class="text-input small-input" type="text" id="large-input" name="br-desc-input" required /></textarea> <!-- <span class="input-notification error png_bg">Error message</span> -->
			</p>

			<p>
				<label>Product Introduction</label>
					<textarea class="text-input medium-input" type="text" id="large-input" name="intro-input" required /></textarea> <!-- <span class="input-notification error png_bg">Error message</span> -->
			</p>

			<p>
				<label>Product Features</label>
					<textarea class="text-input medium-input" type="text" id="large-input" name="feature-input" required /></textarea>
			</p>

			<p>
				<label>Product Status</label>
					<input class="text-input small-input" type="text" id="small-input" name="status-input" required /> <!-- <span class="input-notification error png_bg">Error message</span> -->
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
			