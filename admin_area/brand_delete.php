<?php
include("includes/db_connect.php");
if(isset($_GET['delete_brand_id'])){
	$delete_brand_id = $_GET['delete_brand_id'];
	$query = "delete from brands where brand_id='$delete_brand_id'";
	$run_query = mysqli_query($con,$query);
	
	if($run_query){
		echo "<script>alert('Category has been deleted')</script>";
		echo "<script>window.open('view_brand.php','_self')</script>";
	}
}

?>