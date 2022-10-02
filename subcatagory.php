<?php
	
	include_once('connection.php');
    // mysqli_select_db($conn,'sessionpractical');
    // error_reporting(0);
	$main_cat_get_ind = $_GET['cat'];
	$main_subcat_get_ind = $_GET['subcat'];
	$cat_des = "";
	$main_cat_name = "";
	$sub_cat_name = "";
	$slide_img_path_cat = "";
	
	$total_subitems = 0;
	$total_page_forsubitems = 0;
	
	$all_color = "";
	$body_color="#0E1633";
	$column_color="#90B2C4";
	$slider_color="#FFFFFF";
	$sliderinnerborder_color="#748DB4";
	$window_color="#748DB4";
	
	$sql="SELECT description, sub_item, img_path FROM itemdetails where serial='$main_subcat_get_ind'";
	//body_color + column_color + slider_color + sliderinnerborder_color + window_color
	$result = $conn->query($sql);
	if ($result->num_rows == 1) {
		
		$row = $result->fetch_assoc();
		$cat_des = $row["description"];
		$slide_img_path_cat = $row["img_path"];
		$sub_cat_name = $row["sub_item"];
		// $body_color = $row["body_color"];
		// $column_color = $row["column_color"];
		// $slider_color = $row["slider_color"];
		// $sliderinnerborder_color = $row["sliderinnerborder_color"];
		// $window_color = $row["window_color"];
	}
	
	$sql="SELECT color FROM itemdetails where serial='$main_cat_get_ind'";
	$result = $conn->query($sql);
	if ($result->num_rows == 1) {
		
		$row = $result->fetch_assoc();
		$color_all = $row["color"];

	}
	$color_arr = explode ("+", $color_all); 
	$body_color = $color_arr[0];
	$column_color = $color_arr[1];
	$slider_color = $color_arr[2];
	$sliderinnerborder_color = $color_arr[3];
	$window_color = $color_arr[4];
	
	// echo $column_color;
	
	// echo $slide_img_path_cat;
?>


<!DOCTYPE html>

<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
	<link href="css/cat-index.css" rel="stylesheet" >
	<link href="css/cat-index2.css" rel="stylesheet" >
	
	
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- Bangla fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Atma:wght@300&display=swap" rel="stylesheet">
	
	<title>Soliloquy</title>
	<link rel="icon" href="image/fav-icon-org.png" type="image/png" sizes="16x16" >
	
	
	<style>
	
		.sub-menu{
			
			<?php 
			if(strlen($column_color) != 7){
				echo "background-color:#90B2C4;";
			}
			else{
				
				echo "background-color:".$column_color.";";
				// echo $column_color;
			}
			?>
		}
		
		
		
	</style>
	
</head>

<body style="background-color:<?php echo $body_color; ?>;">

	<div style="color:white">
		
		<?php
			
			// echo $window_color;
			
			$all_items = array();
			$item_index = array();
			$img_path = array();
			
			$query="SELECT serial, type, main_item, sub_item, img_path FROM itemdetails ORDER BY serial ASC";
			$r=mysqli_query($conn,$query);
			
			$total_items = mysqli_num_rows($r);
			if(mysqli_num_rows($r) > 0){
				
				while($row=mysqli_fetch_array($r)){
					
					//showing data in html div 
					array_push($all_items,$row["sub_item"]);
					// echo $row["serial"];
					array_push($item_index,$row["serial"]);
					// $row["main_item"];
					array_push($img_path,$row["img_path"]);
				}
			}
			else{
				
				// echo "Empty";
			}
			
			// array_push($index_main_menu, 1);
			// array_keys($all_items);
			// array_keys($item_index);
			// print_r($all_items);
			// print_r($item_index);

			// echo intval($item_index[7]);
			// echo (int)($item_index[3]);
			// print_r($Main_menu);
			// echo count($Main_menu);
			
		?>
		
	</div>
	
	

	<div class="container-fluid body-1-container">
		<div class="row body-1-row">
			
			<div class="navbar-holder"> 
				<div class="navbar">
					<div class="collapse-nav" id="collapse_nav"><i class="fa fa-bars" aria-hidden="true"></i> </div>
					<ul class="main-ul" id="main_ul">
						<li class="main-li"><a href="home"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
						
						<?php
							
							//$s_ind = 0;
							$mcat_count = 1;
							for($ind = 0; $ind < $total_items; ) {
								
								?>
								
								<li class="<?php if($mcat_count == $main_cat_get_ind){ echo "main-li selected-mail-li"; } else{ echo "main-li"; }
								?>" id="seeking_menu" style="background-color:<?php if($mcat_count == $main_cat_get_ind){ echo $window_color; } 
								?>" ><a href="<?php echo "catagory?cat=".$item_index[$ind]; ?>"> <?php echo $all_items[$ind]; ?></a>
										
								<?php 
									$mcat_count++;
									
									$main_cat_pass = true; 
									$first_sub_pass = false; 
									$sub_need_pass = false; 
									
									$temp_serial = (int)$item_index[$ind];
									// echo $temp_serial;
									// echo $index_main_menu[0];
									if($main_cat_get_ind == $item_index[$ind]){
										$main_cat_name = $all_items[$ind];
									}
									
									$sub_count = 0;
									while($temp_serial == (int)$item_index[$ind]){

										if($main_cat_pass == true){
											$main_cat_pass=false;
											$ind++;
											if($total_items == $ind){
												break;
											}
											continue;
										}
										
										if($first_sub_pass == false){
									
											$first_sub_pass = true;
											$sub_need_pass = true;
											echo '<div class="sub-menu" id="sub_menu_1">
													<ul class="submenu-ul">';
										}
										
										
										if($main_subcat_get_ind == $item_index[$ind]){
										
											echo '<li class="submenu-li-dashbar"></li>
												<li class="submenu-li"><a id="seleted_sub_li" href="subcatagory?cat='.(int)$item_index[$ind].'&subcat='.$item_index[$ind].'">'.$all_items[$ind].'</a></li>';
										}
										else{
											
											echo '<li class="submenu-li-dashbar"></li>
												<li class="submenu-li"><a href="subcatagory?cat='.(int)$item_index[$ind].'&subcat='.$item_index[$ind].'">'.$all_items[$ind].'</a></li>';
										}
										$sub_count++;
										$ind++;
										if($total_items == $ind){
											break;
										}
									}
									if($main_cat_get_ind == (int)$item_index[$ind-1]){
										
										$total_subitems = $sub_count;
										if((int)($total_subitems/6)==0){
											$total_page_forsubitems = 1;
										}
										else{
											$total_page_forsubitems = ceil($total_subitems/6);
										}
									}
									
									if($sub_need_pass == true){
								
										echo '</ul>
												</div>';
									}
								
								?>
								
								</li>
								<?php
								
							}
							
							
						?>
						
					</ul>
				</div>
				
				<div class="col-bar-1" style="background-color:<?php echo $column_color; ?>">
				
					<div class="content-holder">
					
						<div class="content-box" id="search_area">
							<div class="social-icons" id="social_icons">
							
								<i class="fa fa-facebook-square" id="fb_icon" aria-hidden="true"></i>
								<i class="fa fa-instagram" id="insta_icon" aria-hidden="true"></i>
								<i class="fa fa-twitter-square" id="twt_icon" aria-hidden="true"></i>
								<i class="fa fa-envelope" id="mail_icon" aria-hidden="true"></i>
								
							</div>
							
							<div class="search-bar" id="search_icon">
								<input type="text" name="search" class="search-box" id="search"/> 
								<i class="fa fa-search" id="src_icon" aria-hidden="true"></i>
							</div>
						</div>
						
					</div>
					
				</div>
				
			</div>
			
			<div class="slider-part">
				<div class="slider-holder">
					<div class="slideshow-container">
					
						<div class="slide-page " style="background-color:<?php echo $slider_color; ?>">
							<img src="<?php echo $slide_img_path_cat; ?>" alt="<?php echo $sub_cat_name; ?>">
						</div>
						
						<div class="box-border" style="border-color:<?php echo $sliderinnerborder_color; ?>">
							
						</div>
						
						<div class="logo">
							<img id="main_logo_img" src="image/logo-white.png" alt="Logo" />
						</div>
						
						<div class="cat-name-holder">
							<div class="text-area"> <?php echo $sub_cat_name; ?> </div> 
						</div>
						
					</div>
					
					
				</div>
			</div>
			
			
			<div class="extra-bottom">
				<div class="col-bar-2" style="background-color:<?php echo $column_color; ?>">
					<div class="social-icons" id="social_icons_2">
							
						<i class="fa fa-facebook-square" id="fb_icon" aria-hidden="true"></i>
						<i class="fa fa-instagram" id="insta_icon" aria-hidden="true"></i>
						<i class="fa fa-twitter-square" id="twt_icon" aria-hidden="true"></i>
						<i class="fa fa-envelope" id="mail_icon" aria-hidden="true"></i>
						
					</div>
				</div>
			</div>
			
			
			
			
		</div>
	</div>

	<div class="container-fluid body-part2-container">
		<div class="row body-part2-row">
		
			<div class="window-left" style="background-color:<?php echo $window_color; ?>">
				
				<?php
				
				//query for showing slides which is available
				$query="SELECT p.id as id,name,path,catagory,sub_catagory,upload_date,serial FROM products p inner JOIN itemdetails i ON i.sub_item=p.sub_catagory where sub_catagory='$sub_cat_name' AND available='1' ORDER by upload_date DESC LIMIT 6";
				$r=mysqli_query($conn,$query);
				
				//checking if at least 1 data found or not
				if(mysqli_num_rows($r) > 0){
					
					//if found the extract row by colomns and show in html div
					$i=1;
					while($row=mysqli_fetch_array($r)){
						
						//showing data in html div 
						// echo $row["path"]."<br>";
						if($row["path"] != "Nan"){
							echo '<div class="window-part part-'.$i.'" style="background: url('.$row["path"].') no-repeat center center / cover" > 
									<div class="info-text"> 
										<div class="text-part">
											<p class="catagory-part" title="'.$row["catagory"].'"><a href="catagory?cat='.(int)$row["serial"].'">'.$row["catagory"].'</a></p>
											<p class="name-part" title="'.$row["name"].'"><a href="itemview?id='.$row["id"].'&subcat='.$row["serial"].'">'.$row["name"].'</a></p>
											<p class="date-part">'.substr($row["upload_date"],0,10).'</p>
										</div>
									</div>
								</div>';
						}
						else{
							
							echo '<div class="window-part part-'.$i.'" style="background:none no-repeat center center / cover" > 
									<div class="info-text"> 
										<div class="text-part">
											<p class="catagory-part" title="'.$row["catagory"].'"><a href="catagory?cat='.(int)$row["serial"].'">'.$row["catagory"].'</a></p>
											<p class="name-part" title="'.$row["name"].'"><a href="itemview?id='.$row["id"].'&subcat='.$row["serial"].'">'.$row["name"].'</a></p>
											<p class="date-part">'.substr($row["upload_date"],0,10).'</p>
										</div>
									</div>
								</div>';
						}
						$i++;
					}
				}
				?>
				
				<?php
				
				$query="SELECT p.id as id FROM 
				products p inner JOIN itemdetails i ON i.sub_item=p.sub_catagory where
				sub_catagory='$sub_cat_name' AND available='1'";
				
				$r=mysqli_query($conn,$query);
				if(mysqli_num_rows($r) > 6)
				{
					?>
					<div class="window-paging"> 
					
						<div class="window-page-info" id="window_page_info">
							<a href="all-items?subcat=<?php echo $main_subcat_get_ind; ?>">Show more ...</a>
						</div>
						
					</div>
					<?php
				}
				else{
					
					/*
					?>
					<div class="window-paging"> 
					
						<div class="window-page-info" id="window_page_info">
							<a href="all-items">Show more ...</a>
						</div>
						
					</div>
					<?php
					*/
				}
				?>
			</div>
			
			<div class="window-right" style="background-color:<?php echo $window_color; ?>"></div>
		
		
			<div class="col-bar-3"  style="background-color:<?php echo $column_color; ?>">
				
				<!-- <h1>About</h1> -->
				
				<div class="about-des-area" id="about_des_area">
					<?php echo $cat_des; ?>
				</div>
			</div>

		</div>
	</div>

	<div class="footer" style="background-color:<?php echo $window_color; ?>">
		Copyright ©2021 All rights reserved
	</div>


	<!-- JavaScript -->
	<script type="text/javascript" src="script/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<!-- <script type="text/javascript" src="script/sweetalert.min.js"></script> -->
	<script type="text/javascript" src="script/catagory.js"></script>
	
	
	<script type="text/javascript">
			
		$('#src_icon').click(function() {
			
			var search_input = $('#search').val();
			search_check = search_input.replace(/ /g,'');
			// console.log(search_input);
			if(search_check != ""){
				
				location.href = 'all-items?search='+search_input;
			}
		});
			
		
		$('#main_logo_img').click(function() {
			window.location = "home";
		});
		
		
		if(window.innerWidth <= 700){
			
			var main_ul_width = (document.getElementById("main_ul").offsetWidth - 15 );
			// var main_ul_width = 88;
			$('.sub-menu').css({"margin-left":""+main_ul_width+"px"});
			console.log("moblie device");
			
			// collapse nav
			$('#collapse_nav').children('i').removeClass("fa fa-times");
			$('#collapse_nav').children('i').addClass("fa fa-bars");
			$('#main_ul').css({"display":"none"});
			$('#collapse_nav').css({"transform":"translate(0%, -50%)"});
		}
		
		// hover background color fix .............................................
		var main_ul_li_backcolor = '<?php echo $window_color; ?>';
		$(".main-li").hover(function(){
			
			if(main_ul_li_backcolor.length == 7){
				$(this).css("background-color", main_ul_li_backcolor);
			}else{
				$(this).css("background-color", "#748DB4");
			}
			
		}, function(){
			if($(this).hasClass("selected-mail-li") == false){
				$(this).css("background-color", "transparent");
			}
			
		});	

		// main menu background color fix..................................................
		var main_menu_backcolor = '<?php echo $body_color; ?>';
		if(main_menu_backcolor.length == 7){
			
			$('#main_ul').css("background-color", main_menu_backcolor);
		}else{
			
			$('#main_ul').css("background-color", "#0E1633");
		}

		// sub menu background color fix..................................................
		var sub_menu_backcolor = '<?php echo $column_color; ?>';
		if(sub_menu_backcolor.length == 7){
			
			$('.sub-menu').css("background-color", sub_menu_backcolor);
			$('.window-part').css('background-color',sub_menu_backcolor);
		}else{
			
			$('.sub-menu').css("background-color", "#90B2C4");
			$('.window-part').css('background-color', "#90B2C4");
		}
	
		
		
		
		$('#collapse_nav').click(function() {
			
			// console.log("ok");
			// $("#main_ul").style.border = '2px solid red';
			
			if( $('#collapse_nav').children('i').attr('class') == "fa fa-times"){
				
				$('#collapse_nav').children('i').removeClass("fa fa-times");
				$('#collapse_nav').children('i').addClass("fa fa-bars");
				$('#main_ul').css({"display":"none"});
				
				$('#collapse_nav').css({"transform":"translate(0%, -50%)"});
			}
			else{
				
				$('#collapse_nav').children('i').removeClass("fa fa-bars");
				$('#collapse_nav').children('i').addClass("fa fa-times");
				$('#main_ul').css({"display":"block"});
				
				$('#collapse_nav').css({"transform":"translate(0%, 0%)"});
			}
			// console.log($('#collapse_nav').children('i').attr('class'));
		});
		
		
		$('#seleted_sub_li').css({"color":"black"});
		
		//ready window...................................................
		window.onload = function()
		{
			
			// if(window.innerHeight < 768){
			// console.log(window.innerHeight);
			
			// var view_height = window.innerHeight;
			// var about_des_height = view_height - 50 - 48 - 25;
			
			// var about_des_area = document.getElementById("about_des_area");
			
			// var abt_des_original_height = about_des_area.offsetHeight;
			// console.log(abt_des_original_height);
			
			// if(abt_des_original_height > about_des_height){
				
				// console.log("overflow");
			// }
			// about_des_area.setAttribute("style", "height:"+about_des_height+"px");
			// about_des_area.setAttribute("style", "margin-top: calc(10% + "+(view_height/100)+"px");

			// $("#about_des_area").style.color = 'red';
			
			
			
		}
		


		window.onresize = function(){
			// console.log("window resized");
		}
		
	</script>
	
	
	
	
</body>
</html>