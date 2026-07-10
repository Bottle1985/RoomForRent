<?php
	include_once"includes/header.php";
	include_once"connection.php";

	//image prepare
    $uploadedImages = array();
    if(isset($_FILES['image']))
    {
        $errors = array();
        $images = $_FILES['image'];
        $count = is_array($images['name']) ? count($images['name']) : 1;

        for ($i = 0; $i < $count; $i++) {
            $file_name = is_array($images['name']) ? $images['name'][$i] : $images['name'];
            $file_size = is_array($images['size']) ? $images['size'][$i] : $images['size'];
            $file_tmp= is_array($images['tmp_name']) ? $images['tmp_name'][$i] : $images['tmp_name'];
            $file_error = is_array($images['error']) ? $images['error'][$i] : $images['error'];

            if ($file_error === UPLOAD_ERR_NO_FILE) {
                continue;
            }

            if ($file_error !== UPLOAD_ERR_OK) {
                $errors[] = "Upload error for file: " . htmlspecialchars($file_name);
                continue;
            }

            $file_end=explode('.', $file_name);
            $file_ext= strtolower(end($file_end));

            $formates =array('jpeg','jpg','png');

            if (in_array($file_ext, $formates)==false)
            {
                $errors[]="please choose jpg or png files";
                continue;
            }

            if($file_size>3145728){
                $errors[]="file is too large, file should be below 3 mb";
                continue;
            }

            $safeName = time() . '_' . $i . '_' . basename($file_name);
            if(move_uploaded_file($file_tmp,"apartment_images/".$safeName)){
                $uploadedImages[] = $safeName;
            } else {
                $errors[] = "Failed to save uploaded file: " . htmlspecialchars($file_name);
            }
        }

        if (!empty($uploadedImages)) {
            $_POST['image'] = implode(',', $uploadedImages);
        } else {
            $_POST['image'] = '';
        }

        if (!empty($errors)) {
            print_r($errors);
        }
    }





// data process
	$owner_username=$_SESSION['username'];

	$row1=mysqli_query($con,"SELECT member_id from members where username='$owner_username'");
	$ownr_id = mysqli_fetch_assoc($row1);
	$owner_id=$ownr_id['member_id'];


	$sqlf= "INSERT INTO available_flats
	(owner_id,owner_username,flat_city,flat_location,flat_rent)
		VALUES('".$owner_id."',
			'".$owner_username."',
			'".$_POST['flat_city']."',
			'".$_POST['flat_location']."',
			'".$_POST['flat_rent']."'
			);
	";
?>

<?php if(mysqli_query($con,$sqlf)){
?>
	<!-- <div class="alert alert-success alert-dismissable" style="text-align:center;">
    	<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    	<strong>Successful!</strong>
    </div> -->
  	<?php
	}
	else{
		echo"Error: " .$sqlf . "<br />" .mysqli_error($con);
	}
	?>


<?php
	$sqld= "INSERT INTO flat_details
	(flat_city,flat_location,flat_size,num_of_rooms,additional_info,image)
		VALUES (
			'".$_POST['flat_city']."',
			'".$_POST['flat_location']."',
			'".$_POST['flat_size']."',
			'".$_POST['num_of_rooms']."',
			'".$_POST['additional_info']."',
			'".$_POST['image']."'
			);
	";

	if (mysqli_query($con,$sqld)) 
	{

?>

		<div style="width: 70%; margin: 0 auto; padding: 20px;">
			<div style="text-align: center;">
				<h2 style="color: #28a745; font-size: 2em;">✓ Your Ad Posted Successfully!</h2>
				<p style="color: #666; margin-top: 10px;">Your apartment listing is now live.</p>
			</div>
		</div>

		<?php
	}
	else {
		echo "Error: " . $sqld . "<br>" . mysqli_error($con);
	}

	mysqli_close($con);
	?>



		 </div> 
	</body>
</html>