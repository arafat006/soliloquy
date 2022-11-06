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
	$slide_name = $_POST['slide_name'];


	//if click upload button
	if(isset($_POST['upload_btn'])){
     
		//checking if product details are not empty
        if ($slide_name!="")
        {
            
			//total product count
			$query="SELECT * FROM slides";
			$r=mysqli_query($conn,$query);	
			
			//add 1 to new product number
			$product_number = (mysqli_num_rows($r)+1);
			
			$image = $_FILES['image']['name'];

			// image file directory
			$target = "slides/".$product_number.'_'.basename($image);

			if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
				// $msg = "Image uploaded successfully";
			}else{
				// $msg = "Failed to upload image";
			}
			
			date_default_timezone_set("UTC");
			$date=date("Y-m-d H:i:s", time());
			
			$qy="insert into slides (name, path, upload_date) values ('$slide_name','$target','$date')";
            
            
            if (mysqli_query($conn,$qy)) {
             echo "New record created successfully";
             header("Refresh:0");
            } else {
             echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
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
   <link href="css/admin-upload-slide.css" rel="stylesheet">

	
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
					
						<label>Upload Slides</label>

						<form method="post" enctype="multipart/form-data">
						
							<input type="file" name="image" class="upload-info">
							<input class="upload-info" type="text" name="slide_name" placeholder="Enter slide name">
							
							<input type="submit" name="upload_btn" value="upload" id="upload_input_submit"/> 
							
						</form>
						
					</div>
					
					
				</div>
				
				<div class="container-fluid body-parent">
				
					<div class="row body-child" id="items-show-bound">
						
						<div class="col-lg-12 title-text">Slides</div>
							<?php
							
							//query for showing slides which is available
							$query="SELECT * FROM slides";
							$r=mysqli_query($conn,$query);
							
							//checking if at least 1 data found or not
							if(mysqli_num_rows($r) > 0){
								
								//if found the extract row by colomns and show in html div
								while($row=mysqli_fetch_array($r)){
									
									//showing data in html div 
									echo '<div class="col-lg-3 col-md-4 col-sm-6 item-box">
											<a>
												<div class="item-holder">
													<div class="item-img"><img src="'.$row["path"].'" alt="" height="100%" width="100%" /></div>
													<div class="item-name">'.$row["name"].'</div>
													<div class="item-name delete-slide" name="'.$row["id"].'">Delete</div>
												</div>
											</a>
										</div>';
									
								}
								
							}
							else{ 
							
								//if no item found in database
								echo '<div class="col-lg-12 no-items">No slides uploaded yet!!!</div>';
								
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
		
	$('.delete-slide').click(function() {
	  
		var id = $(this).attr('name');
		// console.log(id);
		swal({
		  title: "Do you want to delete the slide ?",
		  text: "Once deleted, you will not be able to recover!",
		  icon: "warning",
		  buttons: true,
		  dangerMode: true,
		})
		.then((willDelete) => {
		  if (willDelete) {
			
			$.ajax({
					
				url : "delete-slide-ajax.php",
				type : "POST",
				data: ({id:id}),
				success : function(result){
					// console.log(result);
					if(result == 'success'){
						
						location.href = 'admin-slide';

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
		
		
		
	</script>
   

</body>

</html>
