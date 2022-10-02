<?php
	
	//start session
    session_start();
	
	include_once('connection.php');
    mysqli_select_db($conn,'sessionpractical');
    error_reporting(0);
	
	// checking user email from session variable
	if(!isset($_SESSION['user_id'])){
		
		header('location:admin-login');
	}
	
	$user_email = "";
	$user_hashpass = "";
	
	if(isset($_SESSION['user_email']) && isset($_SESSION['user_hashpass']) ){
		
		$user_email = $_SESSION['user_email'];
		$user_hashpass = $_SESSION['user_hashpass'];
	}
	
	$query = "SELECT * FROM admininfo where email='$user_email' && password='$user_hashpass'";
	$results = mysqli_query($conn, $query);

	if (mysqli_num_rows($results) == 1) {

		// echo "found";
	} else {
		
		header('location:admin-login');
		// echo "not found";
	}



	//Getting all catagory and subcatagories.....................
	$all_items = "";
	$item_index = "";
	
	$query="SELECT serial, type, main_item, sub_item, img_path FROM itemdetails ORDER BY serial ASC";
	$r=mysqli_query($conn,$query);
	
	$strt = false;
	
	$total_items = mysqli_num_rows($r);
	if(mysqli_num_rows($r) > 0){
		
		while($row=mysqli_fetch_array($r)){
			
			//showing data in html div 
			if($strt == false){
				$strt=true;
				$all_items = $all_items.$row["sub_item"];
				$item_index = $item_index.$row["serial"];
			}
			else{
				$all_items = $all_items."+".$row["sub_item"];
				$item_index = $item_index."+".$row["serial"];
			}
			// $row["main_item"];
		}
		
		
	}







	//getting variable from html form
	$product_name = addslashes($_POST['product_name']);
	$product_catagory = addslashes($_POST['product_catagory']);
	$product_sub_catagory = addslashes($_POST['product_sub_catagory']);
	$product_description = addslashes($_POST['product_description']);

	// echo $product_name;
	// echo $product_catagory;
	// echo $product_sub_catagory;
	// echo $product_description;
	// return;
	//if click upload button
	if(isset($_POST['upload_btn'])){
		
		// echo $product_sub_catagory;
		// return;
		
        if ($product_name!="")
        {
			$date=date("Y-m-d h:i:sa");
			$qy="insert into products (name, catagory, sub_catagory, description, upload_date, available) values ('$product_name','$product_catagory','$product_sub_catagory','$product_description','$date', '1')";
            mysqli_query($conn,$qy);
			header('location:admin-product.php');
        }
		else{
			
		}
    }

?>



<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Bootstrap CSS -->
   <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href="css/admin-upload-product.css" rel="stylesheet">

	
   <!-- <link href="css/body.css" rel="stylesheet"> -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
   
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&amp;family=Playfair+Display:wght@400;700&amp;display=swap" rel="stylesheet">
   
   <title>Soliloquy</title>
   <!-- <link rel="icon" href="image/logo/fav-icon.png" type="image/gif" sizes="16x16"> -->
  
   
</head>

<body>

	<div class="container-fluid">
		<div class="row">
			<div class="navbar">
			
				<div class="logo">
					Soliloquy
				</div>
			
				<div class="nav-only">
					<ul>
					
					
						<li><a href="admin" style="color:white"><div class="nav-item-left"><i class="fa fa-home" aria-hidden="true"></i> Home</div></a></li>
						<li><a href="admin-slide" style="color:#BAF323"><div class="nav-item-right"><i class="fa fa-briefcase" aria-hidden="true"></i> Slides</div></a></li>
						<li><a href="admin-product" style="color:#BAF323"><div class="nav-item-right"><i class="fa fa-briefcase" aria-hidden="true"></i> Items</div></a></li>
						<li style="color:white">|</li>
						<li><a href="logout_admin" style="color:orange"><div class="nav-item-right logout"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</div></a></li>
						
						
					</ul>
				</div>
			</div>
			
			<div class="main-part-1">
				
				<div class="row extra-top">
					
					<div class="col-lg item-upload">
					
						<label>Upload Post</label>

						<form method="post" enctype="multipart/form-data">
						
							<!-- <input type="file" name="image" class="upload-info"> -->
							<input class="upload-info" type="text" name="product_name" placeholder="Product name">
							
							<!-- <input class="upload-info" type="text" name="product_catagory" placeholder="Product catagory"> -->
							
							<select class="upload-info" name="product_catagory" id="maincat_selector">
							  
							</select>
							
							<select class="upload-info" name="product_sub_catagory" id="subcat_selector">
							  
							</select>
							
							<!-- <input class="upload-info" type="text" name="product_sub_catagory" placeholder="Product sub-catagory"> -->
							<textarea class="upload-info text-area-box" name="product_description" placeholder="Product description"></textarea>
							
							<input type="submit" name="upload_btn" value="upload" id="upload_input_submit"/> 
							
						</form>
						
					</div>
					
					
				</div>
				
				<div class="container-fluid body-parent">
				
					<div class="row body-child" id="items-show-bound">
							<?php
								$query="SELECT id FROM products";
								$r=mysqli_query($conn,$query);
								$total_post = mysqli_num_rows($r);
							?>
						<div class="col-lg-12 title-text">Total Posts: <?php echo $total_post;?></div>
							<?php
							
							$page_index = $_GET['pageindex'];

							// echo $page_index=10;
							if(isset($page_index)){
								
								// echo "ok";
							}else{
								
								// echo "undefined";
								$page_index=1;
							}
							
							
							$max_item_show = (int)20;
							$start_post_indx = ($page_index - 1)*$max_item_show;
							// echo $start_post_indx;
							// echo $max_item_show;
							
							//query for showing slides which is available
							$query="SELECT id,path,name FROM products ORDER by id DESC LIMIT $start_post_indx,$max_item_show";
							// SELECT * FROM products WHERE available=1 ORDER by id ASC LIMIT 0,5;
							$r=mysqli_query($conn,$query);
							// $total_post = mysqli_num_rows($r);
							//checking if at least 1 data found or not
							if(mysqli_num_rows($r) > 0){
								
								//if found the extract row by colomns and show in html div
								
								$max_count = 0;
								while($row=mysqli_fetch_array($r)){
									
									if($max_count >= $max_item_show){
										break;
									}
									
									//showing data in html div 
									echo '<div class="col-lg-3 col-md-4 col-sm-6 item-box">
											<a href="admin-product-view?id='.$row["id"].'">
												<div class="item-holder">
													<div class="item-img"><img src="'.$row["path"].'" alt="" height="100%" width="100%" /></div>
													<div class="item-name">'.$row["name"].'</div>
												</div>
											</a>
										</div>';
									
									$max_count++;
								}
								
							}
							else{ 
							
								//if no item found in database
								echo '<div class="col-lg-12 no-items">No products uploaded yet!!!</div>';
								
							}
								
						?>
					</div>	
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
	<?php
		
		//query for showing slides which is available
		$total_page = $total_post/$max_item_show;
		// echo $total_page;
		if($total_page == 0){
			
			$total_page = 1;
		}
		else{
			$total_page = ceil($total_page);
		}
		// echo $total_page;
	?>
	<div class="container-fluid tradingpage-part-container">
		<div class="row tradingpage-part-row">
			<div class="trading-page-holder">
				
				<?php 
				for($i=1;$i<=$total_page;$i++){
				?>
				<div name="<?php echo $i;?>" class="trade-pages<?php if($page_index==$i){ echo " active-trade-pages"; }?>">Page <?php echo $i;?></div>
				<?php 
				}
				?>
			</div>
		</div>
	</div>
	
		

   <!-- JavaScript -->
   <script type="text/javascript" src="script/jquery-3.5.1.min.js"></script>
   <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="script/sweetalert.min.js"></script>
   
   
   <script type="text/javascript">
		
		
		// $("#maincat_selector option:contains(Option 2)").attr('selected', 'selected');
		// $('#maincat_selector', 'testing').attr('selected', 'selected');
		// var newOption = new Option("option text", "value");
		// $(o).html("option text");
		// $("#maincat_selector").append(o);
		
		
		var all_cat_subcat_split = '<?php echo $all_items; ?>';
		var cat_subcat_indx_split = '<?php echo $item_index; ?>';
		
		var all_cat_subcat_array = all_cat_subcat_split.split('+');
		var cat_subcat_indx_array = cat_subcat_indx_split.split('+');
		
		var MainCatagory = [];
		var SubCatagory = [];
		var ItemCount = 0;
		var temp = 0;
		
		for(var i=0;i<cat_subcat_indx_array.length;){
			
			temp = Math.floor(cat_subcat_indx_array[i]);
			var main_pass = false;
			var subcat_temp = [];
			while(temp == Math.floor(cat_subcat_indx_array[i])){
				
				if(main_pass==false){
					main_pass=true;
					
					MainCatagory.push(all_cat_subcat_array[i]);
					
					ItemCount++;
					i++;
					continue;
				}
				
				// main_cat.push(cat_subcat_indx_array[i]);
				// ItemArray[ItemCount].push([all_cat_subcat_array[i]]);
				subcat_temp.push(all_cat_subcat_array[i]);
				
				i++;
			}
			
			SubCatagory.push(subcat_temp);
			// break;
			
			
		}
		
		
		for(var i=0;i<MainCatagory.length;i++){
			
			var newOption = new Option(MainCatagory[i], MainCatagory[i]);
			$(newOption).html(MainCatagory[i]);
			$(newOption).attr('name',i);
			$("#maincat_selector").append(newOption);
			
		}
		
		Subcatselector_change(0);
		// $('#maincat_selector option[value="0"]').attr("selected",true);
		// var selected_Cat_value = $("#maincat_selector").children("option:selected").val();
		// var selected_Cat_value = $("#maincat_selector").children("option:selected").attr('name');
		// console.log(selected_Cat_value);
		
		$("#maincat_selector").change(function() {
			
			var selected_Cat_value = $(this).children("option:selected").attr('name');
			// console.log(selected_Cat_value);
			Subcatselector_change(selected_Cat_value);
			
		});
		
		
		// console.log(SubCatagory[0][1]);
		
		function Subcatselector_change(maincat_ind){
			
			$('#subcat_selector').find('option').remove();
			
			for(var i=0;i<SubCatagory[maincat_ind].length;i++){
				
				// console.log(SubCatagory[maincat_ind][i]);
				var newOption = new Option(SubCatagory[maincat_ind][i], SubCatagory[maincat_ind][i]);
				$(newOption).html(SubCatagory[maincat_ind][i]);
				$(newOption).attr('name',SubCatagory[maincat_ind][i]);
				$("#subcat_selector").append(newOption);
				
			}
			
		}
		
		
		$('.trade-pages').click(function() {
		  
		  
			var page_selected = $(this).attr("name");
			location.href = 'admin-product?pageindex='+page_selected;
			
			
		});
		
		// console.log(MainCatagory);
		// console.log(SubCatagory);
		// console.log(all_cat_subcat_array);
		// console.log(cat_subcat_indx_array);
		
		
	</script>
   

</body>

</html>
