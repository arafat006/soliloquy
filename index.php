<?php
	
	include_once('connection.php');
    // mysqli_select_db($conn,'sessionpractical');
    // error_reporting(0);
?>


<!DOCTYPE html>

<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" >
	<link href="css/index.css" rel="stylesheet" >
	<link href="css/index2.css" rel="stylesheet" >
	
	
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<!-- Bangla fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Atma:wght@300&display=swap" rel="stylesheet">
	

	<title>Soliloquy</title>
	<link rel="icon" href="image/fav-icon-org.png" type="image/png" sizes="16x16" >
</head>

<body>

	<div style="color:white">
	
		<?php
		
			$all_items = array();
			$item_index = array();
			
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

			$query="SELECT * FROM home LIMIT 1";
			$r=mysqli_query($conn,$query);
			$about=mysqli_fetch_array($r);
		?>
		
	</div>
	
	

	<div class="container-fluid body-1-container">
		<div class="row body-1-row">
			
			<div class="navbar-holder"> 
				<div class="navbar">
					<div class="collapse-nav" id="collapse_nav"><i class="fa fa-bars" aria-hidden="true"></i> </div>
					<ul class="main-ul" id="main_ul">
						
						<li class="main-li selected-mail-li"><a href="home"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
							
						<?php
						
							//$s_ind = 0;
							for($ind = 0; $ind < $total_items; ) {
								
								// echo "Key=" . $menu . ", Value=" . $menu_value;
								?>
								
								<li class="main-li" id="seeking_menu"><a href="<?php echo "catagory?cat=".$item_index[$ind]; ?>"> <?php echo $all_items[$ind]; ?></a>
									
									<?php 
									
										$main_cat_pass = true; 
										$first_sub_pass = false; 
										$sub_need_pass = false; 
										
										$temp_serial = (int)$item_index[$ind];
										// echo $temp_serial;
										// echo $index_main_menu[0];
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
											
											
											echo '<li class="submenu-li-dashbar"></li>
											<li class="submenu-li"><a href="subcatagory?cat='.(int)$item_index[$ind].'&subcat='.$item_index[$ind].'">'.$all_items[$ind].'</a></li>';
											
											
											$ind++;
											if($total_items == $ind){
												break;
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
						
						
						<!--
						<li class="main-li" id="seeking_menu"><a href="#">Seeking Self</a>
							<div class="sub-menu" id="sub_menu_1">
								<ul class="submenu-ul">
									<li class="submenu-li-dashbar"></li>
									<li class="submenu-li"><a href="#">Item 1</a></li>
									<li class="submenu-li-dashbar"></li>
									<li class="submenu-li"><a href="#">Item 2</a></li>
									<li class="submenu-li-dashbar"></li>
									<li class="submenu-li"><a href="#">Item 3</a></li>
									<li class="submenu-li-dashbar"></li>
									<li class="submenu-li"><a href="#">Item 4</a></li>
									<li class="submenu-li-dashbar"></li>
									<li class="submenu-li"><a href="#">Item 5</a></li>
								</ul>
							</div>
						</li>
						
						<li class="main-li" id="sail_menu"><a href="#">Sail to Soul</a>
							<div class="sub-menu" id="sub_menu_2">
								<ul class="submenu-ul">
									<li class="submenu-li-dashbar"></li>
									<li class="submenu-li"><a href="#">Item 1</a></li>
									<li class="submenu-li-dashbar"></li>
									<li class="submenu-li"><a href="#">Item 2</a></li>
									<li class="submenu-li-dashbar"></li>
									<li class="submenu-li"><a href="#">Item 3</a></li>
									<li class="submenu-li-dashbar"></li>
									<li class="submenu-li"><a href="#">Item 4</a></li>
									<li class="submenu-li-dashbar"></li>
									<li class="submenu-li"><a href="#">Item 5</a></li>
								</ul>
							</div>
						</li>
						
						<li class="main-li" id="slip_menu"><a href="#">Slip on slaying</a>
							<div class="sub-menu" id="sub_menu_3">
								<ul class="submenu-ul">
									<li class="submenu-li-dashbar"></li>
									<li class="submenu-li"><a href="#">Item 1</a></li>
									<li class="submenu-li-dashbar"></li>
									<li class="submenu-li"><a href="#">Item 2</a></li>
								</ul>
							</div>
						</li>
						
						<li class="main-li" id="savour_menu"><a href="#">Savour Savannah</a>
							<div class="sub-menu" id="sub_menu_4">
								<ul class="submenu-ul">
									<li class="submenu-li-dashbar"></li>
									<li class="submenu-li"><a href="#">Item 1</a></li>
									<li class="submenu-li-dashbar"></li>
									<li class="submenu-li"><a href="#">Item 2</a></li>
									<li class="submenu-li-dashbar"></li>
									<li class="submenu-li"><a href="#">Item 3</a></li>
									<li class="submenu-li-dashbar"></li>
									<li class="submenu-li"><a href="#">Item 4</a></li>
								</ul>
							</div>
						</li>
						-->
					</ul>
				</div>
				
				<div class="col-bar-1">
				
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
					
						<?php
						//query for showing slides which is available
						$query="SELECT * FROM slides";
						$r=mysqli_query($conn,$query);
						
						$total_slide = mysqli_num_rows($r);
						//checking if at least 1 data found or not
						if(mysqli_num_rows($r) > 0){
							
							//if found the extract row by colomns and show in html div
							while($row=mysqli_fetch_array($r)){
								
								//showing data in html div 
								echo '<div class="slide-page ">
									     <img src="'.$row["path"].'" alt="">
									  </div>';
							}
						}
						?>
						<!--
						<div class="slide-page ">
						  <img src="image/6.jpg" alt="">
						</div>
						-->
						
						<div class="navigation-part">
							<div class="prev nav-butt-sld" id="prev">&#10094;</div>
							<div class="next nav-butt-sld" id="next">&#10095;</div>
						</div>
						
						
						<div class="dotnav-part">
							<?php  
							for($i=0;$i<$total_slide;$i++){
								echo '<div class="dot-nav"><i class="fa fa-square" aria-hidden="true"></i></div>';
							}
							?>
						</div>
						
						<div class="box-border">
							
						</div>
						
						<div class="logo">
							<img id="main_logo_img" src="image/logo-white.png" alt="Logo" />
						</div>
						
					</div>
					
					
				</div>
			</div>
			
			
			<div class="extra-bottom">
				<div class="col-bar-2">
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
		
			<div class="window-left">
				
				<?php
				
				//query for showing slides which is available
				$query="SELECT p.id as id,name,path,catagory,sub_catagory,upload_date,serial FROM products p INNER JOIN itemdetails i ON i.sub_item=p.sub_catagory where available='1' ORDER by upload_date DESC LIMIT 6";
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
											<p class="name-part" title="'.$row["name"].'"><a href="itemview?id='.$row["id"].'">'.$row["name"].'</a></p>
											<p class="date-part">'.substr($row["upload_date"],0,10).'</p>
										</div>
									</div>
								</div>';
						}
						$i++;
					}
				}
				?>
				
				<div class="window-paging"> 
				
					<div class="window-page-info" id="window_page_info">
						<a href="all-items">Show more ...</a>
					</div>
					
				</div>
				
				
			</div>
			
			<div class="window-right"></div>
		
		
			<div class="col-bar-3">
				
				<h1>About</h1>
				
				<div class="about-des-area" id="about_des_area">
					<?php echo $about["description"]; ?>
				</div>
			</div>

		</div>
	</div>

	<div class="footer">
		Copyright ©2021 All rights reserved
	</div>


	<!-- JavaScript -->
	<script type="text/javascript" src="script/jquery-3.5.1.min.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<!-- <script type="text/javascript" src="script/sweetalert.min.js"></script> -->
	<script type="text/javascript" src="script/main.js"></script>
	
	
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
		
		
		
		$('#collapse_nav').click(function() {
			
			console.log("ok");
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
		
	
		$('.window-part').css('background-color', "#90B2C4");
		
		
		//ready window...................................................
		window.onload = function()
		{
			// if(window.innerHeight < 768){
			// console.log(window.innerHeight);
			
			var view_height = window.innerHeight;
			var about_des_height = view_height - 50 - 48 - 25;
			
			var about_des_area = document.getElementById("about_des_area");
			
			var abt_des_original_height = about_des_area.offsetHeight;
			// console.log(abt_des_original_height);
			
			if(abt_des_original_height > about_des_height){
				
				// console.log("overflow");
			}
			// about_des_area.setAttribute("style", "height:"+about_des_height+"px");
			// about_des_area.setAttribute("style", "margin-top: calc(10% + "+(view_height/100)+"px");

			// $("#about_des_area").style.color = 'red';
			
			
		}
		
		

		window.onresize = function(){
			// console.log("window resized");
			
			
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
		}
		
	</script>
	
	
	
	
</body>
</html>