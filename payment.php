<?php
$con = mysqli_connect("localhost","root","","ntfs");
if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL:".mysqli_connect_error();
}

	$total = 0;
	global $con;
	
	$ip = getIp();
	$sel_price = "select * from cart where ip_add='$ip'";
	$run_price = mysqli_query($con,$sel_price);
	
	while($p_price=mysqli_fetch_array($run_price)){
		$pro_id = $p_price['p_id'];
		$pro_price = "select * from products where product_id='$pro_id'";
		$run_pro_price = mysqli_query($con,$pro_price);
		while($pp_price=mysqli_fetch_array($run_pro_price)){
			$product_price = array($pp_price['product_price']);
			$product_name = $pp_price['product_title'];
			$values = array_sum($product_price);
			$total = $total + $values;
			
		}
	}
?>

<div>
	<h2 align="center"> we are sorry  :( Payment Option in progress..... </h2>	
</div>