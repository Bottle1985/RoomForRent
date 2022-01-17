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
			    	
					<input type="radio" name="available" value="1" checked="checked" />Available  
					<input type="radio" name="available" value="0"/>Not Available
				</p>

				<p>
					<strong>Flat City</strong><br> <!-- flat_city -->
					<select name="flat_city">
						<option value="Nha Trang">Nha Trang</option>
						<option value="Hà Nội">Hà Nội</option>
						<option value="TP HCM">TP HCM</option>
					</select> 
				</p> 
			 	
			 	<p>
					<strong>Flat Location</strong><br> <!-- flat_location -->
					<input id="text5" type="text" name="flat_location"/>
				</p>

				<p>
					<strong>Flat Rent</strong><br> <!-- flat_rent -->
					<input id="text5" type="text" name="flat_rent"/>
				</p>

			</div>
			<div class="right">
				<p>
					<strong>Flat Size</strong><br> <!-- flat_size -->
					<input id="text5" type="number" name="flat_size"/>
				</p> 
				<p>
					<strong>Number of Rooms</strong><br> <!-- num_of_rooms -->
					<input id="text5" type="text" name="num_of_rooms"/>
				</p>
				<div><strong>Change Image</strong>
    			<input type="file" name="image" id="image">
    			</div>
				<p>
					<strong>Additional Informations</strong><br>
					<input id="text5" type="text" name="additional_info"/>
				</p> 
				<p>
					<button class="button submit">Update!</button>
				</p>
			</div>	
		</form>






		</div> 
	</body>
</html>