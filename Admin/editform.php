<?php
	session_start();

	if(empty($_SESSION['login'])):
		header('Location:login.php');

	endif;
	include "Product.inc.php";

	include 'config.php';	

	if(isset($_GET['id1'])):
		$select = "SELECT * FROM products WHERE Product_SKU='".$_GET['id1']."'";
		$result = mysqli_query($connection,$select);
		$array = mysqli_fetch_all($result,MYSQLI_ASSOC);
		$x = update($array);		
		//print_r($x);

	else:
		header('Locaton: table.php');

	endif;

	function update($array)
	{		
		$y = $array;

		foreach ($y as $key => $value):
			return $value;

		endforeach;
	}

	if(isset($_POST['update'])):
		$prsku = $_POST['sku-input'];
		$prname = $_POST['name-input'];
		$prname = mysqli_real_escape_string($connection,$prname);		
		$prprice = $_POST['price-input'];
		$prsprice = $_POST['sale-price-input'];

		$sale = array("--Select--","Yes","No");
		$prsale = $sale[$_POST['sale_dropdown']];

		$primage = "";		

		if(isset($_FILES['image-upload']['name'])):

			$address = "Product_Images/";
			$file = $address . basename($_FILES["image-upload"]["name"]);

			if(move_uploaded_file($_FILES['image-upload']['tmp_name'],$file)):
				$primage = $_FILES['image-upload']['name'];
				//echo $primage;

			endif;
		endif;

		$prcategory = implode(",", $_POST['category-dropdown']);
		// $category = serialize($prcategory);
		
		$prbrand = $_POST['brand-input'];
		
		$prcolor = $_POST['color-input'];

		$clothing_size_value = array("--Select--","S","M","L","XL");
		$prcsize = $clothing_size_value[$_POST['clothing_size_dropdown']];

		$footwear_size_value = array("--Select--","4","5","6","7","8","9","10");
		$prfsize = $footwear_size_value[$_POST['footwear_size_dropdown']];

		$tag = $_POST['tag-input'];
		$tag = mysqli_real_escape_string($connection,$tag);

		$br_desc = mysqli_real_escape_string($connection,$_POST['br-desc-input']);

		$intro = mysqli_real_escape_string($connection,$_POST['intro-input']);;

		$feature = mysqli_real_escape_string($connection,$_POST['feature-input']);

		$prstatus = $_POST['status-input'];

		$product_data = new Product();

		$product_data->edit($prsku,$prname,$prprice,$prsprice,$prsale,$primage,$prcategory,$prbrand,$prcolor,$prcsize,$prfsize,$tag,$br_desc,$intro,$feature,$prstatus);	
		
	endif;

	$category = "SELECT * FROM category";
	$x1 = mysqli_query($connection,$category);
	$y = mysqli_fetch_all($x1,MYSQLI_ASSOC);

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
					<input class='text-input small-input' type='number' id='small-input' name='sku-input' value="<?php if(!empty($x)): echo $x['Product_SKU']; endif;?>" readonly />
			</p>
								
			<p>
				<label>Product Name</label>
					<input class='text-input small-input' type='text' id='medium-input' name='name-input' value="<?php if(!empty($x)): echo $x['Product_Name']; endif;?>" required />
			</p>
								
			<p>
				<label>Product Price</label>
				<input class='text-input small-input' type='number' id='large-input' name='price-input' value="<?php if(!empty($x)): echo $x['Product_Price']; endif;?>" required />
			</p>

			<p>
				<label>Product Sale Price</label>
				<input class='text-input small-input' type='number' id='large-input' name='sale-price-input' value="<?php if(!empty($x)): echo $x['Product_Sale_Price']; endif;?>" required />
			</p>

			<p>
				<label>Sale On Product</label>              
				<select name='sale_dropdown' class='small-input' required>
					<option value='0' <?php if($x['Sale'] == '--Select--'):?> selected <?php endif;?>>--Select--</option>
					<option value='1' <?php if($x['Sale'] == 'Yes'):?> selected <?php endif;?>>Yes</option>
					<option value='2' <?php if($x['Sale'] == 'No'):?> selected <?php endif;?>>No</option>									
				</select> 
			</p>
								
			<p>
				<label>Product Image</label>				
				<input type='file' name='image-upload' value="<?php if(!empty($x)): echo $x['Product_Image']; endif;?>" />
			</p>


			<p>
				<label>Product Category</label>              
				<select name="category-dropdown[]" class="small-input js-example-basic-single" multiple="multiple" required />

					<?php foreach ($y as $key => $value):
						
						echo "<option value='".$value['Category']."'>".$value['Category']."</option>";					

					endforeach;?>

				</select> 
			</p>

			<p>
				<label>Product Brand</label>              
				<input class='text-input small-input' type='text' id='large-input' name='brand-input' value="<?php if(!empty($x)): echo $x['Product_Brand']; endif;?>" required />
			</p>

			<p>
				<label>Product Color</label>              
				<input class='text-input small-input' type='text' id='large-input' name='color-input' value="<?php if(!empty($x)): echo $x['Product_Color']; endif;?>" required />
			</p>
								
			<p>
				<label>Clothing Size</label>              
				<select name='clothing_size_dropdown' class='small-input' >
					<option value='0' <?php if($x['Clothing_Size'] == '--Select--'):?> selected <?php endif;?>>--Select--</option>
					<option value='1' <?php if($x['Clothing_Size'] == 'S'):?> selected <?php endif;?>>S</option>
					<option value='2' <?php if($x['Clothing_Size'] == 'M'):?> selected <?php endif;?>>M</option>
					<option value='3' <?php if($x['Clothing_Size'] == 'L'):?> selected <?php endif;?>>L</option>
					<option value='4' <?php if($x['Clothing_Size'] == 'XL'):?> selected <?php endif;?>>XL</option>				
				</select> 
			</p>

			<p>
				<label>Footwear Size</label>              
				<select name='footwear_size_dropdown' class='small-input' >
					<option value='0' <?php if($x['Footwear_Size'] == '--Select--'):?> selected <?php endif;?>>--Select--</option>
					<option value='1' <?php if($x['Footwear_Size'] == '4'):?> selected <?php endif;?>>4</option>
					<option value='2' <?php if($x['Footwear_Size'] == '5'):?> selected <?php endif;?>>5</option>
					<option value='3' <?php if($x['Footwear_Size'] == '6'):?> selected <?php endif;?>>6</option>
					<option value='4' <?php if($x['Footwear_Size'] == '7'):?> selected <?php endif;?>>7</option>
					<option value='5' <?php if($x['Footwear_Size'] == '8'):?> selected <?php endif;?>>8</option>
					<option value='6' <?php if($x['Footwear_Size'] == '9'):?> selected <?php endif;?>>9</option>
					<option value='7' <?php if($x['Footwear_Size'] == '10'):?> selected <?php endif;?>>10</option>				
				</select> 
			</p>

			<p>
				<label>Tag</label>
					<input class='text-input small-input' type='text' id='medium-input' name='tag-input' value="<?php if(!empty($x)): echo $x['Tags']; endif;?>" required />
			</p>

			<p>
				<label>Product Brief Description</label>
					<textarea class='text-input medium-input' type='text' id='large-input' name='br-desc-input' value="" required /><?php if(!empty($x)): echo $x['Product_Brief_Description']; endif;?></textarea>
			</p>

			<p>
				<label>Product Introduction</label>
					<textarea class='text-input medium-input' type='text' id='large-input' name='intro-input' value="" required /><?php if(!empty($x)): echo $x['Product_Introduction']; endif;?></textarea>
			</p>

			<p>
				<label>Product Features</label>
					<textarea class='text-input large-input' type='text' id='large-input' name='feature-input' value="" required /><?php if(!empty($x)): echo $x['Product_Features']; endif;?></textarea>
			</p>

			<p>
				<label>Product Status</label>
					<input class='text-input small-input' type='text' id='small-input' name='status-input' value="<?php if(!empty($x)): echo $x['Product_Status']; endif;?>" required />
			</p>
								
			<p>
				<input class="button" type="submit" value="Update" name="update" />
			</p>
								
		</fieldset>
							
	<div class="clear"></div><!-- End .clear -->
							
	</form>
						
	</div> <!-- End #tab2 -->
	</div>
	<?php include 'footer.php';?>
	</div> <!-- End #main-content -->