<?php
	session_start(); 
	include("includes/db_connect.php");
	if(isset($_POST['login'])){
		
		$admin_email=$_POST['admin_email'];
		
		$admin_password=$_POST['admin_password'];

		$query="SELECT * FROM admin WHERE admin_email='$admin_email' AND admin_password='$admin_password' ";
		
		$run_query = mysqli_query($con,$query);
		
		$row=mysqli_fetch_array($run_query);
		
		if($run_query && mysqli_num_rows($run_query)>0){
			//echo 'successfully login';
			$_SESSION['admin_email']=$admin_email;
			$_SESSION['admin_id']=$row['admin_id'];
			$_SESSION['admin_name']=$row['admin_name'];
			echo "<script>window.open('index.php?logged_in=You Have Successfully Logged In!','_self')</script>"; 
		}
		else
		{
			echo "<script>alert('You are not admin!')</script>";
		}
	
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>NTF's Admin Panel</title>
		<link rel="icon" type="image" href="../images/ntf.png"/>
		<link rel="stylesheet" type="text/css" href="style.css"/>

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
			<div style="background:url('background3.jpg') no-repeat;background-size: cover;background-attachment:fixed;background-position:top;margin:0;width:1000px;height:400px;">
				


				<form action="" method="post" style="width:400px;margin:0px auto;padding:20px 0;">
					<table width="400" height="250" >
						<tr >
							<td colspan="2"><h2 style="color:#9e005d;text-align:center;text-decoration:underline;">Admin login</h2></td>
						</tr>
						
						<tr>
							<td  align="right" style="color:#9e005d;"><b>Email:</b></td>
							<td align="left"><input type="email" name="admin_email" placeholder="Enter email" required size="40"/></td>
						</tr>
						
						<tr>
							<td align="right" style="color:#9e005d;"><b>Password:</b></td>
							<td align="left"><input type="password" name="admin_password" placeholder="Enter password" required size="40"/></td>
						</tr>
						
						<tr>
							<td colspan="2" align="center"><input type="submit" name="login" value="Login" style="background:#9e005d;color:white;padding:5px 15px;font-size:16px;cursor:pointer;"/></td>
						</tr>
					</table>
				
				</form>
			</div>
			
			<!--footer starts here -->
			<div id="footer">&copy-2016, All rights goes to NTF's Ecommerce Site.</div>
			<!--footer ends here -->
		
		</div>
	<!--Main container ends here -->
	
	</body>
</html>