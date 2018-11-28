<?php
include("includes/db_connect.php");
if(isset($_GET['delete_cat_id'])){
	$delete_cat_id = $_GET['delete_cat_id'];
	$query = "delete from categories where cat_id='$delete_cat_id'";
	$run_query = mysqli_query($con,$query);
	
	if($run_query){
		echo "<script>alert('Category has been deleted')</script>";
		echo "<script>window.open('view_cat.php','_self')</script>";
	}
}

?>