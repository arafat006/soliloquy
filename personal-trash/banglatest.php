<?php
	
	mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
	
	$mysqli = new mysqli("localhost", "xorbite_soliloquy_user_main1", "e%on7M1nVtI4;ku@#_", "xorbite_soliloquy");
	$mysqli->set_charset("utf8");
	
	// mysql_select_db('profile'));
	
	// mysql_query('SET CHARACTER SET utf8');
	// mysql_query("SET SESSION collation_connection ='utf8_general_ci'");
	
	
	if(isset($_POST['submit'])){
		
		$usenm = $_POST['username'];
		$qy="INSERT INTO profile (name) VALUES ('$usenm')";
		// mysql_query('SET CHARACTER SET utf8');
		// mysql_query("SET SESSION collation_connection ='utf8_general_ci'");			
		mysqli_query($mysqli,$qy);
	}
	
	$query="SELECT * FROM profile";
	$r=mysqli_query($mysqli,$query);
	
	while($row=mysqli_fetch_array($r)){
		
		echo $row["name"];
	}


?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Atma:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	
	<title></title>
</head>
<body style="font-family: 'Atma', cursive;">

	<form method="post">
		<input type="text" name="username"/>
		<input type="submit" name="submit" />
	</form>
	
</body>
</html>