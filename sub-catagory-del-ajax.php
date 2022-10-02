<?php
	
	//include database connection file
	include_once('connection.php');
	
	//getting post variables getting from ajax req
	$serial = $_POST['serial']; 
	// echo $serial;
	// echo "fas";
	//set foreign key check disable
	$qr = "SET FOREIGN_KEY_CHECKS=0;";
	$result = mysqli_query($conn, $qr) or die("SQL query failed");
	
	//delete cart item from cart table
	$qr = "DELETE FROM itemdetails WHERE serial='$serial'";
	$result = mysqli_query($conn, $qr) or die("SQL query failed");
	
	//checking if insert query is successfull or not
	if(mysqli_affected_rows($conn)>0){
		
		//if success return success
		echo "success";
	}
	
	//database connection close 
	mysqli_close($conn);
	
?>