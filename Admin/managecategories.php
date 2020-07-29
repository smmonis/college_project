<?php
	session_start();
	if(empty($_SESSION['login'])):
		header('Location:login.php');

	endif;

	//include "oop.inc.php";
	
	include 'config.php';

	if(isset($_GET['id3'])):		
		$prcategory = $_GET['id3'];
		$deletion = "DELETE FROM category WHERE Category_ID='$prcategory'";
		
		if(mysqli_query($connection,$deletion)):
			echo "<script type='text/javascript'>alert('Category deleted successfully!');</script>";
			//header("Location: form.php");

		else:
			echo "Error: " . $deletion . "<br>" . mysqli_error($connection);
			//header("Location: form.php");

		endif;
	endif;

	include 'header.php';
	include 'sidebar.php';
	include 'maincontent.php';
?>

<div class="content-box"><!-- Start Content Box -->
	<div class="content-box-header">
		<ul class="content-box-tabs">
			
			<li><a href="#tab1" class="default-tab">Table</a></li> <!-- href must be unique and match the id of target div -->
		</ul>
					
	<div class="clear"></div>

<div class="content-box-content">

<div class="tab-content default-tab" id="tab1">
	<table>
		<thead>
			<tr>
				<!-- <th><input class="check-all" type="checkbox" /></th> -->
				<th>Category ID</th>
				<th>Category</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="6">
					<!-- <div class="bulk-actions align-left">
						<select name="dropdown">
							<option value="option1">Choose an action...</option>
							<option value="option2">Edit</option>
							<option value="option3">Delete</option>
						</select>
						<a class="button" href="#">Apply to selected</a>
					</div> -->
					
					<?php					
						if (isset($_GET['pageno'])):
							$pageno = $_GET['pageno'];

					    else:
					    	$pageno = 1;

					    endif;

					    $no_of_records_per_page = 9;
					    $offset = ($pageno-1) * $no_of_records_per_page;        

					    $total_pages_sql = "SELECT COUNT(*) FROM category";
					    $result = mysqli_query($connection,$total_pages_sql);
					    $total_rows = mysqli_fetch_array($result)[0];
					    $total_pages = ceil($total_rows / $no_of_records_per_page);

					    $sql = "SELECT * FROM category LIMIT $offset, $no_of_records_per_page";
					    $res_data = mysqli_query($connection,$sql);
					    $row = mysqli_fetch_all($res_data,MYSQLI_ASSOC);
					    //print_r($row);
					?>

					<?php if($total_pages != 0):?>
					<div class="pagination">
						<a href="?pageno=1" title="First Page">&laquo; First</a>
						<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1);}?>" title="Previous Page">&laquo; Previous</a>

					<?php for($i=1; $i<=$total_pages; $i++):?>
                        <a href="?pageno=<?php echo $i;?>" class="number '<?php if($pageno == $i):?>' current '<?php endif;?>'" title="<?php echo $i;?>"><?php echo $i;?></a>
                    <?php endfor;?>

						<a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>" title="Next Page">Next &raquo;</a>
						<a href="?pageno=<?php echo $total_pages; ?>" title="Last Page">Last &raquo;</a>
					</div> <!-- End .pagination -->
				<?php endif;?>

				<div class="clear"></div>
						</td>
					</tr>
				</tfoot>

				<tbody>

				<?php
					foreach ($row as $key => $value):					
						echo "<tr>							
								<td>".$value['Category_ID']."</td>
								<td>".$value['Category']."</td>
								<td>
									<!-- Icons -->
									<a href='editform.php?id11=".$value['Category_ID']."&action=editrow' title='Edit'><img src='resources/images/icons/pencil.png' alt='Edit' /></a>
									<a href='managecategories.php?id3=".$value['Category_ID']."&action=deleterow' title='Delete'><img src='resources/images/icons/cross.png' alt='Delete' /></a>			
								</td>
							</tr>";
					endforeach;
				?>
					</tbody>
						
			</table>
						
					</div> <!-- End #tab1 -->
					<?php include 'footer.php';?>
				</div> <!-- End #main-content -->		