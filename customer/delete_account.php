<br/>
<br/>
<form action="" method="post" width="800">
	<table width="450"  style="margin:0 auto;height:100px;">
		<tr>
		<td colspan="2"><h3 style="color:#9e005d">Do you really want to Delete your account?</h3></td>
		</tr>
		
		<tr>
			<td align="right"><input type="submit" name="yes" value="Yes I want" class="button"/></td>
			<td align="left"><input type="submit" name="no" value="No I was Joking" class="button"/></td>
		</tr>
	</table>
</form>

<?php 
$con = mysqli_connect("localhost","root","","ntfs");

if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL:".mysqli_connect_error();
}

$user = $_SESSION['customer_email'];

if(isset($_POST['yes'])){
	$delete = "delete from customers where customer_email='$user'";
	$run_delete = mysqli_query($con,$delete);
	
	echo "<script>alert('We are really sorry, your account has been deleted!')</script>";
	echo "<script>window.open('../index.php','_self')</script>";
}

if(isset($_POST['no'])){
	
	echo "<script>alert('Oh! DO not joke again!')</script>";
	echo "<script>window.open('my_account.php','_self')</script>";
}

?>