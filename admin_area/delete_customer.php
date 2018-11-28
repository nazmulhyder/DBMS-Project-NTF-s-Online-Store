<?php
include("includes/db_connect.php");
if(isset($_GET['delete_c_id'])){
	$delete_c_id = $_GET['delete_c_id'];
	$query = "delete from customers where customer_id='$delete_c_id'";
	$run_query = mysqli_query($con,$query);
	
	if($run_query){
		echo "<script>alert('Customer has been deleted')</script>";
		echo "<script>window.open('view_customers.php','_self')</script>";
	}
}

?>