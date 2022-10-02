<?php

	//include database connection file
	include_once('connection.php');
    mysqli_select_db($conn,'sessionpractical');
    error_reporting(0);

	//getting post variables from the login form
    $email = addslashes($_POST['email']);
    $password = $_POST['pass'];
	
	//start session
    session_start();
    
	//if submit button clicked
    if(isset($_POST['submit'])){
        
		//checking if user email and password is correct
		$newPass = sha1("$&ApW".$password."#%XvbuA@V");
		// sha1($str);
		// echo $newPass;
        $qr = "select * from admininfo where email='$email' && password='$newPass'";
        
		//query fire
		$result = $conn->query($qr);

		//checking if match found or not
		if ($result->num_rows == 1) {
			
			//store session variables
			$_SESSION['user_email'] = $email; 
			$_SESSION['user_hashpass'] = $newPass; 
			$row = $result->fetch_assoc();
			$_SESSION['user_id'] = $row["id"];

            header('location:admin');
			
		}
		else{
			
			echo "mismatch";
			//if not match email and password
			// $error_msg['warning_msg']= "Wrong email or password !";
		}
		
    }

?>



<!doctype html>
<html lang="en">

<head>
   <!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- Bootstrap CSS -->
   <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
   <link href="css/login-admin.css" rel="stylesheet">

	
   <!-- <link href="css/body.css" rel="stylesheet"> -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
   
   <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&amp;family=Playfair+Display:wght@400;700&amp;display=swap" rel="stylesheet">
   
   <title>Soliloquy</title>
   <!-- <link rel="icon" href="image/logo/fav-icon.png" type="image/gif" sizes="16x16"> -->
   
</head>

<body>

	
	<div class="container-fluid">
		<div class="row">
			<div class="navbar">
			
				<div class="logo">
					Soliloquy
				</div>
			
				<div class="nav-only">
					<ul>
						<!--
						<li><a href="vendor_signup.php" style="color:cyan"><div class="nav-item-right">Signup</div></a></li>
						<li><a href="vendor_login.php" style="color:cyan"><div class="nav-item-right">Login</div></a></li>
						-->
					</ul>
				</div>
			</div>
			
			<div class="slider">
				<div class="row">
					<div class="col-lg">
						<form method="post" id="register" >
						   <h2>Admins only login</h2>
						   
							<label> Email:</label>
							<br>
							
							<input class="form_input" type="email" name="email" id="mail" placeholder="Enter Email" required ><br>
							<br>

							<label> Password:</label>
							
							<br>
							<input class="form_input" type="password" name="pass" id="pass" placeholder="Enter Password" required ><br>
							<br>

							<input name="submit" type="submit" value="submit" id="sub">
							<?php
								if(isset($error_msg['warning_msg'])){
									//warning msg for not matching email or password
									echo "<span style='color:red'>".$error_msg['warning_msg']."</span>";
								}
							?>
								
						</form>
					</div>
				</div>
			</div>
		
		</div>
	</div>


   <!-- JavaScript -->
   <script type="text/javascript" src="script/jquery-3.5.1.min.js"></script>
   <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="script/sweetalert.min.js"></script>
   

</body>

</html>
