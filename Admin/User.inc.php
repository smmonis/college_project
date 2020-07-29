<?php

class User{

	public function add($uid,$uname,$uemail,$uadd,$upin,$ucity,$ucountry,$upwd){

		include "config.php";

		$insertion = "INSERT INTO users (User_ID, User_Name, User_Email, User_Address, User_Pincode, User_City, User_Country, User_Password) VALUES ('$uid','$uname','$uemail','$uadd','$upin','$ucity','$ucountry','$upwd')";

		if(mysqli_query($connection,$insertion)):
			echo "<script type='text/javascript'>alert('Record added successfully!');</script>";

		else:
			echo "Error: " . $insertion . "<br>" . mysqli_error($connection);

		endif;
	}

	public function edit($uid,$uname,$uemail,$uadd,$upin,$ucity,$ucountry,$upwd){

		include "config.php";

		if($primage == ""):

			$updation = "UPDATE users SET User_Name='$uname',User_Email='$uemail',User_Address='$uadd',User_Pincode='$upin',User_City='$ucity',User_Country='$ucountry',User_Password='$upwd' WHERE User_ID='$uid'";

			if(mysqli_query($connection,$updation)):
				echo "<script type='text/javascript'>alert('Record updated successfully!');</script>";

			else:
				echo "Error: " . $updation . "<br>" . mysqli_error($connection);

			endif;

		else:

			$updation = "UPDATE users SET User_Name='$uname',User_Email='$uemail',User_Address='$uadd',User_Pincode='$upin',User_City='$ucity',User_Country='$ucountry',User_Password='$upwd' WHERE User_ID='$uid'";

			if(mysqli_query($connection,$updation)):
				echo "<script type='text/javascript'>alert('Record updated successfully!');</script>";

			else:
				echo "Error: " . $updation . "<br>" . mysqli_error($connection);

			endif;

		endif;
	}

	public function list($pageno){
		include "config.php";

		$no_of_records_per_page = 9;
		$offset = ($pageno-1) * $no_of_records_per_page;        

		$total_pages_sql = "SELECT COUNT(*) FROM users";
		$result = mysqli_query($connection,$total_pages_sql);
		$total_rows = mysqli_fetch_array($result)[0];
		$total_pages = ceil($total_rows / $no_of_records_per_page);

		$sql = "SELECT * FROM users LIMIT $offset, $no_of_records_per_page";
		$res_data = mysqli_query($connection,$sql);
		$row = mysqli_fetch_all($res_data,MYSQLI_ASSOC);

		foreach ($row as $key => $value):					
			echo "<tr>							
					<td>".$value['User_ID']."</td>
					<td>".$value['User_Name']."</td>
					<td>".$value['User_Email']."</td>
					<td>".$value['User_Address']."</td>
					<td>".$value['User_Pincode']."</td>
					<td>".$value['User_City']."</td>
					<td>".$value['User_Country']."</td>
					<td>
						<!-- Icons -->
						<a href='usersedit.php?idu=".$value['User_ID']."&action=editrow' title='Edit'><img src='resources/images/icons/pencil.png' alt='Edit' /></a>
						<a href='manageusers.php?idd=".$value['User_ID']."&action=deleterow' title='Delete'><img src='resources/images/icons/cross.png' alt='Delete' /></a>					
					</td>
				</tr>";
			endforeach;

		return $total_pages;

	}

	public function delete($prid){
		include "config.php";

		$deletion = "DELETE FROM users WHERE User_ID='$userid'";
		
		if(mysqli_query($connection,$deletion)):
			echo "<script type='text/javascript'>alert('Record deleted successfully!');</script>";

		else:
			echo "Error: " . $deletion . "<br>" . mysqli_error($connection);

		endif;
	}
}