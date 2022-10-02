<?php
	
	//include database connection file
	include_once('connection.php');
	
	//getting post variables from ajax req
	$serial = $_POST['serial'];
	$catagory = $_POST['catagory'];
	$sub_catagory = $_POST['sub_catagory'];
	$type = "sub";
	
	//query for add to the itemdetails
	$qy="insert into itemdetails (serial, type, main_item ,sub_item) values ('$serial','$type','$catagory','$sub_catagory')";
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