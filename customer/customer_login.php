<?php

$con = mysqli_connect("localhost","root","","ntfs");

if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL:".mysqli_connect_error();
}
?>

<div>
	<form action="" method="post" style="width:400px;margin:20px auto">
		<table width="400" height="250">
			<tr >
				<td colspan="2"><h2 style="color:#9e005d">Login or registration to Buy!</h2></td>
			</tr>
			
			<tr>
				<td  align="right"><b>Email:</b></td>
				<td align="left"><input type="email" name="email" placeholder="Enter email" required size="40"/></td>
			</tr>
			
			<tr>
				<td align="right"><b>Password:</b></td>
				<td align="left"><input type="password" name="pass" placeholder="Enter password" required size="40"/></td>
			</tr>
			
			<tr>
				<td  colspan="2"><a href="checkout.php?forgot_pass" style="float:left">Forgot password?</a>
				<a href="customer/customer_register.php" style="float:right">New? Register Here</a></td>
			</tr>
			
			<tr>
				<td colspan="2"><input type="submit" name="login" value="Login" class="button"/></td>
			</tr>
		</table>
	
	</form>
</div>

<?php
if(isset($_POST['login'])){
	$customer_email = $_POST['email'];
	$customer_pass = $_POST['pass'];
	
	$sel_customer = "select * from customers where customer_email='$customer_email' AND customer_pass='$customer_pass'";
	$run_customer = mysqli_query($con,$sel_customer);
	
	$check_customer = mysqli_num_rows($run_customer);
	
	if($check_customer==0){
		echo "<script>alert('Password or email is incorrect')</script>";
		exit();
	}
	$ip=getIp();
	$sel_cart = "select * from cart where ip_add='$ip'";
	$run_cart = mysqli_query($con,$sel_cart);
	
	$check_cart = mysqli_num_rows($run_cart);
	if($check_customer>0 AND $check_cart==0){
		
		$_SESSION['customer_email'] = $customer_email;
		echo "<script>alert('You logged in successfully, Thanks!')</script>";
		echo "<script>window.open('customer/my_account.php','_self')</script>";
		
	}else{
		$_SESSION['customer_email'] = $customer_email;
		echo "<script>alert('You logged in successfully, Thanks!')</script>";
		echo "<script>window.open('checkout.php','_self')</script>";
	}
}
?>