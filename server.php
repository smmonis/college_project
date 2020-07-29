 <?php
	include './config.php';
	$brand = array();
	$page=array();

	if(isset($_POST['category'])):
	//echo $_POST['category'];
		$sql= "SELECT * from products WHERE Product_Category='".$_POST['category']."'";

		if(isset($_POST['brand_array'])):
			$brand = json_decode($_POST['brand_array'],true);
			//$brand = $_POST['brand_array'];
			foreach($brand as $key => $value) 
			{ 
				$sql.= " AND Product_Brand IN ('".implode("','",$brand)."')";
			}
		endif;

		if(isset($_POST["color"])):
			$sql.= " AND Product_Color='".$_POST['color']."'";
		endif;

		if(isset($_POST["size"])):
			$sql.= " AND Clothing_Size='".$_POST['size']."'";
		endif;

		if(isset($_POST["tag"])):
			$sql.= " AND Tags='".$_POST['tag']."'";
		endif;

		if(isset($_POST["sort"])):
			if($_POST["sort"]=="Low to high"):
				$sql.= " ORDER BY Product_Sale_Price";
			endif;
		endif;

		if(isset($_POST["sort"])):
			if($_POST["sort"]=="High to low"):
				$sql.= " ORDER BY Product_Sale_Price DESC";
			endif;
		endif;

		if(isset($_POST["min_price"]) && isset($_POST["max_price"])):
			$sql.= " AND Product_Sale_Price BETWEEN '".$_POST['min_price']."' and '".$_POST['max_price']."'";
		endif;	
		
		$result= mysqli_query($connection,$sql);
		$fetch_data_from_db= mysqli_fetch_all($result,MYSQLI_ASSOC);		
		
			if (isset($_POST['page'])) 
			{
	    		$pageno = $_POST['page'];
	    	} 
	    	else 
	    	{
	        	$pageno = 1;
	        }
	        //print_r($pageno);
	        if(isset($_POST["page6"])):
				if($_POST["page6"]=="6"):
					$no_of_records_per_page = 6;
					$offset = ($pageno-1) * $no_of_records_per_page;
	        		$total_pages = ceil(sizeof($fetch_data_from_db) / $no_of_records_per_page);
	        		$sql .= " LIMIT $offset, $no_of_records_per_page";
				elseif($_POST["page6"]=="12"):
					$no_of_records_per_page = 12;
					$offset = ($pageno-1) * $no_of_records_per_page;
	        		$total_pages = ceil(sizeof($fetch_data_from_db) / $no_of_records_per_page);
	        		$sql .= " LIMIT $offset, $no_of_records_per_page";
				endif;
			else:
				$no_of_records_per_page = 9;
				$offset = ($pageno-1) * $no_of_records_per_page;
		        $total_pages = ceil(sizeof($fetch_data_from_db) / $no_of_records_per_page);
		        $sql .= " LIMIT $offset, $no_of_records_per_page";						
			endif;
			
	        $res_data = mysqli_query($connection,$sql);
	        $row = mysqli_fetch_all($res_data,MYSQLI_ASSOC);
	        array_push($row, $pageno);
	        array_push($row, $total_pages);
	       
			$json_data=json_encode($row);

			echo $json_data;

	else:
		if(isset($_POST['action'])):
		//echo $_POST['action'];
			$sql= "SELECT * from products WHERE Product_Status='1'";

			if(isset($_POST['brand_array'])):
			$brand = json_decode($_POST['brand_array'],true);
			//$brand = $_POST['brand_array'];
			foreach($brand as $key => $value) 
			{ 
				$sql.= " AND Product_Brand IN ('".implode("','",$brand)."')";
			}
		    endif;


			if(isset($_POST["color"])):
				$color=$_POST["color"];
				$sql.= " AND Product_Color='$color'";
			endif;

			if(isset($_POST["size"])):
				$size = $_POST["size"];
				$sql.= " AND Product_Brand='$size'";
			endif;

			if(isset($_POST["tag"])):
				$tag = $_POST["tag"];
				$sql.= " AND Tags='$tag'";
			endif;
			
			if(isset($_POST["sort"])):
				if($_POST["sort"]=="Low to high"):
					$sql.= " ORDER BY Product_Sale_Price";
				endif;
			endif;

			if(isset($_POST["sort"])):
				if($_POST["sort"]=="High to low"):
					$sql.= " ORDER BY Product_Sale_Price DESC";
				endif;
			endif;

			

			if(isset($_POST["min_price"] )&& isset($_POST["max_price"])):
			
			$min= $_POST["min_price"];
			$max= $_POST["max_price"];
			$sql.= " AND Product_Sale_Price BETWEEN '$min' and '$max'";

			endif;


			$result= mysqli_query($connection,$sql);
			$fetch_data_from_db= mysqli_fetch_all($result,MYSQLI_ASSOC);

			if (isset($_POST['page'])) 
			{
	    		$pageno = $_POST['page'];
	    	} 
	    	else 
	    	{
	        	$pageno = 1;
	        }
	        //print_r($pageno);
	        if(isset($_POST["page6"])):
				if($_POST["page6"]=="6"):
					$no_of_records_per_page = 6;
					$offset = ($pageno-1) * $no_of_records_per_page;
	        		$total_pages = ceil(sizeof($fetch_data_from_db) / $no_of_records_per_page);
	        		$sql .= " LIMIT $offset, $no_of_records_per_page";
				elseif($_POST["page6"]=="12"):
					$no_of_records_per_page = 12;
					$offset = ($pageno-1) * $no_of_records_per_page;
	        		$total_pages = ceil(sizeof($fetch_data_from_db) / $no_of_records_per_page);
	        		$sql .= " LIMIT $offset, $no_of_records_per_page";
				endif;
			else:
			$no_of_records_per_page = 9;
			$offset = ($pageno-1) * $no_of_records_per_page;
	        $total_pages = ceil(sizeof($fetch_data_from_db) / $no_of_records_per_page);
	        $sql .= " LIMIT $offset, $no_of_records_per_page";						
			endif;
			
	        $res_data = mysqli_query($connection,$sql);

	        $row = mysqli_fetch_all($res_data,MYSQLI_ASSOC);

	        array_push($row, $pageno);
	        array_push($row, $total_pages);
	       
			$json_data=json_encode($row);

			echo $json_data;

		endif;  						
	endif;

	if(isset($_POST['productid']) && !isset($_POST['removeid'])):
		$quantity=$_POST['quantity'];
		if(checkcart($_POST['productid'])):
			foreach($product as $key => $value):
				if($_POST['productid']==$value['id']):
					$product[$key]['quantity']=$product[$key]['quantity']+$quantity;
					$product[$key]['total']=$product[$key]['quantity'] * $product[$key]['purchase_price'];
					$_SESSION['product']=$product;
				endif;
			endforeach;
		else:	
			$id=$_POST['productid'];
			$sql="SELECT * from products WHERE Product_SKU='$id'";
			$result=mysqli_query($connection,$sql);
			$product_fetch=mysqli_fetch_assoc($result);

			$product_fetch['quantity']=$quantity;
			$product_fetch['total']=$quantity * $product_fetch['Product_Sale_Price'];
			
			$_SESSION['product'][]=$product_fetch;
			$product=$_SESSION['product'];

		endif;
	
		$product_data=json_encode($product);
		echo $product_data;
	endif;
	/*elseif(isset($_POST['removeid'])):
		foreach ($product as $key => $value):
			if($_POST['removeid']==$value['id']):
				array_splice($product,$key,1);
				$_SESSION['product']=$product;
				$update=$_SESSION['product'];
				//$_POST['removeid']="";
				$product_data=json_encode($update);
				echo $product_data;

			endif;
		endforeach;	
		//endif;
	elseif(isset($_POST['cart'])):
		$product=$_SESSION['product'];
		$product_data=json_encode($product);
		echo $product_data;
		//endif;
	endif;
*/

function checkcart($id)
{
	global $product;
	foreach ($product as $key => $value):
		if($id==$value['id']):
			return true;
		endif;
	endforeach;
	return false;	
}
/*
$uqty=array();
if(isset($_POST['quant'])):
	$uqty=$_POST['quant'];
	foreach ($uqty as $key => $value) 
	{
		foreach ($product as $pro_key => $pro_value) 
		{
			if($key==$pro_key):
				$product[$pro_key]['quantity']=$value;
				$product[$pro_key]['total']=$product[$pro_key]['quantity']*$product[$pro_key]['purchase_price'];
			endif;		
		}

	}
	$_SESSION['product']=$product;
	$update=$_SESSION['product'];
	$product_data=json_encode($update);
	echo $product_data;
endif;*/

?>



<?php 
/*include './config.php';
 if(isset($_POST['action'])):
 		$sql= "SELECT * from products WHERE Product_Status='1'";
 		
 		if(isset($_POST['category'])):
 			$sql.= " AND Product_Category='".$_POST['category']."'";
 			
 		endif;

		if(isset($_POST['brand_array'])):
			$brand = json_decode($_POST['brand_array'],true);
			//$brand = $_POST['brand_array'];
			print_r($brand);
			foreach($brand as $key => $value) 
			{ 
				$sql.= " AND Product_Brand IN ('".implode("','",$brand)."')";
			}
		endif;
			//print_r($sql);
 			$res_data = mysqli_query($connection,$sql);
	        $row = mysqli_fetch_all($res_data,MYSQLI_ASSOC);
	           //echo "Error: " . $sql . "<br>" . mysqli_error($connection);
	        //array_push($row, $pageno);
	        //array_push($row, $total_pages);
	      // print_r($row);
			$json_data=json_encode($row);

			echo $json_data;
		// endif;
endif;*/

?>