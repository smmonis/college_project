<?php

class Order{

	public function list($pageno){
		include "config.php";

		$no_of_records_per_page = 9;
		$offset = ($pageno-1) * $no_of_records_per_page;        

		$total_pages_sql = "SELECT COUNT(*) FROM orders";
		$result = mysqli_query($connection,$total_pages_sql);
		$total_rows = mysqli_fetch_array($result)[0];
		$total_pages = ceil($total_rows / $no_of_records_per_page);

		$sql = "SELECT * FROM orders LIMIT $offset, $no_of_records_per_page";
		$res_data = mysqli_query($connection,$sql);
		$row = mysqli_fetch_all($res_data,MYSQLI_ASSOC);

		foreach ($row as $key => $value):					
			echo "<tr>							
					<td>".$value['Order_ID']."</td>
					<td>".$value['Date&Time']."</td>
					<td>".$value['Product_SKU']."</td>
					<td>".$value['Product_Quantity']."</td>
					<td>".$value['First_Name']."</td>
					<td>".$value['Last_Name']."</td>
					<td>".$value['Company_Name']."</td>
					<td>".$value['Country']."</td>
					<td>".$value['Address']."</td>
					<td>".$value['Zip']."</td>
					<td>".$value['City']."</td>
					<td>".$value['Email']."</td>
					<td>".$value['Phone']."</td>

					<td>
						<!-- Icons -->						
						<a href='table.php?id4=".$value['Order_ID']."&action=deleterow' title='Delete'><img src='resources/images/icons/cross.png' alt='Delete' /></a>
					</td>
				</tr>";
		endforeach;

		return $total_pages;
	}
}