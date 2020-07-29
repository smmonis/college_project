<?php
	session_start(); //session_unset();

    include 'config.php';
    global $cart;

	if(isset($_SESSION['cart'])):
		$cart = $_SESSION['cart'];

	else:
		$cart = array();

	endif;
	
	if(isset($_POST['cart']) && !isset($_POST['del'])):
		if(check()):
			foreach ($cart as $key => $value):
				if($_POST['cart'] == $value['Product_SKU']):
					$cart[$key]['Product_quantity'] += $_POST['qty'];
					$cart[$key]['Price'] = $cart[$key]['Product_Sale_Price'] * $cart[$key]['Product_quantity'];

					$_SESSION['cart'] = $cart;
					$cart = $_SESSION['cart'];
					$add = json_encode($cart);
					echo $add;

				endif;
			endforeach;		

		else:
			$product = array();		

			$sql = "SELECT * FROM products WHERE Product_SKU='".$_POST['cart']."' AND Product_Status='1'";

			$result = mysqli_query($connection,$sql);
			$product = mysqli_fetch_assoc($result);			

			$quan = $_POST['qty'];
			$product['Product_quantity'] = $quan;
			$product['Price'] = $product['Product_Sale_Price'] * $product['Product_quantity'];

			$_SESSION['cart'][] = $product;						
			$cart = $_SESSION['cart'];
			//print_r($cart);
			$add = json_encode($cart);			
			echo $add;

		endif;

	elseif(isset($_POST['del'])):
		foreach ($cart as $key => $value):
			if($_POST['del'] == $value['Product_SKU']):
				$cart = del($_POST['del']);
				//$_POST['del'] = "";
				unset($_POST['del']);
				//print_r($_POST['del']);
						
				$_SESSION['cart'] = $cart;
				$cart = $_SESSION['cart'];					
				$add = json_encode($cart);
				echo $add;

			endif;
		endforeach;

	elseif(isset($_POST['cart_action'])):

		// if(isset($_POST['del'])):
		// 	foreach ($cart as $key => $value):
		// 		if($_POST['del'] == $value['Product_SKU']):
		// 			array_splice($cart,$key,1);
		// 			$_SESSION['cart'] = $cart;					
		// 			$add = json_encode($cart);
		// 			echo $add;
		// 		endif;
		// 	endforeach;
		// endif;

		//$_POST['del'] = "";
		$cart = $_SESSION['cart'];
		$add = json_encode($cart);
		echo $add;

	endif;

	function check()
	{
		global $cart;

		if(!empty($cart)):
			foreach ($cart as $key => $value):
				if($_POST['cart'] == $value['Product_SKU']):
					return true;

				endif;
		endforeach;

		else:
			return false;

		endif;
	}

	function del($del)
	{
		global $cart;

		foreach ($cart as $key => $value):
			if($value['Product_SKU'] == $del):
				array_splice($cart,$key,1);
				return $cart;

			endif;
		endforeach;
	}

	if(isset($_POST['qy'])):
		$q = array();
		$q = $_POST['qy'];
		foreach ($q as $key => $value):			
			foreach ($cart as $key1 => $value1):
				if($key1 == $key):
					$cart[$key1]['Product_quantity'] = $q[$key]['Product_quantity'];
					$cart[$key1]['Price'] = $cart[$key1]['Product_Sale_Price'] * $cart[$key1]['Product_quantity'];

				endif;
			endforeach;
		endforeach;

		$_SESSION['cart'] = $cart;
		$cart = $_SESSION['cart'];
		$add = json_encode($cart);
		echo $add;

	endif;
?>