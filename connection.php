<?php

	//database connect information
	$servername = "localhost";
	$username = "rqpdoqir_admin1";
	$password = "Uh+XD*Vgv]4PU[Nd?g";
	$dbname= "rqpdoqir_soliloquy";
	
	// Create connection with database
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	// Check connection
	if ($conn) {
		//echo"ok";
	} 
	else{ 
		
		//if connection not ok
		die("Connection failed because ".mysqli_connect_error());
	}

?>