<?php
	
	//include database connection file
	include_once('connection.php');
	
	//getting post variables from ajax req
	$serial = $_POST['serial'];
	$des_text = addslashes($_POST['des_text']);
	
	// echo $serial;
	// echo " ";
	// echo $des_text;
	//query for add to the itemdetails
	
	
	$qy="UPDATE itemdetails SET description='$des_text' WHERE serial='$serial'";
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