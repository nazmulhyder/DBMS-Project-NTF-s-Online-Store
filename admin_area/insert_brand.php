<?php
session_start();

if(!isset($_SESSION['admin_email']))
{
	header("Lobrandion:login.php");
}
include("includes/db_connect.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Inserting Product</title>
		<link rel="icon" type="image" href="../images/ntf.png"/>
		<link rel="stylesheet" type="text/css" href="style.css"/>
		
		<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
		<script>tinymce.init({ selector:'textarea' });</script>
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
					<form action="insert_brand.php" method="post" enctype="multipart/form-data">
						<table align="center" width="600"   style="color:#000;">
							
							<tr align="center">
								<td colspan="2" style="padding:10px 0 20px 0;"><h1 style="color:#9e005d;text-decoration:underline;">Insert Brand Here</h1></b></td>
							</tr>
							
							<tr>
								<td align="right" style="color:#9e005d;"><b>Brand Title:</b></td>
								<td><input type="text" name="brand_title" size="60" required/></td>
							</tr>
							
							
							<tr align="center">
								<td colspan="2" style="padding:20px 0 20px 0;"><input type="submit" name="insert_brand" value="Add New Brand" size="60" required style="background:#9e005d;color:white;padding:5px 15px;font-size:16px;"/></b></td>
							</tr>
						</table>
					</form>
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

<?php

	if(isset($_POST['insert_brand'])){
		$brand_id = '';
		//get the text data from the input fields
		$brand_title = $_POST['brand_title'];
	
		$insert_brand = "insert into brands(brand_id,brand_title) values('$brand_id','$brand_title')";
		
		$run_brand = mysqli_query($con,$insert_brand);
		
		if($run_brand){
			echo "<script>alert('brand has been inserted')</script>";
			echo "<script>window.open('insert_brand.php','_self')</script>";
		}
	
	}

?>