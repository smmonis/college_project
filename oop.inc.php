<?php 

class Product{

	public function add($add_array){

		return "Got it!!";

		// $insertion = "INSERT INTO products (Product_SKU, Product_Name, Product_Price, Product_Sale_Price, Sale, Product_Image, Product_Category, Product_Brand, Product_Color, Clothing_Size, Footwear_Size, Tags, Product_Brief_Description, Product_Introduction, Product_Features, Product_Status) VALUES ('$prsku','$prname','$prprice','$prsprice','$prsale','$primage','$prcategory','$prbrand','$prcolor','$prcsize','$prfsize','$tag','$br_desc','$intro','$feature','$prstatus')";

		// $result = $connection->prepare($insertion);
		
		// if($result->execute()):
		// 	$result->store_result();
		// 	return true;
		// endif;

	}

	public function edit($prsku,$prname,$prprice,$prsprice,$prsale,$primage,$prcategory,$prbrand,$prcolor,$prcsize,$prfsize,$tag,$br_desc,$intro,$feature,$prstatus){

		if($primage == ""):

			$updation = "UPDATE products SET Product_Name='$prname',Product_Price='$prprice',Product_Sale_Price=$prsprice,Sale='$prsale',Product_Category='$prcategory',Product_Brand='$prbrand',Product_Color='$prcolor',Clothing_Size='$prcsize',Footwear_Size='$prfsize',Tags='$tag', Product_Brief_Description='$br_desc', Product_Introduction='$intro', Product_Features='$feature', Product_Status='$prstatus' WHERE Product_SKU='$prsku'";

			$result = $connection->prepare($updation);
		
			if($result->execute()):
				$result->store_result();
				echo "<script type='text/javascript'>alert('Record updated successfully!');</script>";

			endif;

		else:

			$updation = "UPDATE products SET Product_Name='$prname',Product_Price='$prprice',Product_Sale_Price=$prsprice,Sale='$prsale',Product_Image='$primage',Product_Category='$prcategory',Product_Brand='$prbrand',Product_Color='$prcolor',Clothing_Size='$prcsize',Footwear_Size='$prfsize',Tags='$tag', Product_Brief_Description='$br_desc', Product_Introduction='$intro', Product_Features='$feature', Product_Status='$prstatus' WHERE Product_SKU='$prsku'";

			$result = $connection->prepare($updation);
		
			if($result->execute()):
				$result->store_result();
			endif;
		endif;
	}

	public function list($pageno){
		$no_of_records_per_page = 9;
		$offset = ($pageno-1) * $no_of_records_per_page;        

		$total_pages_sql = "SELECT COUNT(*) FROM products";
		$result = mysqli_query($connection,$total_pages_sql);
		$total_rows = mysqli_fetch_array($result)[0];
		$total_pages = ceil($total_rows / $no_of_records_per_page);

		$sql = "SELECT * FROM products LIMIT $offset, $no_of_records_per_page";
		$res_data = mysqli_query($connection,$sql);
		$row = mysqli_fetch_all($res_data,MYSQLI_ASSOC);

		foreach ($row as $key => $value):					
			echo "<tr>							
					<td>".$value['Product_SKU']."</td>
					<td>".$value['Product_Name']."</td>
					<td>".$value['Product_Price']."</td>
					<td><img src=./Product_Images/".$value['Product_Image']." width='50' height='50'></td>
					<td>".$value['Product_Category']."</td>
					<td>".$value['Product_Brand']."</td>
					<td>".$value['Product_Color']."</td>

					<td>
						<!-- Icons -->
						<a href='editform.php?id1=".$value['Product_SKU']."&action=editrow' title='Edit'><img src='resources/images/icons/pencil.png' alt='Edit' /></a>
						<a href='table.php?id2=".$value['Product_SKU']."&action=deleterow' title='Delete'><img src='resources/images/icons/cross.png' alt='Delete' /></a>
					</td>
				</tr>";
		endforeach;		
	}

	public function delete($prid){
		$deletion = "DELETE FROM products WHERE Product_SKU='$prid'";
		$result = $connection->prepare($deletion);

		if($result->execute()):
			$result->store_result();
			echo "<script type='text/javascript'>alert('Record deleted successfully!');</script>";

		endif;
	}
}
?>