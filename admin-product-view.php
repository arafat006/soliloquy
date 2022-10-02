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

	$item_id = $_GET['id'];

	// Post Name Changing ...............
	$Admin_postname = $_POST['post_name'];
	if(isset($_POST['change_post_name'])){
        if ($Admin_postname!="" || $Admin_postname!=" ")
        {
			$qy="UPDATE products SET name='$Admin_postname' WHERE id='$item_id'";
			mysqli_query($conn,$qy);
			header("Refresh:0");
        }
    }

	// Post caption 1 Changing ...............
	// $Admin_captionname1 = $_POST['caption_name1'];
	// if(isset($_POST['change_caption1'])){
        // if ($Admin_captionname1 != "" || $Admin_captionname1 != " ")
        // {
			// $qy="UPDATE products SET caption_s1='$Admin_captionname1' WHERE id='$item_id'";
			// mysqli_query($conn,$qy);
			// header("Refresh:0");
        // }
    // }


	


	


	// Post description ...............
	$Admin_description = $_POST['description_text'];
	if(isset($_POST['change_description'])){
        if ($Admin_description != "" || $Admin_description != " ")
        {
			$qy="UPDATE products SET description='$Admin_description' WHERE id='$item_id'";
			mysqli_query($conn,$qy);
			header("Refresh:0");
        }
    }

	

	// Post Upload Date ...............
	$Admin_uploaddate = $_POST['uploaddate_text'];
	if(isset($_POST['change_uploaddate'])){
        if ($Admin_uploaddate != "" || $Admin_uploaddate != " ")
        {
			$qy="UPDATE products SET upload_date='$Admin_uploaddate' WHERE id='$item_id'";
			mysqli_query($conn,$qy);
			header("Refresh:0");
        }
    }

	

	// Post Available ...............
	$Admin_available = $_POST['available_text'];
	if(isset($_POST['change_available'])){
        if ($Admin_available != "" || $Admin_available != " ")
        {
			$qy="UPDATE products SET available='$Admin_available' WHERE id='$item_id'";
			mysqli_query($conn,$qy);
			header("Refresh:0");
        }
    }

	










	//getting variable from html form
	$product_name = $_POST['product_name'];
	$product_catagory = $_POST['product_catagory'];
	$product_sub_catagory = $_POST['product_sub_catagory'];
	$product_description = $_POST['product_description'];

	// echo $product_name;
	// echo $product_catagory;
	// echo $product_sub_catagory;
	// echo $product_description;
	// return;
	//if click upload button
	if(isset($_POST['upload_cover_photo'])){
		
		$product_number = $item_id;
		$image = $_FILES['image']['name'];
		
		if($image == ""){
			
		}
		else{
			// image file directory
			$target = "products/".$product_number.'_'.basename($image);
			if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
				// $msg = "Image uploaded successfully";
			}else{
				// $msg = "Failed to upload image";
			}
			$qy="UPDATE products SET path='$target' WHERE id='$item_id'";
			mysqli_query($conn,$qy);
			header("Refresh:0");
        }
    }
	
	// if(isset($_POST['upload_cap1_img'])){
		
		// $product_number = $item_id;
		// $image = $_FILES['image']['name'];
		// if($image == ""){
			
		// }
		// else{
			
			// $target = "products/".$product_number.'_c1_'.basename($image);
			// if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
				
			// }else{
				
			// }
			// $qy="UPDATE products SET path_s1='$target' WHERE id='$item_id'";
			// mysqli_query($conn,$qy);
			// header("Refresh:0");
		// }
    // }
	
	
	
?>



<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Bootstrap CSS -->
   <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href="css/admin-product-view.css" rel="stylesheet">

	
   <!-- <link href="css/body.css" rel="stylesheet"> -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
   
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&amp;family=Playfair+Display:wght@400;700&amp;display=swap" rel="stylesheet">
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.12.0/video-js.min.css" />
   
   <title>Soliloquy</title>
   <!-- <link rel="icon" href="image/logo/fav-icon.png" type="image/gif" sizes="16x16"> -->
  
   
</head>

<body>


	<?php
	
		//Getting all catagory and subcatagories.....................
	$all_items = "";
	$item_index = "";

	
	// echo $item_id;
	$query="SELECT * FROM products where id='$item_id'";
	$r=mysqli_query($conn,$query);

	// $product_name = "";
	// $product_path = "";
	
	// $product_path_s1 = "";
	// $product_path_s2 = "";
	// $product_path_s3 = "";
	
	// $product_cap_s1 = "";
	// $product_cap_s2 = "";
	// $product_cap_s3 = "";
	
	// $product_catagory = "";
	// $product_subcatagory = "";
	
	// $product_description = "";
	// $product_upload_date = "";
	// $product_available = "";
	
	$row=mysqli_fetch_array($r);
		
	
	$product_name = $row["name"];
	$product_path = $row["path"];
	
	$product_catagory = $row["catagory"];
	$product_subcatagory = $row["sub_catagory"];
	
	$product_description = $row["description"];
	$product_upload_date = $row["upload_date"];
	$product_available = $row["available"];
	
	?>


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
					
						<label>Post Specification</label>

						<form method="post" enctype="multipart/form-data">
						
							<input type="file" name="image" class="upload-info">
							<input class="upload-info" type="text" name="product_name" placeholder="Product name">
							
							 <input class="upload-info" type="text" name="product_catagory" placeholder="Product catagory"> 
							
							<select class="upload-info" name="product_catagory" id="maincat_selector">
							  
							</select>
							
							<select class="upload-info" name="product_sub_catagory" id="subcat_selector">
							  
							</select>
							
							 <input class="upload-info" type="text" name="product_sub_catagory" placeholder="Product sub-catagory">
							<textarea class="upload-info" name="product_description" placeholder="Product description"></textarea>
							
							<input type="submit" name="upload_btn" value="upload" id="upload_input_submit"/> 
							
						</form>
						
					</div>
					
					
				</div>
				-->
				<?php //echo $product_name; ?>
				<div class="container-fluid body-parent">
				
					<div class="row body-child" id="items-show-bound">
						
						<div class="col-lg-12 title-text">Post Specification</div>
						
						<div class="col-lg-12 col-md-12 col-sm-12 item-box">
							
								<div class="item-holder">
								
									<div class="item-text">
										Cover Photo:
									</div>
									<div class="item-img"><img src="<?php echo $product_path; ?>" alt="" height="100%" width="100%" /></div>
									<form method="post" enctype="multipart/form-data">
										<input class="choose-image" type="file" name="image" class="upload-info">
										<input type="submit" name="upload_cover_photo" value="Change Cover Photo" id="upload_input_submit"/> 
									</form>
									
									<div class="item-text">
										<form method="post">
											Post Name:&nbsp;
											<input type="text" value="<?php echo $product_name; ?>" name="post_name"/>
											<input type="submit" name="change_post_name" value="Save name"/> 
										</form>
									</div>
									
									
									<!-- Caption 1 -->
									<?php
										
										$query="SELECT * FROM productslider WHERE item_id='$item_id'";
										$r=mysqli_query($conn,$query);
										
										$inx = 1;
										// echo mysqli_num_rows($r);
										while($row=mysqli_fetch_array($r)){
											
											if($row["type"] == "img"){
											?>
												<div class="item-text text-top-margin">
													Slide Photo Position <?php echo $inx;?> &nbsp;<span style="color:red;" class="image-delete" name="<?php echo $row["id_auto"]; ?>" >[Delete]</span>
												</div>
												<div class="item-img-2"><img src="<?php echo $row["iov_path"]; ?>" alt="" height="100%" width="100%" /></div>
												
												<div class="item-text">
													<form method="post">
														Caption <?php echo $inx;?>:&nbsp;
														<?php echo $row["captions"]; ?>
														<!-- <input type="submit" name="change_caption1" value="Save Caption"/> -->
													</form>
												</div>
												
											<?php
											}else{
											?>
												<div class="item-text text-top-margin">
													Slide Video Position <?php echo $inx;?>&nbsp;<span style="color:red;" class="image-delete" name="<?php echo $row["id_auto"]; ?>" >[Delete]</span>
												</div>
												<div class="item-img-2" style="display:flex;justify-content:center;">
												
													<video
													   id="my_video"
													   class="video-js"
													   controls
													   preload="auto"
													   width="auto"
													   height="250px"
													   data-setup="{}">
													   <source src="<?php echo $row["iov_path"]; ?>" type="video/youtube" /> 
													</video>
												
												</div>
												
												<div class="item-text">
													<form method="post">
														Video caption:&nbsp;
														<?php echo $row["captions"]; ?>
														<!-- <input type="submit" name="change_caption1" value="Save Caption"/> -->
													</form>
												</div>
												
											<?php
											}
											$inx++;
										}
										
									
									?>
									
									
									
									<!-- Add image slide............... -->
								
									<form style="background:gray;margin-top:50px;" onsubmit="return false"> 
										<textarea name="" id="new_cap_text" placeholder="Write image caption here..."></textarea>
										<input type="file" name="uploadfile">
										<input class="sub_img_add" type="submit" title="Add Photo" name="<?php echo $item_id; ?>" value="Add Image Slide" /> 
									</form>
									
									<!-- Add video slide -->
									<form style="background:orange;margin-top:50px;" onsubmit="return false"> 
										<textarea name="" id="vid_cap_text" placeholder="Write video caption here..."></textarea> &nbsp;
										<textarea name="" id="vid_link_text" placeholder="Video link..."></textarea>
										<!-- <input type="text" name="uploadfile"> -->
										<input class="sub_vid_add" type="submit" title="Add Video" name="<?php echo $item_id; ?>" value="Add Video Slide" /> 
									</form>
									
									
									
									<!-- Description -->
									<div class="item-text text-top-margin">
										Description
									</div>
									<div class="item-text">
										<form method="post" class="des-form">
											<textarea class="des-text-area" cols="" rows="" name="description_text" ><?php echo $product_description;?></textarea>
											<input type="submit" name="change_description" value="Save Description"/> 
										</form>
									</div>
									
									
									
									<!-- Upload date -->
									<div class="item-text text-top-margin">
										Upload Date
									</div>
									<div class="item-text">
										<form method="post">
											<input name="uploaddate_text" value="<?php echo $product_upload_date;?>" style="font-size:17px;">
											<button style="font-size:17px;" name="change_uploaddate">Save Upload Date & Time</button>
										</form>
									</div>
									
									<!-- Available -->
									<div class="item-text text-top-margin">
										Available
									</div>
									<div class="item-text">
										<form method="post">
											<input name="available_text" value="<?php echo $product_available;?>" style="font-size:17px;">
											<button style="font-size:17px;" name="change_available">Save Available</button>
										</form>
									</div>
									
									
									<!-- Delete item -->
									<div class="item-text text-top-margin">
										<!-- Delete this item -->
									</div>
									<div class="item-text">
										
										<button style="font-size:18px;background:orange;color:black;border:2px solid red" id="delete_post">Delete Post</button>
										
									</div>
									
								</div>
							
						</div>
						
					</div>	
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
	
		

   <!-- JavaScript -->
   <script type="text/javascript" src="script/jquery-3.5.1.min.js"></script>
   <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="script/sweetalert.min.js"></script>
   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/video.js/7.12.0/video.min.js"></script>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-youtube/2.6.1/Youtube.min.js"></script>
	
   <script type="text/javascript">
		
		//add Slide page..................................................
		$('.sub_img_add').click(function(e) {
			
			// console.log(prod_cap);
			// return;
			
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
			
			var prod_cap = $('#new_cap_text').val();
			var image_name = image_file[0].name;
			var prod_id = $(this).attr("name");
			var img_extension = image_name.slice((Math.max(0, image_name.lastIndexOf(".")) || Infinity) + 1);
			var image_path = "product_slide/"+prod_id+'.'+img_extension;
			
			// console.log(image_file[0].name);
			// console.log(prod_id);
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
			formData.append('prod_id',prod_id);
			formData.append('prod_cap',prod_cap);
			
			$.ajax({
				url: 'add_product_slide_ajax.php',
				type: 'post',
				data: formData,
				contentType: false,
				processData: false,
				success: function(response){
					console.log(response);
				if(response != 0){
					//success
					
					swal({
						title: "Slide added Successfully",
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
			
			
		//add Video to slide..................................................
		$('.sub_vid_add').click(function(e) {
			
			var vid_cap = $('#vid_cap_text').val();
			var vid_link = $('#vid_link_text').val();
			var prod_id = $(this).attr("name");
			
			
			$.ajax({
							
				url : "add-video-slide-post-ajax.php",
				type : "POST",
				data: ({prod_id:prod_id, vid_cap:vid_cap, vid_link:vid_link}),
				success : function(result){
					// console.log(result);
					if(result == 'success'){
						
						location.reload();

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
			
		});
			
		
		$('.image-delete').click(function() {
		  
			// console.log("delete image");
			var id_auto = $(this).attr("name");
			console.log(id_auto);
			
			swal({
				  title: "Do you want to delete the Image slide ?",
				  text: "Once deleted, you will not be able to recover this image!",
				  icon: "warning",
				  buttons: true,
				  dangerMode: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
					
					$.ajax({
							
						url : "delete-image_slide-ajax.php",
						type : "POST",
						data: ({id_auto:id_auto}),
						success : function(result){
							// console.log(result);
							if(result == 'success'){
								
								location.reload();
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
					  timer: 2000,
					});
				  
				  }
				});
		  
		});
			
				
			
			
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
		
		$('#delete_post').click(function() {
		  
		  // console.log("delete post");
			var id='<?php echo $item_id; ?>';
		  
			swal({
				  title: "Do you want to delete the post ?",
				  text: "Once deleted, you will not be able to recover this post!",
				  icon: "warning",
				  buttons: true,
				  dangerMode: true,
				})
				.then((willDelete) => {
				  if (willDelete) {
					
					// location.window('admin-product');
					// window.navigate("admin-product.php");
					
					// return;
					// console.log("delete post");
					$.ajax({
							
						url : "delete-post-ajax.php",
						type : "POST",
						data: ({id:id}),
						success : function(result){
							// console.log(result);
							if(result == 'success'){
								
								location.href = 'admin-product';

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
					  timer: 2000,
					});
				  
				  }
				});
		  
		});
		
		// console.log(MainCatagory);
		// console.log(SubCatagory);
		// console.log(all_cat_subcat_array);
		// console.log(cat_subcat_indx_array);
		
		
	</script>
   

</body>

</html>
