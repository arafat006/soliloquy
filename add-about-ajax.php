<?php
	
	//include database connection file
	include_once('connection.php');
	
	$des_text = addslashes($_POST['des_text']);
	
	$qy="UPDATE home SET description='$des_text'";
	$result = mysqli_query($conn, $qy) or die("SQL query failed");
	if(mysqli_affected_rows($conn)>0){
		echo "success";
	}
	mysqli_close($conn);
?>