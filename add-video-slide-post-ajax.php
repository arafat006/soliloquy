<?php
	
	//include database connection file
	include_once('connection.php');
	
	//getting post variables from ajax req
	$prod_id = $_POST['prod_id'];
	$vid_link = addslashes($_POST['vid_link']);
	$vid_cap = addslashes($_POST['vid_cap']);
	$type = "vid";
	date_default_timezone_set("UTC");
	$date=date("Y-m-d H:i:s", time());
	
	//query for add to the productslider
	$qy="insert into productslider (item_id, iov_path, captions, type, save_time) 
		values ('$prod_id','$vid_link','$vid_cap','$type','$date')";
	
	$result = mysqli_query($conn, $qy) or die("SQL query failed");
	
	//checking if insert query is successfull or not
	if(mysqli_affected_rows($conn)>0){
		
		//if success return success
		echo "success";
	}
	
	// echo "success";
	//database connection close 
	mysqli_close($conn);
	
?>