<?php

	
	include_once('connection.php');
    mysqli_select_db($conn,'sessionpractical');
    error_reporting(0);

	if(isset($_FILES['file']['name'])){

		/* Getting file name */
		$filename = $_FILES['file']['name'];
		$target = $_POST["name"];
		$serial = $_POST["serial"];

		/* Location */
		$location = "cat_subcat_image/".$filename;

		// echo 0;
		// echo $serial;
		// echo $target;
		// echo $filename;
		// return;
		//add image path to itemdetails
		$qr = "UPDATE itemdetails SET img_path='$target' WHERE serial='$serial'";
		$result = mysqli_query($conn, $qr) or die("SQL query failed");
		//checking if insert query is successfull or not
		if(mysqli_affected_rows($conn)>0){
			
			//if success return success
			// echo "success";
		}
		else{
			
			// echo "sql failed";
			// mysqli_close($conn);
			// exit;
		}
		
		//get extension
		$img_ext = pathinfo($filename, PATHINFO_EXTENSION);
		
		// image file directory
		// $target = "posters/".$ori_name.'.'.$img_ext;
		
		$imageFileType = pathinfo($location,PATHINFO_EXTENSION);
		$imageFileType = strtolower($imageFileType);

		/* Valid extensions */
		$valid_extensions = array("jpg","jpeg","png");

		$response = 0;
		/* Check file extension */
		if(in_array(strtolower($imageFileType), $valid_extensions)) {
		  /* Upload file */
			if(move_uploaded_file($_FILES['file']['tmp_name'],$target)){
				$response = $target;
			}
		}
		
		mysqli_close($conn);
		echo $response;
		exit;
	}

	echo 0;
?>