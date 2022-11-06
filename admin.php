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


	//getting variable from html form
	$product_name = $_POST['product_name'];
	$product_catagory = $_POST['product_catagory'];
	$product_sub_catagory = $_POST['product_sub_catagory'];
	$product_description = $_POST['product_description'];
	
	$sub_serial = 0;

	//if click upload button
	if(isset($_POST['upload_btn'])){
		
		// echo $product_description;
		
		// return;
		
		//checking if product details are not empty
        if ($product_name!="" && $product_catagory!="" && $product_sub_catagory!="" && $product_description!="")
        {
            
			//total product count
			$query="SELECT * FROM products";
			$r=mysqli_query($conn,$query);	
			
			//add 1 to new product number
			$product_number = (mysqli_num_rows($r)+1);
			
			$image = $_FILES['image']['name'];

			// image file directory
			$target = "products/".$product_number.'_'.basename($image);

			if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
				// $msg = "Image uploaded successfully";
			}else{
				// $msg = "Failed to upload image";
			}
			
			//query for inserting the image details in database
			date_default_timezone_set("UTC");
			$date=date("Y-m-d H:i:s", time());
			
			$qy="insert into products (name, path, catagory, sub_catagory, description, upload_date, available) values ('$product_name','$target','$product_catagory','$product_sub_catagory','$product_description','$date', '1')";
            mysqli_query($conn,$qy);
			
			//go to this page
			header('location:admin-upload-product.php');
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
   <link href="css/admin.css" rel="stylesheet">

	
   <!-- <link href="css/body.css" rel="stylesheet"> -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
   
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Style+Script&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=PT+Serif:ital@1&display=swap" rel="stylesheet">
   
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
				
				<!-- 
				<div class="row extra-top">
					
					<div class="col-lg item-upload">
					
						<label>Upload Product</label>

						<form method="post" enctype="multipart/form-data">
						
							<input type="file" name="image" class="upload-info">
							<input class="upload-info" type="text" name="product_name" placeholder="Product name">
							<input class="upload-info" type="text" name="product_catagory" placeholder="Product catagory">
							<input class="upload-info" type="text" name="product_sub_catagory" placeholder="Product sub-catagory">
							<textarea class="upload-info" name="product_description" placeholder="Product description"></textarea>
							
							<input type="submit" name="upload_btn" value="upload" id="upload_input_submit"/> 
							
						</form>
						
					</div>
				</div>
				-->
				
				
				<div class="container-fluid body-parent">
				
					<div class="row body-child" id="items-show-bound">

						<div class="col-lg-12 title-text">Home</div>	
						<div class="col-12 item-box">
							<a>
								<div class="item-holder">
									<div class="item-name"> <i style="color:darkorange" class="fa fa-eercast" aria-hidden="true"></i>&nbsp;About</div>
									<div class="sub-descrip" name="about div">
										<?php
											$query="SELECT * FROM home LIMIT 1";
											$r=mysqli_query($conn,$query);
											$about=mysqli_fetch_array($r);
										?>
										<textarea class="sub-descrip-area" id="about_save" ><?php echo $about["description"]; ?></textarea>
										
									</div>
									<div class="about_save" >Save description</div>
								</div>
							</a>
						</div>


						<div class="col-lg-12 title-text">Catagory and Sub catagory</div>
							<?php
							
							$all_items = array();
							$item_index = array();
							$img_path = array();
							$describe_all = array();
							$color_all = array();
							
							$query="SELECT * FROM itemdetails ORDER BY serial ASC";
							$r=mysqli_query($conn,$query);
							
							$total_items = mysqli_num_rows($r);
							if(mysqli_num_rows($r) > 0){
								
								while($row=mysqli_fetch_array($r)){
									
									array_push($all_items,$row["sub_item"]);
									array_push($item_index,$row["serial"]);
									array_push($img_path,$row["img_path"]);
									array_push($describe_all,$row["description"]);
									array_push($color_all,$row["color"]);
								}
							}
							else{ 
							
								//if no item found in database
								echo '<div class="col-lg-12 no-items">No products uploaded yet!!!</div>';
								
							}
							
							
							for($ind = 0; $ind < $total_items; ) {
								
								?>
								
								<div class="col-12 item-box">
									<!-- <a href="admin-catagory-details?catagory=<?php //echo $all_items[$ind]; ?>" > -->
									<a>
										<div class="item-holder">
											<div class="item-name"> <i style="color:darkorange" class="fa fa-eercast" aria-hidden="true"></i>&nbsp;<?php echo $all_items[$ind]; ?></div>
											<!-- color plate -->
											<div class="color-box">
											
												<?php
												
													$color_arr = explode("+", $color_all[$ind]); 
													
													$body_color = $color_arr[0];
													$column_color = $color_arr[1];
													$slider_color = $color_arr[2];
													$sliderinnerborder_color = $color_arr[3];
													$window_color = $color_arr[4];
												
												?>
											
												<div class="label-color-main">Body color</div>
												<input class="color-main-box" type="text" value="<?php echo $body_color; ?>"/>
												
												<div class="label-color-main">Column color</div>
												<input class="color-main-box" type="text" value="<?php echo $column_color; ?>"/>
												
												<div class="label-color-main">Slider background color</div>
												<input class="color-main-box" type="text" value="<?php echo $slider_color; ?>"/>
												
												<div class="label-color-main">Slider inner box color</div>
												<input class="color-main-box" type="text" value="<?php echo $sliderinnerborder_color; ?>"/>
												
												<div class="label-color-main">Window color</div>
												<input class="color-main-box" type="text" value="<?php echo $window_color; ?>"/>
											</div>
											<div class="color_add" name="<?php echo $item_index[$ind]; ?>">Save colors</div>
											
											<!-- for main Catagory-->
											<div class="sub-descrip-title">Description of <?php echo $all_items[$ind]; ?></div>
											<div class="sub-descrip" name="des div">
												<textarea class="sub-descrip-area" name="des area" ><?php echo $describe_all[$ind]; ?></textarea>
											</div>
											<div class="des_add" name="<?php echo $item_index[$ind]; ?>">Save description</div>
											
											<img class="subcat-img" src="<?php echo $img_path[$ind]; ?>" alt="" /> 
											<form onsubmit="return false"> 
												<input type="file" name="uploadfile">
												<input class="sub_img_add" type="submit" title="Change Photo" name="<?php echo $item_index[$ind]; ?>" value="change photo" /> 
											</form>
											<?php
											
												$main_cat_pass = true; 
												$catagory_name = ""; 
												$temp_serial = (int)$item_index[$ind];
												$next_subitem_pos;
												$temp_ind = 1;
												while($temp_serial == (int)$item_index[$ind]){
													
													// $next_subitem_pos++;
													$next_subitem_pos = (float)$item_index[$ind];
													// echo $next_subitem_pos;
													if($main_cat_pass == true){
														$main_cat_pass=false;
														$catagory_name = $all_items[$ind];
														$ind++;
														continue;
													}
													// echo "img".$img_path[$ind];
													?>
													<li class="sub-item-name">
														<a href="#"><?php echo $temp_ind.". ".$all_items[$ind]; ?></a> &nbsp;&nbsp;
														
														<button style="font-size:10px; color:white;border:none;background:black;" title="Delete sub-catagory" name="<?php echo $item_index[$ind]; ?>" class="sub_cat_del">
															<i class="fa fa-minus-circle" aria-hidden="true"></i>
														</button>
													</li>
													
													<div class="sub-descrip-title">Description:</div>
													<div class="sub-descrip" name="des div">
														<textarea class="sub-descrip-area" name="des area" ><?php echo $describe_all[$ind]; ?></textarea>
													</div>
													<div class="des_add" name="<?php echo (float)$item_index[$ind]; ?>">Save description</div>
													
													<img class="subcat-img" src="<?php echo $img_path[$ind]; ?>" alt="" /> 
													
													<form onsubmit="return false"> 
														<input type="file" name="uploadfile">
														<input class="sub_img_add" type="submit" title="Change Photo" name="<?php echo (float)$item_index[$ind]; ?>" value="change photo" /> 
													</form>
													
													<?php
													$temp_ind++;
													$ind++;
													if($total_items == $ind){
														break;
													}
												}
											?>
											<!-- add new button-->
											<li class="sub-item-name"> 
												<input type="text"/> &nbsp; 
												<button name="<?php echo $next_subitem_pos."+".$catagory_name; ?>" title="Add sub-catagory" class="sub_cat_add">Add new&nbsp;
													<i class="fa fa-plus-circle" aria-hidden="true"></i>
												</button>
											</li>
										
										</div>
									</a>
								</div>
								
								<?php
							}
						?>
					</div>	
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
	
		

   <!-- JavaScript -->
   <script type="text/javascript" src="script/jquery-3.5.1.min.js"></script>
   <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="script/sweetalert.min.js"></script>
   
   
   <script type="text/javascript">
		// swal({
			// title: "slide name empty!",
			// icon: "error",
			// showConfirmButton: false,
			// timer: "1500"
		// });
		$(document).ready(function(){
			
			
			//add sub catagory..................................................
			$('.sub_img_add').click(function(e) {
				
				
				var image_file = $(this).prev()[0].files;
				if(image_file.length != 1){
					
					swal({
						title: "No image selected",
						text: "Please select a image!",
						icon: "warning",
						button: true,
						timer: '2000'
					});
					return;
				}
				
				var image_name = image_file[0].name;
				var cat_serial = $(this).attr("name");
				var img_extension = image_name.slice((Math.max(0, image_name.lastIndexOf(".")) || Infinity) + 1);
				var image_path = "cat_subcat_image/"+cat_serial+'.'+img_extension;
				
				// console.log(image_file[0].name);
				// console.log(cat_serial);
				// console.log(img_extension);
				// console.log(image_path);
				// return;
				
				if(img_extension == 'jpeg' || img_extension == 'jpg' || img_extension == 'png'){
					
				}
				else{
					swal({
						title: "Unsupported image",
						text: "jpeg, jpg and png format only supported!",
						icon: "warning",
						button: true,
						timer: '2000'
					});
					return;
				}
					
				var formData = new FormData();
				formData.append('file',image_file[0]);
				formData.append('name',image_path);
				formData.append('serial',cat_serial);
				
				$.ajax({
					url: 'updel_subcat_image_ajax.php',
					type: 'post',
					data: formData,
					contentType: false,
					processData: false,
					success: function(response){
						console.log(response);
					if(response != 0){
						//success
						
						swal({
							title: "Image changed Successfully",
							text: "",
							icon: "success",
							button: false,
							timer: '1500'
						});
						
						setTimeout(function() {
							location.reload();
						}, 1500);
						
					 }else{
						//failed!!!
					 } 
					 
					},
				});
				 
				
			});
			
			
			//save description..................................................
			$('.des_add').click(function(e) {
				
				var serial = $(this).attr("name");
				// console.log(serial);
				
				var des_text = $(this).prev('.sub-descrip').children('textarea').val();
				// console.log(des_text);
				// return;

				swal({
					title: "Want to add the description ?",
					text: "Description will be added!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
						//yes
						$.ajax({
							
							url : "add-description-ajax.php",
							type : "POST",
							data: ({serial:serial, des_text:des_text}),
							success : function(result){
								// console.log(result);
								if(result == 'success'){
									
									swal({
										title: "Description has been added successfully",
										text: "",
										icon: "success",
										button: false,
										timer: '1500'
									});
									
									setTimeout(function() {
										location.reload();
									}, 1500);
									
								}
								else{
									
									swal({
										title: "Error occurred",
										text: "Please try again!",
										icon: "warning",
										button: false,
										timer: '2000'
									});
								}
							}
						});
						
				  } else {
					  
						swal({
							title: "Cancelled",
							icon: "error",
							button: false,
							timer: '1500'
						});
					  
					}
				}); 
				
				
				// var catagory=$(this).attr("name");
				// console.log(cart_id);
				// console.log(cart_id);
				// console.log(sub_catagory.val());
				// console.log("add new");
			});
			
			
			//save color..................................................
			$('.color_add').click(function(e) {
				
				var serial = $(this).attr("name");
				// console.log(serial);
				
				var color_all = "";
				var total_child = $(this).prev('.color-box').children('.color-main-box').length;
				
				for(var i=0;i<total_child;i++){
					if(i == 0){
						color_all = $(this).prev('.color-box').children('.color-main-box').eq(i).val();
					}
					else{
						color_all = color_all + "+" + $(this).prev('.color-box').children('.color-main-box').eq(i).val();
					}
				}
				
				// console.log(color_all);
				
				// console.log();
				// return;

				swal({
					title: "Want to add the colors ?",
					text: "Colors will be added!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
						//yes
						$.ajax({
							
							url : "add-color-ajax.php",
							type : "POST",
							data: ({serial:serial, color_all:color_all}),
							success : function(result){
								// console.log(result);
								if(result == 'success'){
									
									swal({
										title: "Color has been added successfully",
										text: "",
										icon: "success",
										button: false,
										timer: '1500'
									});
									
									setTimeout(function() {
										location.reload();
									}, 1500);
									
								}
								else{
									
									swal({
										title: "Error occurred",
										text: "Please try again!",
										icon: "warning",
										button: false,
										timer: '2000'
									});
								}
							}
						});
						
				  } else {
					  
						swal({
							title: "Cancelled",
							icon: "error",
							button: false,
							timer: '1500'
						});
					  
					}
				}); 
				
				
				// var catagory=$(this).attr("name");
				// console.log(cart_id);
				// console.log(cart_id);
				// console.log(sub_catagory.val());
				// console.log("add new");
			});
			
			
			//add sub catagory..................................................
			$('.sub_cat_add').click(function(e) {
				
				// var serial_N_catagory = $(this).attr("name");
				
				// var temp_serial_firstpart = $(this).attr("name").split('+')[0].split('.')[0];
				// var temp_serial_lastpart = $(this).attr("name").split('+')[0].split('.')[1];
				var f1 = parseFloat($(this).attr("name").split('+')[0]);
				f1 = f1.toFixed(5);
				var f2 = parseFloat('0.00001');
				f2 = f2.toFixed(5);
				
				var serial = parseFloat(f1) + parseFloat(f2);
				serial = serial.toFixed(5);
				
				var catagory = $(this).attr("name").split('+')[1];
				var sub_catagory = $(this).prev().val();
				
				// var serial = parseFloat(temp_serial_firstpart) + parseFloat(temp_serial_lastpart)/0.00001;
				
				// console.log(parseFloat("10").toFixed(3));
				// console.log(f1);
				// console.log(f2);
				// console.log(serial);
				// console.log(temp_serial_lastpart);
				// console.log(catagory);
				// console.log(sub_catagory);

				// return;
				if(sub_catagory == "" || sub_catagory == " " ){
					
					// console.log("return");
					return;
				}
				
				swal({
					title: "Want to add sub-catagory?",
					text: "Sub-catagory will be added!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
						//yes
						$.ajax({
							
							url : "sub-catagory-add-ajax.php",
							type : "POST",
							data: ({serial:serial, catagory:catagory, sub_catagory:sub_catagory}),
							success : function(result){
								
								if(result == 'success'){
									
									swal({
										title: "Sub-catagory has been added successfully",
										text: "",
										icon: "success",
										button: false,
										timer: '1500'
									});
									
									setTimeout(function() {
										location.reload();
									}, 1500);
									
								}
								else{
									
									swal({
										title: "Error occurred",
										text: "Please try again!",
										icon: "warning",
										button: false,
										timer: '2000'
									});
								}
							}
						});
						
				  } else {
					  
						swal({
							title: "Cancelled",
							icon: "error",
							button: false,
							timer: '1500'
						});
					  
					}
				}); 
				
				
				// var catagory=$(this).attr("name");
				// console.log(cart_id);
				// console.log(cart_id);
				// console.log(sub_catagory.val());
				// console.log("add new");
			});
			
			
			//sub class delete...................................................
			$('.sub_cat_del').click(function(e) {
				
				var serial = $(this).attr("name");
				
				// console.log(serial);
				// return;
				
				swal({
					title: "Do you want to Delete sub-catagory?",
					text: "Sub-catagory will be deleted!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
						//yes
						$.ajax({
							
							url : "sub-catagory-del-ajax.php",
							type : "POST",
							data: ({serial:serial}),
							success : function(result){
								
								// console.log(result);
								if(result == 'success'){
									
									swal({
										title: "Sub-catagory has been deleted successfully",
										text: "",
										icon: "success",
										button: false,
										timer: '1500'
									});
									
									setTimeout(function() {
										location.reload();
									}, 1500);
									
								}
								else{
									
									swal({
										title: "Error occurred",
										text: "Please try again!",
										icon: "warning",
										button: false,
										timer: '2000'
									});
								}
							}
						});
						
				  } else {
					  
						swal({
							title: "Cancelled",
							icon: "error",
							button: false,
							timer: '1500'
						});
					  
					}
				}); 
				
				
				// var catagory=$(this).attr("name");
				// console.log(cart_id);
				// console.log(cart_id);
				// console.log(sub_catagory.val());
				// console.log("add new");
			});

			$('.about_save').click(function(e) {
				
				var des_text = $('#about_save').val();

				swal({
					title: "Want to save the About ?",
					text: "About will be saved!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
						//yes
						$.ajax({
							
							url : "add-about-ajax.php",
							type : "POST",
							data: ({des_text:des_text}),
							success : function(result){
								// console.log(result);
								if(result == 'success'){
									
									swal({
										title: "Description has been added successfully",
										text: "",
										icon: "success",
										button: false,
										timer: '1500'
									});
									
									setTimeout(function() {
										location.reload();
									}, 1500);
									
								}
								else{
									
									swal({
										title: "Error occurred",
										text: "Please try again!",
										icon: "warning",
										button: false,
										timer: '2000'
									});
								}
							}
						});
						
				  } else {
					  
						swal({
							title: "Cancelled",
							icon: "error",
							button: false,
							timer: '1500'
						});
					  
					}
				}); 
			});
			
			
		});
	</script>
   

</body>

</html>
