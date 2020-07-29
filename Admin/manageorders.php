<?php
	session_start();
	
	if(empty($_SESSION['login'])):
		header('Location:login.php');

	endif;

	include "Order.inc.php";
	
	include 'config.php';

	if(isset($_GET['id4'])):		
		$orid = $_GET['id4'];

		$order_data = new Order();
		$order_data->delete($orid);
		
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
				<th>Order ID</th>
				<th>Date & Time</th>
				<th>Product SKU</th>
				<th>Product Quantity</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Company Name</th>
				<th>Country</th>
				<th>Address</th>
				<th>Zip</th>
				<th>City</th>
				<th>Email</th>
				<th>Phone</th>
				<th>Action</th>
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
							$order_data = new Order();
							$total_pages = $order_data->list($pageno);

					    else:
					    	$pageno = 1;
					    	$order_data = new Order();
							$total_pages = $order_data->list($pageno);

					    endif;
					?>

				<div class="clear"></div>
						</td>
					</tr>
				</tfoot>

				<tbody>
					
				</tbody>
						
			</table>

			<?php

				if($total_pages != 0):?>
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
						
					</div> <!-- End #tab1 -->
					<?php include 'footer.php';?>
				</div> <!-- End #main-content -->		