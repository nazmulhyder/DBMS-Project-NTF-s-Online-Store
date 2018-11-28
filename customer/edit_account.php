<?php
$con = mysqli_connect("localhost","root","","ntfs");
if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL:".mysqli_connect_error();
}


$user = $_SESSION['customer_email'];
$get_customer = "select * from customers where customer_email='$user'";
$run_customer = mysqli_query($con,$get_customer);
$row_customer = mysqli_fetch_array($run_customer);

$c_id = $row_customer['customer_id'];
$name = $row_customer['customer_name'];
$email = $row_customer['customer_email'];
$pass = $row_customer['customer_pass'];
$image = $row_customer['customer_image'];
$country = $row_customer['customer_country'];
$city = $row_customer['customer_city'];
$contact = $row_customer['customer_contact'];
$address = $row_customer['customer_address'];

?>

<form action="" method="post" enctype="multipart/form-data" width="800">
	<table align="center"   style="margin:0 auto;max-width:650;">
		<tr>
			<td colspan="3" align="center"><h2 style="color:#9e005d">Update Your  Account</h2></td>
		</tr>
		
		<tr>
			<td align="right">Customer Name:</td>
			<td align="left" colspan="2"><input type="text" name="c_name" value="<?php echo $name;?>" size="40"/></td>
		</tr>
		
		<tr>
			<td align="right">Customer Email:</td>
			<td align="left" colspan="2"><input type="email" name="c_email" value="<?php echo $email;?>" size="40"/></td>
		</tr>
		
		<tr>
			<td align="right">Customer Password:</td>
			<td align="left" colspan="2"><input type="password" name="c_pass" value="<?php echo $pass;?>" size="40"/></td>
		</tr>
		
		<tr>
			<td align="right">Customer Image:</td>
			<td align="left"><input type="file" name="c_image"/></td><td><img src="<?php echo $image;?>" width="50" height="50"/></td>
		</tr>
		
		<tr>
			<td align="right">Customer Country:</td>
			<td align="left" colspan="2">
				<select name="c_country" disabled style="width:267px;">
					<option><?php echo $country;?></option>
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
			<td align="left" colspan="2"><input type="text" name="c_city" value="<?php echo $city; ?>" size="40"/></td>
		</tr>
		
		<tr>
			<td align="right">Customer Contact:</td>
			<td align="left" colspan="2"><input type="text" name="c_contact" value="<?php echo $contact;?>" size="40"/></td>
		</tr>
		
		<tr>
			<td align="right">Customer Address</td>
			<td align="left" colspan="2"><input type="text" name="c_address" value="<?php echo $address;?>" size="40"/></td>
		</tr>
		
		
		<tr>
			<td colspan="3" align="center"><input type="submit" name="update_data" value="Update Account" class="button"/></td>
		</tr>
		
		
	</table>
</form>

<?php
	
	if(isset($_POST['update_data'])){
		$ip = getIp();
		$cust_id = $c_id;
		$c_name = $_POST['c_name'];
		$c_email = $_POST['c_email'];
		$c_pass = $_POST['c_pass'];		
		/*$c_image = $_FILES['c_image']['name'];
		$c_image_tmp = $_FILES['c_image']['tmp_name'];*/
		//$customer_country = $_POST['customer_country'];
		$c_city = $_POST['c_city'];
		$c_contact = $_POST['c_contact'];
		$c_address = $_POST['c_address'];
		
		$name=$_FILES['c_image']['name'];
		$error=$_FILES['c_image']['error'];
		$size=$_FILES['c_image']['size'];
		$type=$_FILES['c_image']['type'];
		$tmp_name=$_FILES['c_image']['tmp_name'];
		
		
		$customer_image='';
		if($error==0){
			if($size<=1024*5*500){
				$allowed_type=array('image/jpeg','image/jpg','image/png','image/pdf','image/zip');
				if(in_array($type,$allowed_type)){
					$customer_image='customer_images/'.$name;
					if(move_uploaded_file($tmp_name,$customer_image)){
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
			echo 'No image file selected';
		}
		
		//move_uploaded_file($c_image_tmp,"../customer_images/$c_image");
		
		$cust_update = "UPDATE customers SET customer_name='$c_name',customer_email='$c_email',customer_pass='$c_pass',customer_image='$customer_image',
		customer_city='$c_city',customer_contact='$c_contact',customer_address='$c_address' where customer_id='$cust_id'";
		
		$run_update = mysqli_query($con,$cust_update);
		if($run_update){
			echo "<script>alert('Your account successfully updated')</script>";
			//echo "<script>window.open('my_account.php','_self')</script>";
		
		}else{
			echo "<script>alert('Your account not updated')</script>";
			//echo mysql_error();
		}
		
	}
?>