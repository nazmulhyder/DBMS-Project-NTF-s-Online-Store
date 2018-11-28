<?php 
session_start();
include("../functions/functions.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>NTF's online store</title>
		<link rel="icon" type="image" href="../images/ntf.png"/>
		<link rel="stylesheet" type="text/css" href="../css/style.css"/>
		

	</head>
	<body>
	
	<!--Main container starts here -->
		<div class="main_wrapper">
		
			<!--header starts here -->
			<div class="main_header">
				<a href="../index.php"><img src="../images/header.jpg" alt="header-image"/></a>
			</div>
			<!--header emds here -->
		
			<!--navigation bar starts here -->
			<div class="menubar">
				<ul id="menu">
					<li><a href="../index.php">Home</a></li>
					<li><a href="../all_products.php">All Products</a></li>
					<li><a href="../customer/my_account.php">My Account</a></li>
					<!--<li><a href="">Sign up</a></li>-->
					<li><a href="../cart.php">Shopping Cart</a></li>
					<li><a href="../contact_us.php">Contact Us</a></li>
				</ul>
				
				<div id="search_form">
					<form action="../results.php" method="get" enctype="multipart/form-data">
						<input type="text" name="user_query" placeholder="Search product.." id="search" required/>
						<input type="submit" name="search" value="Search" id="search_button"/>
					</form>
				</div>
			</div>
			<!--navigation bar ends here -->
		
			<!--contents wrapper starts here -->
			<div class="content_wrapper">
				<div id="sidebar">
					<div id="sidebar_title">My Account</div>
					<ul id="categories">
						<li>
						<?php 
						$user = $_SESSION['customer_email'];
						$get_img = "select * from customers where customer_email='$user'";
						$run_img = mysqli_query($con,$get_img);
						$row_img = mysqli_fetch_array($run_img);
						$c_img = $row_img['customer_image'];
						$c_name = $row_img['customer_name'];
						echo "<img src='$c_img' width='110' height='120' style='margin-left:15px;'/>";
						?>
						</li>
						<li><a href="../cart.php">My orders</a></li>
						<li><a href="my_account.php?edit_account">Edit Account</a></li>
						<li><a href="my_account.php?change_pass">Change Password</a></li>
						<li><a href="my_account.php?delete_account">Delete Account</a></li>
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
						<b style="color:white;margin-left:5px;">Shopping Cart-</b> <b style="color:orange;">Total Items:</b><?php total_items();?>  <b style="color:orange;">Total Price:</b><?php total_price();?> <a href="../cart.php" style="color:skyblue;margin:0 5px;"> Go to cart</a>
						<?php
						if(!isset($_SESSION['customer_email'])){
							echo "<a href='../checkout.php' style='color:red;'>Login</a>";
						}else{
							echo "<a href='logout.php' style='color:red;'>Logout</a>";
						}
						?>
						</span>
					</div>
					
					<div id="product_box">
						
						<?php 
						if(!isset($_GET['my_orders'])){
							if(!isset($_GET['edit_account'])){
								if(!isset($_GET['change_pass'])){
									if(!isset($_GET['delete_account'])){
							
									echo "
									<h2 style='color:#9e005d;'>Welcome:$c_name</h2>
									<b>You can see your orders progress by clicking this <a href='../cart.php'>link</a></b>";
							
							
							
									}
								}
							}
						}
						?>
						<?php
						if(isset($_GET['edit_account'])){
							include("edit_account.php");
						}
						
						if(isset($_GET['change_pass'])){
							include("change_pass.php");
						}
						
						if(isset($_GET['delete_account'])){
							include("delete_account.php");
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