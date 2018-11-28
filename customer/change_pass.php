<form action="" method="post" width="800">
	<table width="450"  style="margin:0 auto;">
		<tr>
		<td colspan="2"><h2 style="color:#9e005d">Change Your Password</h2></td>
		</tr>
		
		<tr>
			<td align="right"><b >Enter Current Password:</b></td>
			<td align="left"><input type="password" name="current_pass" required/></td>
		</tr>
		
		<tr>
			<td align="right"><b>Enter New Password:</b></td>
			<td align="left"><input type="password" name="new_pass" required/></td>
		</tr>
		
		<tr>
			<td align="right"><b>Enter New Password Again:</b></td>
			<td align="left"><input type="password" name="new_pass_again" required/></td>
		</tr>
		
		<tr>
			<td colspan="2"><input type="submit" name="change_pass" value="Change Password" class="button"/></td>
		</tr>
	</table>
</form>

<?php
$con = mysqli_connect("localhost","root","","ntfs");

if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL:".mysqli_connect_error();
}


if(isset($_POST['change_pass'])){
	//$ip = getIp();
	$user = $_SESSION['customer_email'];
	
	$current_pass = $_POST['current_pass'];
	$new_pass = $_POST['new_pass'];
	$new_again = $_POST['new_pass_again'];
	
	$change_pass = "select * from customers where customer_pass='$current_pass' AND customer_email='$user'";
	$run_pass = mysqli_query($con,$change_pass);
	$check_pass = mysqli_num_rows($run_pass);
	
	if($check_pass==0){
		echo "<script>alert('Your Current Password is wrong!')</script>";
	exit();
	}
	
	if($new_pass!=$new_again){
		echo "<script>alert('New Password does not match!')</script>";
	exit();
	}else{
		$update_pass = "update customers set customer_pass='$new_pass' where customer_email='$user'"; 
		$run_update = mysqli_query($con,$update_pass);
		
		echo "<script>alert('Your Password was updated successfully!')</script>";
		echo "<script>window.open('my_account.php','_self')</script>"; 
	
	}
}

?>