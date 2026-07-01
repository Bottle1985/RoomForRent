<?php 
	include_once"includes/header.php";
	include_once"connection.php";

	$apt_id=$_GET['id'];

	$sqldetails=mysqli_query($con,"SELECT * 
		FROM available_flats f 
		join members m on m.member_id =f.owner_id 
		join flat_details d on d.flat_id=f.flat_id 
		where f.flat_id=$apt_id");
	/*print_r($sqldetails);*/
	$aptdetails = mysqli_fetch_array($sqldetails,MYSQLI_BOTH);
	//print_r($aptdetails);

?>
		<form method="post" action="posteditdone.php" enctype="multipart/form-data">
			<div class="left">
				<div >
					<input type="hidden" name="id" value="<?php echo $apt_id ?>">
				</div>

				<p>
					<strong>Availablity</strong><br> <!-- available -->
			    	
					<input type="radio" name="available" value="1" <?php if($aptdetails['available']==1) echo 'checked="checked"'; ?> />Available  
					<input type="radio" name="available" value="0" <?php if($aptdetails['available']==0) echo 'checked="checked"'; ?>/>Not Available
				</p>

				<p>
					<strong>Flat City</strong><br> <!-- flat_city -->
					<select name="flat_city">
						<option value="Nha Trang" <?php if($aptdetails['flat_city']=='Nha Trang') echo 'selected'; ?>>Nha Trang</option>
						<option value="Hà Nội" <?php if($aptdetails['flat_city']=='Hà Nội') echo 'selected'; ?>>Hà Nội</option>
						<option value="TP HCM" <?php if($aptdetails['flat_city']=='TP HCM') echo 'selected'; ?>>TP HCM</option>
					</select> 
				</p> 
			 	
			 	<p>
					<strong>Flat Location</strong><br> <!-- flat_location -->
					<input id="text5" type="text" name="flat_location" value="<?php echo htmlspecialchars($aptdetails['flat_location']); ?>"/>
				</p>

				<p>
					<strong>Flat Rent (VND)</strong><br> <!-- flat_rent -->
					<input id="text5" type="number" name="flat_rent" value="<?php echo htmlspecialchars($aptdetails['flat_rent']); ?>"/>
				</p>

			</div>
			<div class="right">
				<p>
					<strong>Flat Size</strong><br> <!-- flat_size -->
					<input id="text5" type="number" name="flat_size" value="<?php echo htmlspecialchars($aptdetails['flat_size']); ?>"/>
				</p> 
				<p>
					<strong>Number of Rooms</strong><br> <!-- num_of_rooms -->
					<input id="text5" type="text" name="num_of_rooms" value="<?php echo htmlspecialchars($aptdetails['num_of_rooms']); ?>"/>
				</p>
				<div>
					<strong>Change Image</strong><br>
    			<input type="file" name="image" id="image"><br>
    			<?php if (!empty($aptdetails['image'])): ?>
    				<span>Current image: <?php echo htmlspecialchars($aptdetails['image']); ?></span><br>
    				<img src="apartment_images/<?php echo htmlspecialchars($aptdetails['image']); ?>" alt="Current flat image" style="max-width:100%; max-height:220px; margin-top:8px; border:1px solid #ccc; padding:4px;" />
    			<?php else: ?>
    				<span>No current image available</span>
    			<?php endif; ?>
    			</div>
				<p>
					<strong>Additional Informations</strong><br>
					<input id="text5" type="text" name="additional_info" value="<?php echo htmlspecialchars($aptdetails['additional_info']); ?>"/>
				</p> 
				<p>
					<button class="button submit">Update!</button>
				</p>
			</div>	
		</form>






		</div> 
	</body>
</html>