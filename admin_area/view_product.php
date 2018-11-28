<?php
	session_start();
	
	if(!isset($_SESSION['admin_email']))
	{
		header("Location:login.php");
	}
	include("includes/db_connect.php");
	$min=0;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>NTF's View Product</title>
		<link rel="icon" type="image" href="../images/ntf.png"/>
		<link rel="stylesheet" type="text/css" href="style.css"/>

	</head>
	<body>
		<!--Main container starts here -->
		<div class="main_wrapper">
		
			<!--header starts here -->
			<div class="main_header">
				<a href="index.php"><img src="../images/header.jpg" alt="header-image"/></a>
			</div>
			<!--header emds here -->
			<!--Content section start here-->
			<div class="content_section">
				<div class="main_content">
					<h2 style="text-align:center;color:#9e005d;margin-top:15px;text-decoration:underline;">View All Products Here</h2>
					<table border="1" width="700" style="margin:25px auto;text-align:center;">
						
						
						<tr style="background:#5b0237;color:white;">
							<th>S.N.</th>
							<th>Title</th>
							<th>Image</th>
							<th>Price</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
						<?php
							$query = "SELECT * FROM products";
							$res_query=mysqli_query($con,$query);
							if($res_query && mysqli_num_rows($res_query)>0){
								$i=$min+1;
								while($row=mysqli_fetch_array($res_query)){
									$pro_image = $row['product_image'];
									$pro_price = $row['product_price'];
								?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row['product_title']."<br/>";?></td>
									<td><?php echo "<img src='$pro_image' width='120' height='120'/>";?></td>
									<td><?php echo '$'.number_format("$pro_price",2)."<br/>";?></td>
									<td><a href="edit.php?edit_pro_id=<?php echo $row['product_id'];?>" style="text-decoration:none;"><input type="button" value="Edit" style="background:#9e005d;color:white;padding:5px 10px;font-size:12px;"/></a></td>
									<td><a href="delete.php?delete_pro_id=<?php echo $row['product_id'];?>" style="text-decoration:none;"><input type="button" value="Delete" style="background:#9e005d;color:white;padding:5px 10px;font-size:12px;"/></a></td>
								</tr>
								<?php
								$i++;
								}
							}else{
								?>
									<tr>
										<td colspan="6" style="text-align:center;color:red;">There are no products to view.</td>
									</tr>
								<?php
							}
						?>
					</table>
				</div>
				<div class="sidebar">
					<div id="sidebar_title">Manage Contents</div>
					<ul id="categories">
						<li><a href="insert_product.php">Insert New Product</a></li>
						<li><a href="view_product.php">View All Product</a></li>
						<li><a href="insert_cat.php">Insert New Category</a></li>
						<li><a href="view_cat.php">View All Categories</a></li>
						<li><a href="insert_brand.php">Insert New Brand</a></li>					
						<li><a href="view_brand.php">View All Brands</a></li>
						<li><a href="view_customers.php">View Customers</a></li>
						<li><a href="view_orders.php">View Orders</a></li>
						<li><a href="view_payments.php">View Payments</a></li>
					</ul>
					<div style="width:200px;text-align:center;padding:15px 0;">
						
						<?php
							if(isset($_SESSION['admin_email'])){
								echo "<a href='logout.php' style='text-decoration:none;'><input type='submit' value='Logout' style='background:#9e005d;color:white;padding:5px 15px;font-size:16px;'/></a>";
							}
							?>
						
					</div>
				</div>
				<div class="clear-fixed"></div>
			</div>
			
			<!--Content section ends here-->
			<!--footer starts here -->
			<div id="footer">&copy-2016, All rights goes to NTF's Ecommerce Site.</div>
			<!--footer starts here -->
		
		</div>
	<!--Main container ends here -->
	
	</body>
</html>

