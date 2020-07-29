<?php

class Product{

	public function display11($cat){
		$show = "SELECT * FROM products WHERE Product_Category='".$cat."'";
		return $show;
	}

	public function display21(){
		$show .= "ORDER BY Product_Price";
		return $show;
	}

	public function display31(){
		$show .= "ORDER BY Product_Price DESC";
		return $show;
	}

	public function display41($arr){
		foreach ($arr as $key => $value):
		$show .= "AND Product_Brand IN('".implode("','",$arr)."')";

		endforeach;
		return $show;
	}

	public function display51($brand){
		$show .= "AND Product_Brand IN('".$brand."')";
		return $show;
	}

	public function display61($min,$max){
		$show .= "AND Product_Price BETWEEN '".$min."' AND '".$max."'";
		return $show;
	}

	public function display71($color){
		$show .= "AND Product_Color IN('".$color."')";
		return $show;
	}

	public function display81($size){
		$show .= "AND Clothing_Size IN('".$size."')";
		return $show;
	}

	public function display91($tag){
		$show .= "AND Product_Color IN('".$tag."')";
		return $show;
	}

	public function display1($action){
		$show = "SELECT * FROM products WHERE Product_Status='1'";
		return $show;
	}

	public function display2(){
		$show .= "ORDER BY Product_Price";
		return $show;
	}

	public function display3(){
		$show .= "ORDER BY Product_Price DESC";
		return $show;
	}

	public function display4($arr){
		foreach ($arr as $key => $value):
			$show .= "AND Product_Brand IN('".implode("','",$arr)."')";

		endforeach;
		return $show;
	}

	public function display5($brand){
		$show .= "AND Product_Brand IN('".$brand."')";
		return $show;
	}

	public function display6($min,$max){
		$show .= "AND Product_Price BETWEEN '".$min."' AND '".$max."'";
		return $show;
	}

	public function display7($color){
		$show .= "AND Product_Color IN('".$color."')";
		return $show;
	}

	public function display8($size){
		$show .= "AND Clothing_Size IN('".$size."')";
		return $show;
	}

	public function display9($tag){
		$show .= "AND Product_Color IN('".$tag."')";
		return $show;
	}
}