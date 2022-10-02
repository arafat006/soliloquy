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
	<link href="css/allitem-index.css" rel="stylesheet" >
	<link href="css/allitem-index2.css" rel="stylesheet" >
	
	
	
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
			
		?>
		
	</div>
	
	

	<div class="container-fluid body-2-container">
		<div class="body-1-row">
			
			<div class="navbar-holder"> 
				<div class="navbar">
					<div class="collapse-nav" id="collapse_nav"><i class="fa fa-bars" aria-hidden="true"></i> </div>
					<ul class="main-ul" id="main_ul">
						
						<li class="main-li"><a href="home"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
							
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
			
		</div>
	</div>
	
	<div class="container-fluid item-holder-container">
		<div class="row item-holder-row">
			
			<?php 
			
			
			$max_item_show = 24;
			$page_index=0;
			
			if(isset($_GET['pageindex'])){
				$page_index=$_GET['pageindex'];
			}else{
				$page_index=1;
			}
			
			$start_post_indx = ($page_index - 1)*$max_item_show;
			
			$query="SELECT id FROM products where available=1";
			//filtering with catagory.....................................................................................
			if(isset($_GET['cat'])){
				$get_cat = $_GET['cat'];
				$query="SELECT p.id as id FROM products p inner JOIN itemdetails i 
				ON i.sub_item=p.sub_catagory where serial like '$get_cat%' and available='1'";
			}
			if(isset($_GET['subcat'])){
				$get_subcat = $_GET['subcat'];
				$query="SELECT p.id as id FROM products p inner JOIN itemdetails i 
				ON i.sub_item=p.sub_catagory where serial='$get_subcat' and available='1'";
			}
			if(isset($_GET['search'])){
				$get_search = $_GET['search'];
				$query="SELECT p.id as id FROM products p inner JOIN itemdetails i 
				ON i.sub_item=p.sub_catagory where name Like '%$get_search%' and available='1'";
			}
			$r=mysqli_query($conn,$query);
			$total_post = mysqli_num_rows($r);

			// query for showing slides which is available
			$total_page = $total_post/$max_item_show;
			// echo $total_page;
			if($total_page == 0){
				
				$total_page = 1;
			}
			else{
				$total_page = ceil($total_page);
			}
			
			
			$query="SELECT p.id as id,name,path,catagory,sub_catagory,upload_date,serial FROM products 
					p Left JOIN itemdetails i ON i.sub_item=p.sub_catagory where available='1' 
					ORDER by upload_date DESC LIMIT $start_post_indx,$max_item_show";
			
			//filtering with catagory.....................................................................................
			if(isset($_GET['cat'])){
				
				$get_cat = $_GET['cat'];
				
				$query="SELECT p.id as id,name,path,catagory,sub_catagory,upload_date,serial FROM products 
				p inner JOIN itemdetails i ON i.sub_item=p.sub_catagory where serial like '$get_cat%' and available='1' 
				ORDER by upload_date DESC LIMIT $start_post_indx,$max_item_show";
				
			}
			if(isset($_GET['subcat'])){
				
				$get_subcat = $_GET['subcat'];
				
				$query="SELECT p.id as id,name,path,catagory,sub_catagory,upload_date,serial FROM products 
				p inner JOIN itemdetails i ON i.sub_item=p.sub_catagory where serial='$get_subcat' and available='1' 
				ORDER by upload_date DESC LIMIT $start_post_indx,$max_item_show";
			}
			if(isset($_GET['search'])){
				
				$get_search = $_GET['search'];
				
				$query="SELECT p.id as id,name,path,catagory,sub_catagory,upload_date,serial FROM products 
				p inner JOIN itemdetails i ON i.sub_item=p.sub_catagory where name Like '%$get_search%' and available='1' 
				ORDER by upload_date DESC LIMIT $start_post_indx,$max_item_show";
			}
			
			$r=mysqli_query($conn,$query);
			$total_items = mysqli_num_rows($r);
			
			if($total_items == 0){
			?>	
				
			<div class="no-item-box">
				No posts!!!
			</div>
				
			<?php
			}

			while($row=mysqli_fetch_array($r)){
				
				// if($row["path"];)
				if($row["path"] == "Nan"){
					
					
					?>
					<a href="itemview?id=<?php echo $row["id"];?>&subcat=<?php echo $row["serial"];?>" class="item-box-holder col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6">
						<div class="img-holder" style="background: #748DB4 none no-repeat center center / cover;" >
							
							<div class="info-holder">
								
								<div class="info-box">
									<div class="item-des text-center item-cat" title="<?php echo $row["catagory"]?>"><?php echo $row["catagory"]?></div>
									<div class="item-des text-center item-name" title="<?php echo $row["name"]?>"><?php echo $row["name"]?></div>
									<div class="item-des text-center item-date" title=""><?php echo substr($row["upload_date"],0,10); ?></div>
								</div>
								
							</div>
						
						</div>
					</a>
					
					<?php
					
				}
				else{
				?>
				<!-- -->
				<a href="itemview?id=<?php echo $row["id"];?>&subcat=<?php echo $row["serial"];?>" class="item-box-holder col-xl-3 col-lg-3 col-md-3 col-sm-4 col-6">
					<div class="img-holder" style="background: #748DB4 url(<?php echo $row["path"];?>) no-repeat center center / cover;" >
						
						<div class="info-holder">
							
							<div class="info-box">
								<div class="item-des text-center item-cat" title="<?php echo $row["catagory"]?>"><?php echo $row["catagory"]?></div>
								<div class="item-des text-center item-name" title="<?php echo $row["name"]?>"><?php echo $row["name"]?></div>
								<div class="item-des text-center item-date" title=""><?php echo substr($row["upload_date"],0,10); ?></div>
							</div>
							
						</div>
					
					</div>
				</a>
				
				<?php 
				}
			}

		?>
			
		</div>
	</div>
	

	
	<div class="container-fluid tradingpage-part-container">
		<div class="row tradingpage-part-row">
			<div class="trading-page-holder">
				
				<?php 
					if($total_page > 1){
						for($i=1;$i<=$total_page;$i++){
						?>
						<div name="<?php echo $i;?>" class="trade-pages<?php if($page_index==$i){ echo " active-trade-pages"; }?>">Page <?php echo $i;?></div>
						<?php 
						}
					}
				?>
				
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
	<script type="text/javascript" src="script/allitems.js"></script>
	
	
	<script type="text/javascript">
	
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
		
	
		
		$('.trade-pages').click(function() {
		
		
			var get_cat = '<?php if(isset($get_cat)){ echo $get_cat;}?>';
			var get_subcat = '<?php if(isset($get_subcat)){ echo $get_subcat;}?>';
			var get_search = '<?php if(isset($get_search)){ echo $get_search;}?>';
			
			var page_selected = $(this).attr("name");
			
			if(get_subcat != "")
			{
				location.href = 'all-items?pageindex='+page_selected+'&subcat='+get_subcat;
				return;
			}
			
			if(get_cat != "")
			{
				location.href = 'all-items?pageindex='+page_selected+'&cat='+get_cat;
				return;
			}
			
			if(get_search != "")
			{
				location.href = 'all-items?pageindex='+page_selected+'&search='+get_search;
				return;
			}
			
			
			
			location.href = 'all-items?pageindex='+page_selected;
			
		});

	
		$('#src_icon').click(function() {
			
			var search_input = $('#search').val();
			search_check = search_input.replace(/ /g,'');
			// console.log(search_input);
			if(search_check != ""){
				
				location.href = 'all-items?search='+search_input;
			}
		});
		
		
		//ready window...................................................
		window.onload = function()
		{
			if(window.innerWidth > 470){
				
				// console.log("Big moblie");
				
				$(".item-box-holder").addClass('col-6');
				$(".item-box-holder").removeClass('col-12');
			
			}
			else{
				
				// console.log("Little moblie");
				
				$(".item-box-holder").addClass('col-12');
				$(".item-box-holder").removeClass('col-6');
			}
			
			// console.log(window.innerHeight);
			
			// if(window.innerWidth <= 470){
				
				// Image height fix for little moblie devices...
				
				$(".img-holder").height($(".item-box-holder").width()*0.7);
			
			// }
			
			
			
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
			
			
			if(window.innerWidth > 470){
				
				// console.log("Big moblie");
				
				$(".item-box-holder").addClass('col-6');
				$(".item-box-holder").removeClass('col-12');
			
			}
			else{
				
				// console.log("Little moblie");
				
				$(".item-box-holder").addClass('col-12');
				$(".item-box-holder").removeClass('col-6');
			}
			
			// if(window.innerWidth <= 470){
				
				// Image height fix for little moblie devices...
				
			$(".img-holder").height($(".item-box-holder").width()*0.7);
			
			// }
		}
		
	</script>
	
	
	
	
</body>
</html>