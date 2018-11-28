
<!DOCTYPE html>
<?php 
session_start();
include("../functions/functions.php");

$con = mysqli_connect("localhost","root","","ntfs");

if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL:".mysqli_connect_error();
}

?>
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
					<li><a href="my_account.php">My Account</a></li>
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
					<div id="sidebar_title">Categories</div>
					<ul id="categories">
						<?php getCatsPro(); ?>
					</ul>
					
					<div id="sidebar_title">Brands</div>
					<ul id="categories">
						<?php getBrandsPro(); ?>
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
					<form action="customer_register.php" method="post" enctype="multipart/form-data">
					<table align="center" width="500">
						<tr>
							<td colspan="2" align="center"><h2 style="color:#9e005d">Create an Account</h2></td>
						</tr>
						
						<tr>
							<td align="right">Customer Name:</td>
							<td align="left"><input type="text" name="customer_name" required size="40"/></td>
						</tr>
						
						<tr>
							<td align="right">Customer Email:</td>
							<td align="left"><input type="email" name="customer_email" required size="40"/></td>
						</tr>
						
						<tr>
							<td align="right">Customer Password:</td>
							<td align="left"><input type="password" name="customer_pass" required size="40"/></td>
						</tr>
						
						<tr>
							<td align="right">Customer Image:</td>
							<td align="left"><input type="file" name="customer_image" required size="40"/></td>
						</tr>
						
						<tr>
							<td align="right">Customer Country:</td>
							<td align="left">
								<select name="customer_country">
									<option>Select a country</option>
									<option>America</option>
									<option>Bangladesh</option>
									<option>India</option>
									<option>Japan</option>
									<option>China</option>
									<option>Nepal</option>
									<option>United Arab Emirates</option>
								</select>
							</td>
						</tr>
						
						<tr>
							<td align="right">Customer City:</td>
							<td align="left"><input type="text" name="customer_city" required size="40"/></td>
						</tr>
						
						<tr>
							<td align="right">Customer Contact:</td>
							<td align="left"><input type="text" name="customer_contact" required size="40"/></td>
						</tr>
						
						<tr>
							<td align="right">Customer Address</td>
							<td align="left"><input type="text" name="customer_address" required size="40"/></td>
						</tr>
						
						
						<tr>
							<td colspan="2" align="center"><input type="submit" name="register" value="Create Account" class="button"/></td>
						</tr>
						
						
					</table>
					</form>
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
<?php
	
	if(isset($_POST['register'])){
		$ip = getIp();
		$customer_id = '';
		$customer_name = $_POST['customer_name'];
		$customer_email = $_POST['customer_email'];
		$customer_pass = $_POST['customer_pass'];		
		$customer_country = $_POST['customer_country'];
		$customer_city = $_POST['customer_city'];
		$customer_contact = $_POST['customer_contact'];
		$customer_address = $_POST['customer_address'];
		
		/*$customer_image = $_FILES['customer_image']['name'];
		$customer_image_tmp = $_FILES['customer_image']['tmp_name'];
		
		move_uploaded_file($customer_image_tmp,"customer/customer_images/$customer_image");*/
		$name=$_FILES['customer_image']['name'];
		$error=$_FILES['customer_image']['error'];
		$size=$_FILES['customer_image']['size'];
		$type=$_FILES['customer_image']['type'];
		$tmp_name=$_FILES['customer_image']['tmp_name'];
		
		
		$customer_image='';
		if($error==0){
			if($size<=1024*5*500){
				$allowed_type=array('image/jpeg','image/jpg','image/png','image/pdf','image/zip');
				if(in_array($type,$allowed_type)){
					$customer_image='customer_images/'.$name;
					if(move_uploaded_file($tmp_name,$customer_image)){
						echo 'successfully uploaded';
					}else{
						echo 'unknown path';
					}
				}else{
					echo 'File type not allowed';
				}
			}else{
				echo 'File size crossed the size limit';
			}
		}else{
			echo 'No file selected';
		}
		
		
		
		$c_insert = "insert into customers(customer_id,customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image) 
		values('$customer_id','$ip','$customer_name','$customer_email','$customer_pass','$customer_country','$customer_city','$customer_contact','$customer_address','$customer_image')";
		
		$c_run = mysqli_query($con,$c_insert);
		
		$sel_cart = "select * from cart where ip_add='$ip'";
		$run_cart = mysqli_query($con,$sel_cart);
		
		$check_cart = mysqli_num_rows($run_cart);
		if($check_cart==0){
			
			$_SESSION['customer_email'] = $customer_email;
			echo "<script>alert('Registration Successful!')</script>";
			echo "<script>window.open('my_account.php','_self')</script>";
		}else{
			$_SESSION['customer_email'] = $customer_email;
			echo "<script>alert('Registration Successful!')</script>";
			echo "<script>window.open('../checkout.php','_self')</script>";
		}
		
	}
?>