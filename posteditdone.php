<?php
	include_once"includes/header.php";
	include_once"connection.php";
	
	//image prepare
    $uploadedImages = array();
    if (isset($_FILES['image']))
    {
        $errors = array();
        $images = $_FILES['image'];
        $count = is_array($images['name']) ? count($images['name']) : 1;

        for ($i = 0; $i < $count; $i++) {
            $file_name = is_array($images['name']) ? $images['name'][$i] : $images['name'];
            $file_size = is_array($images['size']) ? $images['size'][$i] : $images['size'];
            $file_tmp  = is_array($images['tmp_name']) ? $images['tmp_name'][$i] : $images['tmp_name'];
            $file_error = is_array($images['error']) ? $images['error'][$i] : $images['error'];

            if ($file_error === UPLOAD_ERR_NO_FILE) {
                continue;
            }

            if ($file_error !== UPLOAD_ERR_OK) {
                $errors[] = "Upload error for file: " . htmlspecialchars($file_name);
                continue;
            }

            $file_end = explode('.', $file_name);
            $file_ext = strtolower(end($file_end));
            $formats = array('jpeg', 'jpg', 'png');

            if (!in_array($file_ext, $formats)) {
                $errors[] = "please choose jpg or png files";
                continue;
            }

            if ($file_size > 3145728) {
                $errors[] = "file is too large, file should be below 3 mb";
                continue;
            }

            $safeName = time() . '_' . $i . '_' . basename($file_name);
            if (move_uploaded_file($file_tmp, "apartment_images/" . $safeName)) {
                $uploadedImages[] = $safeName;
            } else {
                $errors[] = "Failed to save uploaded file: " . htmlspecialchars($file_name);
            }
        }

        if (!empty($uploadedImages)) {
            $_POST['image'] = implode(',', $uploadedImages);
        } elseif (isset($_POST['current_images'])) {
            $_POST['image'] = $_POST['current_images'];
        }

        if (!empty($errors)) {
            print_r($errors);
        }
    }

	$apt_id=$_POST['id'];
	

	 $apt_city    =$_POST['flat_city'];
	 $apt_location=$_POST['flat_location'];
	 $rent        =$_POST['flat_rent'];
	 $available   =$_POST['available'];
	 $apt_size    =$_POST['flat_size'];
	 $apt_no_of_rooms    =$_POST['num_of_rooms'];
	 $apt_additional_info=$_POST['additional_info'];
	 $apt_image		  =isset($_POST['image']) ? $_POST['image'] : '';
	 
	 $apartment=mysqli_query($con,"UPDATE available_flats  
	 	set flat_city='$apt_city', 
	 	flat_location='$apt_location',
	 	flat_rent    ='$rent', 
	 	available   ='$available' 
	 	where flat_id='$apt_id'");
	// print_r($apt_image);
	 if(empty($apt_image)){
		 $apartment_details=mysqli_query($con,"UPDATE flat_details 
		 	set  flat_city='$apt_city', 
		 	flat_location='$apt_location',
		 	flat_size  ='$apt_size',
		 	num_of_rooms   ='$apt_no_of_rooms', 
		 	additional_info='$apt_additional_info'
		 	where flat_id  ='$apt_id' ");
	 } else {
		 $apartment_details=mysqli_query($con,"UPDATE flat_details 
		 	set  flat_city='$apt_city', 
		 	flat_location='$apt_location',
		 	flat_size  ='$apt_size',
		 	num_of_rooms   ='$apt_no_of_rooms', 
		 	additional_info='$apt_additional_info', 
			image='$apt_image'
		 	where flat_id  ='$apt_id' ");
	 }
		
?>

		<div style="width: 70%; margin: 0 auto;">
			<div style="float: left; width: 25%; font-size: 5em; text-align: center; color: #28a745;">✓</div>
			<div><h1 style="float: right; font-size: 1.5em;"> Post Edited Successfully!</h1></div>
		</div>


		</div> 
	</body>
</html>	