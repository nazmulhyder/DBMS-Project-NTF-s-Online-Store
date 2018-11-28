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
					<!--<li><a href="">Sign up</a></li>-->
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
				<?php allProCart();?>
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
					<?php 
						$get_pro = "select * from products";
						$query_pro = mysqli_query($con,$get_pro);
						
						while($row_pro = mysqli_fetch_array($query_pro)){
							$pro_id = $row_pro['product_id'];
							$pro_title = $row_pro['product_title'];
							$pro_cat = $row_pro['product_cat'];
							$pro_brand = $row_pro['product_brand'];
							$pro_price = $row_pro['product_price'];
							$pro_image = $row_pro['product_image'];
							
							
							echo "<div class='product'>
									 <div class='product-a'>
										 <img src='admin_area/$pro_image'/>
									 </div>
									 <div class='product-b'>
										 <h3>$pro_title</h3>
									 </div>
									 <div class='product-c'>
										 <h3><b>Price:</b> $".number_format("$pro_price",2)."</h3>
									 </div>
									 <div class='quick'><a href='details.php?pro_id=$pro_id'><h3>Quick View</h3></a></div>
									 <div class='addtocart'><a href='index.php?add_cart=$pro_id'><div id='add_button'>Add to cart</div></a></div>
									 <div class='clear-fixed'></div>
								  </div>";
							
							
						}
						
					?>
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