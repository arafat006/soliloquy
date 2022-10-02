<?php
	
	//include database connection file
	include_once('connection.php');
	
	//getting post variables from ajax req
	$serial = $_POST['serial'];
	$color_all = addslashes($_POST['color_all']);
	
	// echo $serial;
	// echo " ";
	// echo $des_text;
	//query for add to the itemdetails
	
	
	$qy="UPDATE itemdetails SET color='$color_all' WHERE serial='$serial'";
	$result = mysqli_query($conn, $qy) or die("SQL query failed");
	if(mysqli_affected_rows($conn)>0){
		echo "success";
	}
	
	// if($conn->query($qy) === TRUE){
		// echo "success";
	// }
	// else{
		
	// }
	// echo "success";
	//database connection close 
	mysqli_close($conn);
	
?>