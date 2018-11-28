<?php 
session_start();
include("functions/functions.php");

?>
<!DOCTYPE html>
<html>
	<head>
		<title>NTF's online store</title>
		<link rel="icon" type="image" href="images/ntf.png"/>
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		
	</head>
	<body>
	
	<!--Main container starts here -->
		<div class="main_wrapper">
		
			<!--header starts here -->
			<div class="main_header">
				<a href="index.php"><img src="images/header.jpg" alt="header-image"/></a>
			</div>
			<!--header emds here -->
		
			<!--navigation bar starts here -->
			<div class="menubar">
				<ul id="menu">
					<li><a href="index.php">Home</a></li>
					<li><a href="all_products.php">All Products</a></li>
					<li><a href="customer/my_account.php">My Account</a></li>
					<!--<li><a href="customer_login.php">Sign up</a></li>-->
					<li><a href="cart.php">Shopping Cart</a></li>
					<li><a href="contact_us.php">Contact Us</a></li>
				</ul>
				
				<div id="search_form">
					<form action="results.php" method="get" enctype="multipart/form-data">
						<input type="text" name="user_query" placeholder="Search product.." id="search" required/>
						<input type="submit" name="search" value="Search" id="search_button"/>
					</form>
				</div>
			</div>
			<!--navigation bar ends here -->
		
			<!--contents wrapper starts here -->
			<div class="content_wrapper">
				<div id="sidebar">
					<div id="sidebar_title">Categories</div>
					<ul id="categories">
						<?php getCats(); ?>
					</ul>
					
					<div id="sidebar_title">Brands</div>
					<ul id="categories">
						<?php getBrands(); ?>
					</ul>
					
					
				</div>
				<div id="content_area">
				<?php cart(); ?>
					<div id="shopping_cart">
						<span> 
						<?php
						if(isset($_SESSION['customer_email'])){
							echo "<b style='color:white;'>Welcome: </b><b style='color:skyblue;'>".$_SESSION['customer_email']."</b><b style='color:white;'> Your</b>";
						}else{
							echo "<b style='color:skyblue;'>Welcome Guest!</b>";
						}
						?>
						<b style="color:white;margin-left:5px;">Shopping Cart-</b> <b style="color:orange;">Total Items:</b><?php total_items();?>  <b style="color:orange;">Total Price:</b><?php total_price();?> <a href="cart.php" style="color:skyblue;margin:0 5px;"> Go to cart</a>
						<?php
						if(!isset($_SESSION['customer_email'])){
							echo "<a href='checkout.php' style='color:red;'>Login</a>";
						}else{
							echo "<a href='customer/logout.php' style='color:red;'>Logout</a>";
						}
						?>
						</span>
					</div>
					
					<div id="product_box">
						<?php getPro();?>
						<?php getCatPro();?>
						<?php getBrandPro();?>
					</div>
				</div>
				<div style="clear:both"></div>
			</div>
			<!--contents wrapper ends here -->
		
			<!--footer starts here -->
			<div id="footer">&copy-2016, All rights goes to NTF's Ecommerce Site.</div>
			<!--footer starts here -->
		
		</div>
	<!--Main container ends here -->
	
	</body>
</html>