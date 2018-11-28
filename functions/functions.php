<?php 

$con = mysqli_connect("localhost","root","","ntfs");
if(mysqli_connect_errno()){
	echo "Failed to connect to MySQL:".mysqli_connect_error();
}


/*****getting the user ip address*****/
function getIp() {

    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $ip;
}


/*********creating the shopping cart*************/
function cart(){
	if(isset($_GET['add_cart'])){
		
		global $con;
		
		$ip = getIp();
		$pro_id = $_GET['add_cart'];
		
		$check_pro = "select * from cart where ip_add='$ip' AND p_id='$pro_id'";
		$run_check = mysqli_query($con,$check_pro);
		
		if(mysqli_num_rows($run_check)>0){
			echo "";
		}else{
			$insert_pro = "insert into cart(p_id,ip_add) values('$pro_id','$ip')";
			$run_pro = mysqli_query($con, $insert_pro);
			
			echo "<script>window.open('index.php','_self')</script>";
		}
	}
}
/*********************for all products.php page cart item show************************/
function allProCart(){
	if(isset($_GET['add_cart'])){
		
		global $con;
		
		$ip = getIp();
		$pro_id = $_GET['add_cart'];
		
		$check_pro = "select * from cart where ip_add='$ip' AND p_id='$pro_id'";
		$run_check = mysqli_query($con,$check_pro);
		
		if(mysqli_num_rows($run_check)>0){
			echo "";
		}else{
			$insert_pro = "insert into cart(p_id,ip_add) values('$pro_id','$ip')";
			$run_pro = mysqli_query($con, $insert_pro);
			
			echo "<script>window.open('all_products.php','_self')</script>";
		}
	}
}

/***************************/
/***********getting the total added items***************/

function total_items(){
	
	if(isset($_GET['add_cart'])){
		
		global $con;
		
		$ip = getIp();
		
		$get_items = "select * from cart where ip_add='$ip'";
		$run_items = mysqli_query($con,$get_items);
		$count_items = mysqli_num_rows($run_items);
		
	}else{
		global $con;
		$ip = getIp();
	
		$get_items = "select * from cart where ip_add='$ip'";
		$run_items = mysqli_query($con,$get_items);
		$count_items = mysqli_num_rows($run_items);
	}
	echo $count_items;
}
/************getting the total price***************/

function total_price(){
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
			$values = array_sum($product_price);
			$total = $total + $values;
			
		}
	}
	echo "$".number_format("$total",2);
	
}
/********function for categories********************/
function getCats(){
	
	global $con;
	
	$get_cats = "select * from categories";
	
	$query_cats = mysqli_query($con,$get_cats);
	
	while($row_cats = mysqli_fetch_array($query_cats)){
		
		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_title'];
		
		echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
	}
}


/**************function for brands********************/
function getBrands(){
	
	global $con;
	
	$get_brands = "SELECT * FROM brands";
	
	$query_brands = mysqli_query($con,$get_brands);
	
	while($row_brands = mysqli_fetch_array($query_brands)){
		
		$brand_id = $row_brands['brand_id'];
		$brand_title = $row_brands['brand_title'];
		echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
	}
}

/************function for product display*******************/

function getPro(){
	if(!isset($_GET['cat'])){
		if(!isset($_GET['brand'])){
			global $con;
			
			
			$get_pro = "select * from products where product_id between 1 and 7";
			$query_pro = mysqli_query($con,$get_pro);
			
			while($row_pro = mysqli_fetch_array($query_pro)){
				$pro_id = $row_pro['product_id'];
				$pro_title = $row_pro['product_title'];
				$pro_cat = $row_pro['product_cat'];
				$pro_brand = $row_pro['product_brand'];
				$pro_price = $row_pro['product_price'];
				$pro_image = $row_pro['product_image'];

				echo "<div class='product'>
						 <div class='product-a'>
							 <img src='admin_area/$pro_image'/>
						 </div>
						 <div class='product-b'>
							 <h3>$pro_title</h3>
						 </div>
						 <div class='product-c'>
							 <h3><b>Price:</b> $".number_format("$pro_price",2)."</h3>
						 </div>
						 <div class='quick'><a href='details.php?pro_id=$pro_id'><h3>Quick View</h3></a></div>
						 <div class='addtocart'><a href='index.php?add_cart=$pro_id'><div id='add_button'>Add to cart</div></a></div>
						 <div class='clear-fixed'></div>
					   </div>";
				
				
			}
		}
	}
}
/********************************************/


/***************getting category based products******************************/

function getCatPro(){
	if(isset($_GET['cat'])){
		$cat_id = $_GET['cat'];
		global $con;
		
		$get_cat_pro = "select * from products where product_cat='$cat_id'";
		$query_cat_pro = mysqli_query($con,$get_cat_pro);
		$count_cat_pro = mysqli_num_rows($query_cat_pro);
		
		if($count_cat_pro==0){
			echo '<h2>There is no product in this category to view.</h2>';
		}
		
		while($row_cat_pro = mysqli_fetch_array($query_cat_pro)){
			$pro_id = $row_cat_pro['product_id'];
			$pro_title = $row_cat_pro['product_title'];
			$pro_cat = $row_cat_pro['product_cat'];
			$pro_brand = $row_cat_pro['product_brand'];
			$pro_price = $row_cat_pro['product_price'];
			$pro_image = $row_cat_pro['product_image'];

			echo "<div class='product'>
					 <div class='product-a'>
						 <img src='admin_area/$pro_image'/>
					 </div>
					 <div class='product-b'>
						 <h3>$pro_title</h3>
					 </div>
					 <div class='product-c'>
						 <h3><b>Price:</b> $".number_format("$pro_price",2)."</h3>
					 </div>
					 <div class='quick'><a href='details.php?pro_id=$pro_id'><h3>Quick View</h3></a></div>
					 <div class='addtocart'><a href='index.php?add_cart=$pro_id'><div id='add_button'>Add to cart</div></a></div>
					 <div class='clear-fixed'></div>
				   </div>";
					
			
			
		}

	}
}

/***********getting brand based products*************/
function getBrandPro(){
	if(isset($_GET['brand'])){
		$brand_id = $_GET['brand'];
		global $con;
		
		$get_brand_pro = "select * from products where product_brand='$brand_id'";
		$query_brand_pro = mysqli_query($con,$get_brand_pro);
		$count_brand_pro = mysqli_num_rows($query_brand_pro);
		
		if($count_brand_pro==0){
			echo '<h2>There is no product of this brand to view.</h2>';
			
		}
		
		while($row_brand_pro = mysqli_fetch_array($query_brand_pro)){
			$pro_id = $row_brand_pro['product_id'];
			$pro_title = $row_brand_pro['product_title'];
			$pro_cat = $row_brand_pro['product_cat'];
			$pro_brand = $row_brand_pro['product_brand'];
			$pro_price = $row_brand_pro['product_price'];
			$pro_image = $row_brand_pro['product_image'];

			echo "<div class='product'>
					 <div class='product-a'>
						 <img src='admin_area/$pro_image'/>
					 </div>
					 <div class='product-b'>
						 <h3>$pro_title</h3>
					 </div>
					 <div class='product-c'>
						 <h3><b>Price:</b> $".number_format("$pro_price",2)."</h3>
					 </div>
					 <div class='quick'><a href='details.php?pro_id=$pro_id'><h3>Quick View</h3></a></div>
					 <div class='addtocart'><a href='index.php?add_cart=$pro_id'><div id='add_button'>Add to cart</div></a></div>
					 <div class='clear-fixed'></div>
				   </div>";
			
			
		}

	}
}

/*********/
/********function for categories********************/
function getCatsPro(){
	
	global $con;
	
	$get_cats = "select * from categories";
	
	$query_cats = mysqli_query($con,$get_cats);
	
	while($row_cats = mysqli_fetch_array($query_cats)){
		
		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_title'];
		
		echo "<li><a href='../index.php?cat=$cat_id'>$cat_title</a></li>";
	}
}


/**************function for brands********************/
function getBrandsPro(){
	
	global $con;
	
	$get_brands = "SELECT * FROM brands";
	
	$query_brands = mysqli_query($con,$get_brands);
	
	while($row_brands = mysqli_fetch_array($query_brands)){
		
		$brand_id = $row_brands['brand_id'];
		$brand_title = $row_brands['brand_title'];
		echo "<li><a href='../index.php?brand=$brand_id'>$brand_title</a></li>";
	}
}

/************function for product display*******************/