<?php
	include 'config.php';
	// include 'Product.inc.php';

	if(isset($_POST['category'])):
		$cat = $_POST['category'];
		// $obj = new Product();
		// $show = $obj->display11($cat);
		$show = "SELECT * FROM products WHERE Product_Category='".$cat."'";
			
			if(isset($_POST['ascending'])):
				if($_POST['ascending'] == "lth"):
					// $obj = new Product();
					// $show .= $obj->display21();
					$show .= "ORDER BY Product_Price";
					
				endif;
			endif;

			if(isset($_POST['descending'])):
				if($_POST['descending'] == "htl"):
					// $obj = new Product();
					// $show .= $obj->display31();
					$show .= "ORDER BY Product_Price DESC";
				endif;
			endif;

			if(isset($_POST['brand_arr'])):				
				$arr = $_POST['brand_arr'];
				// $obj = new Product();
				// $show .= $obj->display41($arr);
				foreach ($arr as $key => $value):
					$show .= "AND Product_Brand IN('".implode("','",$arr)."')";
				endforeach;
			endif;

			if(isset($_POST['brand'])):
				$brand = $_POST['brand'];
				// $obj = new Product();
				// $show .= $obj->display51($brand);
				$show .= "AND Product_Brand IN('".$brand."')";				
				
			endif;

			if(isset($_POST['min_price']) && isset($_POST['max_price'])):
				$min = $_POST['min_price'];
				$max = $_POST['max_price'];
				// $obj = new Product();
				// $show .= $obj->display61($min,$max);
				$show .= "AND Product_Price BETWEEN '".$min."' AND '".$max."'";				
				
			endif;

			if(isset($_POST['color'])):
				$color = $_POST['color'];
				// $obj = new Product();
				// $show .= $obj->display71($color);
				$show .= "AND Product_Color IN('".$color."')";				
				
			endif;

			if(isset($_POST['size'])):
				$size = $_POST['size'];
				// $obj = new Product();
				// $show .= $obj->display81($size);
				$show .= "AND Clothing_Size IN('".$size."')";				
				
			endif;

			if(isset($_POST['tag'])):
				$tag = $_POST['tag'];
				// $obj = new Product();
				// $show .= $obj->display91($tag);
				$show .= "AND Product_Color IN('".$tag."')";				
				
			endif;

			$result = mysqli_query($connection,$show);
            $products = mysqli_fetch_all($result,MYSQLI_ASSOC);

			if (isset($_GET['pageno'])):
            	$pageno = $_GET['pageno'];

            else:
                $pageno = 1;

            endif;

                $no_of_records_per_page = 9;
                $offset = ($pageno-1) * $no_of_records_per_page;                
                $total_pages = ceil(sizeof($products) / $no_of_records_per_page);

                $show .= "LIMIT $offset, $no_of_records_per_page";
                $res_data = mysqli_query($connection,$show);
                $row = mysqli_fetch_all($res_data,MYSQLI_ASSOC);

                array_push($row, $pageno);
                array_push($row, $total_pages);
						
			$json_array = json_encode($row);
			echo $json_array;			

		else:
			if(isset($_POST['action'])):
				$action = $_POST['action'];
				// $obj = new Product();
				// $show = $obj->display1($action);
				$show = "SELECT * FROM products WHERE Product_Status='1'";				

			if(isset($_POST['ascending'])):
				if($_POST['ascending'] == "lth"):
					// $obj = new Product();
					// $show .= $obj->display2();
					$show .= "ORDER BY Product_Price";
					
				endif;
			endif;

			if(isset($_POST['descending'])):
				if($_POST['descending'] == "htl"):
					// $obj = new Product();
					// $show .= $obj->display3();
					$show .= "ORDER BY Product_Price DESC";
					
				endif;
			endif;


			if(isset($_POST['brand_arr'])):				
				$arr = $_POST['brand_arr'];
				// $obj = new Product();
				// $show .= $obj->display4($arr);
				foreach ($arr as $key => $value):
					$show .= "AND Product_Brand IN('".implode("','",$arr)."')";
				endforeach;
			endif;

			if(isset($_POST['brand'])):
				$brand = $_POST['brand'];
				// $obj = new Product();
				// $show .= $obj->display5($brand);
				$show .= "AND Product_Brand IN('".$brand."')";				
				
			endif;

			if(isset($_POST['min_price']) && isset($_POST['max_price'])):
				$min = $_POST['min_price'];
				$max = $_POST['max_price'];
				// $obj = new Product();
				// $show .= $obj->display6($min,$max);
				$show .= "AND Product_Price BETWEEN '".$min."' AND '".$max."'";

			endif;

			if(isset($_POST['color'])):
				$color = $_POST['color'];
				// $obj = new Product();
				// $show .= $obj->display7($color);
				$show .= "AND Product_Color IN('".$color."')";
				
			endif;

			if(isset($_POST['size'])):
				$size = $_POST['size'];
				// $obj = new Product();
				// $show .= $obj->display8($size);
				$show .= "AND Clothing_Size IN('".$size."')";
				
			endif;

			if(isset($_POST['tag'])):
				$tag = $_POST['tag'];
				// $obj = new Product();
				// $show .= $obj->display9($tag);
				$show .= "AND Product_Color IN('".$tag."')";

			endif;

			$result = mysqli_query($connection,$show);
            $products = mysqli_fetch_all($result,MYSQLI_ASSOC);

			if (isset($_POST['page'])):
            	$pageno = $_POST['page'];

            else:
                $pageno = 1;

            endif;

            if(isset($_POST['show'])):
            	$no_of_records_per_page = $_POST['show'];

            else:
            	$no_of_records_per_page = 9;

            endif;

                $offset = ($pageno-1) * $no_of_records_per_page;                
                $total_pages = ceil(sizeof($products) / $no_of_records_per_page);

                $show .= "LIMIT $offset, $no_of_records_per_page";
                $res_data = mysqli_query($connection,$show);
                $row = mysqli_fetch_all($res_data,MYSQLI_ASSOC);

                array_push($row, $pageno);
                array_push($row, $total_pages);
						
			$json_array = json_encode($row);
			echo $json_array;

		endif;
	endif;	
?>