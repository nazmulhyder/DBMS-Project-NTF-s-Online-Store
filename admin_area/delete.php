<?php
include("includes/db_connect.php");
if(isset($_GET['delete_pro_id'])){
	$delete_product_id = $_GET['delete_pro_id'];
	$query = "delete from products where product_id='$delete_product_id'";
	$run_query = mysqli_query($con,$query);
	
	if($run_query){
		echo "<script>alert('Product has been deleted')</script>";
		echo "<script>window.open('view_product.php','_self')</script>";
	}
}

?>