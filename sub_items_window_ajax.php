<?php
	
	//include database connection file
	include_once('connection.php');
	
	//getting post variables from ajax req
	$main_cat_name = addslashes($_POST['main_cat_name']);
	$current_page = $_POST['current_page'];
	$trv = $_POST['trv'];
	
	if($trv == "next"){
		
		$start_item = (6*$current_page)+1;
	}
	else{
		$start_item = (6*($current_page-2))+1;
	}

	// echo $start_item;
	// echo $end_item;
	
	// $all_items = array();
	// $item_index = array();
	// $img_path = array();
	$img_path = "";
	$subcat_name = "";
	$subcat_serial = "";
	
	$query="SELECT serial, type, main_item, sub_item, img_path FROM itemdetails where main_item='$main_cat_name' ORDER BY serial ASC Limit $start_item,6";
	$r=mysqli_query($conn,$query);
	
	$count_ind = 0;
	$total_items = mysqli_num_rows($r);
	if(mysqli_num_rows($r) > 0){
		
		while($row=mysqli_fetch_array($r)){
			
			// array_push($item_index,$row["serial"]);
			$img_path = $img_path."~".$row["img_path"];
			$subcat_name = $subcat_name."~".$row["sub_item"];
			$subcat_serial = $subcat_serial."~".$row["serial"];
		
		}
	}
	
	// print_r($img_path);
	// echo json_encode($item_index);
	$img_path = ltrim($img_path, $img_path[0]);
	$subcat_name[0] = "+";
	$subcat_serial[0] = "+";

	// echo $img_path;
	echo $img_path.$subcat_name.$subcat_serial;
 
	mysqli_close($conn);
	
?>