<?php
	
	//include database connection file
	include_once('connection.php');
	
	//getting post variables from ajax req
	$main_cat_name = addslashes($_POST['main_cat_name']);
	$current_page = $_POST['current_page'];
	$trv = $_POST['trv'];
	
	if($trv == "next"){
		
		$start_item = (6*$current_page);
		$end_item = $start_item+6;
	}
	else{
		$start_item = (6*($current_page-2));
		$end_item = $start_item+6;
	}

	// echo $start_item;
	// echo $end_item;
	
	// $all_items = array();
	// $item_index = array();
	// $img_path = array();
	$img_path = "";
	$subcat_name = "";
	$subcat_serial = "";
	
	$query="SELECT serial, type, main_item, sub_item, img_path FROM itemdetails where main_item='$main_cat_name' ORDER BY serial ASC";
	$r=mysqli_query($conn,$query);
	
	$count_ind = 0;
	$total_items = mysqli_num_rows($r);
	if(mysqli_num_rows($r) > 0){
		
		while($row=mysqli_fetch_array($r)){
			
			//showing data in html div 
			// array_push($all_items,$row["sub_item"]);
			// echo $row["serial"];
			// array_push($item_index,$row["serial"]);
			// $row["main_item"];
			// array_push($img_path,$row["img_path"]);
			
			if($start_item < $count_ind){
				// array_push($item_index,$row["serial"]);
				$img_path = $img_path."~".$row["img_path"];
				$subcat_name = $subcat_name."~".$row["sub_item"];
				$subcat_serial = $subcat_serial."~".$row["serial"];
			}
			$count_ind++;
			if($end_item < $count_ind){
				break;
			}
			
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