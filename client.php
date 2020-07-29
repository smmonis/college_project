<?php
	
	if(isset($_POST['category'])):
		$category = $_POST['category'];
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);

		$data = "category=$category";

		if(isset($_POST['ascending'])):
			if($_POST['ascending'] == "lth"):
				$ascending = $_POST['ascending'];
				$data .= "&ascending=$ascending";

			endif;
		endif;

		if(isset($_POST['descending'])):
			if($_POST['descending'] == "htl"):
				$descending = $_POST['descending'];
				$data .= "&descending=$descending";

			endif;
		endif;

		if(isset($_POST['brand_arr'])):
			$brand_arr = $_POST['brand_arr'];
			$brand = json_encode($brand_arr);
			$data .= "&brand_arr=$brand";
					
		endif;

		if(isset($_POST['min_price']) && isset($_POST['max_price'])):
			$min_price = $_POST['min_price'];
			$max_price = $_POST['max_price'];
			$data .= "&min_price=$min_price&max_price=$max_price";

		endif;

		if(isset($_POST['color'])):
			$color = $_POST['color'];
			$data .= "&color=$color";

		endif;

		if(isset($_POST['size'])):
			$size = $_POST['size'];
			$data .= "&size=$size";

		endif;

		if(isset($_POST['tag'])):
			$tag = $_POST['tag'];
			$data .= "&tag=$tag";

		endif;

		if (isset($_GET['pageno'])):
			$page = $_GET['pageno'];
           	$data .= "&pageno=$page";
		
		endif;

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		curl_setopt($ch, CURLOPT_URL, "http://192.168.0.247/task/project1/server.php");

		$result = curl_exec($ch);
		
		//print_r($result);

		$result1 = json_decode($result,true);

		//print_r($result1);

		$array = array();

		for($i=0; $i<sizeof($result1)-2; $i++):
			$array[] = $result1[$i];

		endfor;

		$products = array();

		foreach ($array as $key => $value):
			$products[$key]['Product_SKU'] = $array[$key]['id'];
			$products[$key]['Product_Name'] = $array[$key]['title'];
			$products[$key]['Product_Sale_Price'] = $array[$key]['purchase_price'];
			$products[$key]['Product_Price'] = $array[$key]['retail_price'];
			$products[$key]['Color'] = $array[$key]['color'];
			$products[$key]['Product_Brand'] = $array[$key]['brand'];
			$products[$key]['Product_Image'] = $array[$key]['image'];
			$products[$key]['Clothing_Size'] = $array[$key]['size_clothing'];
			$products[$key]['Footwear_Size'] = $array[$key]['size_footwear'];
			$products[$key]['Product_Category'] = $array[$key]['category'];
			$products[$key]['Product_Features'] = $array[$key]['description'];
			$products[$key]['Product_Brief_Description'] = $array[$key]['brief_description'];
			$products[$key]['Tags'] = $array[$key]['tag'];
			$products[$key]['Sale'] = $array[$key]['sale'];
			$products[$key]['Product_Status'] = $array[$key]['product_status'];

		endforeach;

		//print_r($products);

		$x = json_encode($products);
		echo $x;

	else:
		if(isset($_POST['action'])):
			$action = $_POST['action'];
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POST, 1);

			$data = "action=$action";			

			if(isset($_POST['ascending'])):
				if($_POST['ascending'] == "lth"):
					$ascending = $_POST['ascending'];
					$data .= "&ascending=$ascending";

				endif;
			endif;

			if(isset($_POST['descending'])):
				if($_POST['descending'] == "htl"):
					$descending = $_POST['descending'];
					$data .= "&descending=$descending";

				endif;
			endif;

			if(isset($_POST['brand_arr'])):
				$brand_arr = $_POST['brand_arr'];
				$brand = json_encode($brand_arr);
				$data .= "&brand_arr=$brand";

			endif;

			if(isset($_POST['min_price']) && isset($_POST['max_price'])):
				$min_price = $_POST['min_price'];
				$max_price = $_POST['max_price'];
				$data .= "&min_price=$min_price&max_price=$max_price";

			endif;

			if(isset($_POST['color'])):
				$color = $_POST['color'];
				$data .= "&color=$color";

			endif;

			if(isset($_POST['size'])):
				$size = $_POST['size'];
				$data .= "&size=$size";

			endif;

			if(isset($_POST['tag'])):
				$tag = $_POST['tag'];
				$data .= "&tag=$tag";

			endif;

			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

			curl_setopt($ch, CURLOPT_URL, "http://192.168.0.247/task/project1/server.php");

			$result = curl_exec($ch);
			
			//print_r($result);

			$result1 = json_decode($result,true);

			//print_r($result1);

			$array = array();

			for($i=0; $i<sizeof($result1)-2; $i++):
				$array[] = $result1[$i];

			endfor;

			$products = array();

			foreach ($array as $key => $value):
				$products[$key]['Product_SKU'] = $array[$key]['id'];
				$products[$key]['Product_Name'] = $array[$key]['title'];
				$products[$key]['Product_Sale_Price'] = $array[$key]['purchase_price'];
				$products[$key]['Product_Price'] = $array[$key]['retail_price'];
				$products[$key]['Color'] = $array[$key]['color'];
				$products[$key]['Product_Brand'] = $array[$key]['brand'];
				$products[$key]['Product_Image'] = $array[$key]['image'];
				$products[$key]['Clothing_Size'] = $array[$key]['size_clothing'];
				$products[$key]['Footwear_Size'] = $array[$key]['size_footwear'];
				$products[$key]['Product_Category'] = $array[$key]['category'];
				$products[$key]['Product_Features'] = $array[$key]['description'];
				$products[$key]['Product_Brief_Description'] = $array[$key]['brief_description'];
				$products[$key]['Tags'] = $array[$key]['tag'];
				$products[$key]['Sale'] = $array[$key]['sale'];
				$products[$key]['Product_Status'] = $array[$key]['product_status'];

			endforeach;

			$pages = array();

			for($i=sizeof($result1)-1; $i>=sizeof($result1)-3; $i--):
				$pages[] = $result1[$i];

			endfor;

			print_r($pages);


			$x = json_encode($products);
			echo $x;

		endif;
	endif;

	// $category = $_POST['category'];
	// $brand = $_POST['brand_arr'];
	// $brandarr = json_encode($brand);
	// print_r($car);
	// die;
	
?>