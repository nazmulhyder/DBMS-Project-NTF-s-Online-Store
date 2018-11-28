<?php
	session_start();
	if(!isset($_SESSION['admin_email']))
	{
		header("Location:login.php");
	}            
?>
<!DOCTYPE html>
<html>
	<head>
		<title>NTF's Admin Panel</title>
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
					
					<div style="width:800px;height:auto;padding:20px;margin:100px auto 0 auto;">
						<h1 style="color:#9e005d;text-align:center;font-size:50px;"><b><br/>Welcome to Admin Panel</b></h1>
						<h3 style="color:#9e005d;text-align:center;margin-top:20px;font-size:20px;"><b><?php echo @$_GET['logged_in'];?></b> </h3>
						<h3 style="color:#9e005d;text-align:center;margin-top:20px;font-size:30px;"><b><?php echo $_SESSION['admin_name'];?></b> </h3>
					</div>
					
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