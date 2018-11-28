<?php
session_start();

if(!isset($_SESSION['admin_email']))
{
	header("Location:login.php");
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
					<form action="insert_product.php" method="post" enctype="multipart/form-data">
						<table align="center" width="700"    style="color:#000;">
							
							<tr align="center">
								<td colspan="2" style="padding:10px 0 20px 0;"><h1 style="color:#9e005d;text-decoration:underline;">Insert Product Here</h1></b></td>
							</tr>
							
							<tr>
								<td align="left" style="color:#9e005d;"><b>Product Title:</b></td>
								<td><input type="text" name="product_title" size="60" required/></td>
							</tr>
							
							<tr>
								<td align="left" style="color:#9e005d;"><b>Product Category:</b></td>
								<td>
									<select name="product_cat">
										<option>Select Category</option>
										<?php 
											
											$get_cats = "select * from categories";
											
											$query_cats = mysqli_query($con,$get_cats);
											
											while($row_cats = mysqli_fetch_array($query_cats)){
												
												$cat_id = $row_cats['cat_id'];
												$cat_title = $row_cats['cat_title'];
												
												echo "<option value='$cat_id'>$cat_title</option>";
											}
										
										?>
									</select>
								</td>
							</tr>
							
							<tr>
								<td align="leftt" style="color:#9e005d;"><b>Product Brand:</b></td>
								<td>
									<select name="product_brand">
										<option>Select Brand</option>
										<?php 
											
											$get_brands = "SELECT * FROM brands";
				
											$query_brands = mysqli_query($con,$get_brands);
											
											while($row_brands = mysqli_fetch_array($query_brands)){
												
												$brand_id = $row_brands['brand_id'];
												$brand_title = $row_brands['brand_title'];
																			
												echo "<option value='$brand_id'>$brand_title</option>";
											}
										
										?>
									</select>
								</td>
							</tr>
							
							<tr>
								<td align="left" style="color:#9e005d;"><b>Product Image:</b></td>
								<td><input type="file" name="product_image" required/></td>
							</tr>
							
							<tr>
								<td align="left" style="color:#9e005d;"><b>Product Price:</b></td>
								<td><input type="text" name="product_price" size="60" required/></td>
							</tr>
							
							<tr>
								<td align="left" style="color:#9e005d;"><b>Product Description:</b></td>
								<td><textarea name="product_desc" cols="40" rows="10"></textarea></td>
							</tr>
							
							<tr>
								<td align="left" style="color:#9e005d;"><b>Product Keywords:</b></td>
								<td><input type="text" name="product_keywords" size="60" size="60" required/></td>
							</tr>
							
							<tr align="center">
								<td colspan="2" style="padding:20px 0 20px 0;"><input type="submit" name="insert_post" value="Insert Product Now" size="60" required style="background:#9e005d;color:white;padding:5px 15px;font-size:16px;"/></b></td>
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

	if(isset($_POST['insert_post'])){
		$product_id = '';
		//get the text data from the input fields
		$product_title = $_POST['product_title'];
		$product_cat = $_POST['product_cat'];
		$product_brand = $_POST['product_brand'];
		$product_price = $_POST['product_price'];
		$product_desc = $_POST['product_desc'];
		$product_keywords = $_POST['product_keywords'];
			
		$name=$_FILES['product_image']['name'];
		$error=$_FILES['product_image']['error'];
		$size=$_FILES['product_image']['size'];
		$type=$_FILES['product_image']['type'];
		$tmp_name=$_FILES['product_image']['tmp_name'];
		
		
		$product_image='';
		if($error==0){
			if($size<=1024*5*500){
				$allowed_type=array('image/jpeg','image/jpg','image/png','image/pdf','image/zip');
				if(in_array($type,$allowed_type)){
					$product_image='product_images/'.$name;
					if(move_uploaded_file($tmp_name,$product_image)){
						echo '';
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
		
		$insert_product = "insert into products
		(product_id,product_title,product_cat,product_brand,product_image,product_price,product_desc,product_keywords) values('$product_id','
		$product_title','$product_cat','$product_brand','$product_image','$product_price','$product_desc','$product_keywords')";
		
		$insert_pro = mysqli_query($con,$insert_product);
		
		if($insert_pro){
			echo "<script>alert('Product has been inserted')</script>";
			echo "<script>window.open('insert_product.php','_self')</script>";
		}
	
	}

?>