<?php

	
	include_once('connection.php');
    mysqli_select_db($conn,'sessionpractical');
    error_reporting(0);

	if(isset($_FILES['file']['name'])){

		/* Getting file name */
		$filename = $_FILES['file']['name'];
		$target = $_POST["name"];
		$prod_id = $_POST["prod_id"];
		$prod_cap = addslashes($_POST["prod_cap"]);

		$query="SELECT item_id FROM productslider where item_id='$prod_id'";
		$r=mysqli_query($conn,$query);
		$serial_count = (mysqli_num_rows($r) + 1);
		
		/* Location */
		$location = "product_slide/".$filename;

		//get extension
		$img_ext = pathinfo($filename, PATHINFO_EXTENSION);
		$target = "product_slide/".$prod_id."_".$serial_count.".".$img_ext;
		
		
		
		date_default_timezone_set("UTC");
		$date=date("Y-m-d H:i:s", time());
		
		$qr = "INSERT INTO productslider (item_id, iov_path, captions, save_time) 
				VALUES ('$prod_id','$target','$prod_cap','$date')";
				
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