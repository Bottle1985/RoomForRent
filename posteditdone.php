<?php
	include_once"includes/header.php";
	include_once"connection.php";
	
	//image prepare
    if(isset($_FILES['image']))
    {
        $errors =array();
        $file_name=time().$_FILES['image']['name'];
        $file_size=$_FILES['image']['size'];
        $file_tmp= $_FILES['image']['tmp_name'];
        $file_type = $_FILES['image']['type'];
        $file_end=explode('.',$_FILES['image']['name']);
        $file_ext= strtolower(end($file_end));

        $formates =array('jpeg','jpg','png');

        if (in_array($file_ext, $formates)==false)
        {
            $errors[]="please choose jpg or png files";

        }

        if($file_size>2097152){
            $errors[]="file is too large, file should be below 2 mb";
        }

        if(empty($errors)==true){
            move_uploaded_file($file_tmp,"apartment_images/".$file_name);
            $_POST['image']=$file_name;
        }else {print_r($errors);
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
	 $apt_image		  =$_POST['image']	;
	 
	 $apartment=mysqli_query($con,"UPDATE available_flats  
	 	set flat_city='$apt_city', 
	 	flat_location='$apt_location',
	 	flat_rent    ='$rent', 
	 	availabile   ='$available' 
	 	where flat_id='$apt_id'");
	// print_r($apt_image);
	 $apartment_details=mysqli_query($con,"UPDATE flat_details 
	 	set  flat_city='$apt_city', 
	 	flat_location='$apt_location',
	 	flat_size  ='$apt_size',
	 	num_of_rooms   ='$apt_no_of_rooms', 
	 	additional_info='$apt_additional_info', 
		image='$apt_image'
	 	where flat_id  ='$apt_id' ");
		
?>

		<div style="width: 70%; margin: 0 auto;">
			<div><img src="images/success.png" alt="Success Icon" style="float: left;width: 25%;"/></div>
			<div><h1 style="float: right; font-size: 1.5em;"> Post Edited Successfully!</h1></div>
		</div>


		</div> 
	</body>
</html>	