<?php
	 	include_once "includes/header.php";
	 	include_once "connection.php";

	$apt_id=$_GET['id'];

	$sqldetails=mysqli_query($con,"SELECT * 
		FROM available_flats f 
		join members m on m.member_id =f.owner_id 
		join flat_details d on d.flat_id=f.flat_id 
		where f.flat_id=$apt_id");
	/*print_r($sqldetails);*/
	$aptdetails = mysqli_fetch_array($sqldetails,MYSQLI_BOTH);


?>


	<div  ><strong> </strong>
		<div >
			<?php
			$imageField = trim($aptdetails['image']);
			if (!empty($imageField)) {
				$images = explode(',', $imageField);
				foreach ($images as $img) {
					$img = trim($img);
					if (!empty($img)) {
						echo '<img style="height:auto;width:60%;margin-bottom:10px;" src="apartment_images/' . htmlspecialchars($img) . '" alt="Flat image">';
					}
				}
			} else {
				echo '<div>No images available for this flat.</div>';
			}
			?>

		</div>
		
		<div >
			<table class="tblclss" style="border-collapse: collapse;width: 100%;">
				<tr>
					<th style="background-color:#95a5a6; padding: 8px 10px; width: 30%;">Label</th>
					<th style="background-color:#95a5a6; padding: 8px 10px;">Value</th>
				</tr>
				<tr>
					<td style="background-color:#95a5a6; padding: 8px 10px;">Owner</td>
					<td style="padding: 8px 10px;"><?php echo htmlspecialchars($aptdetails['first_name'] . ' ' . $aptdetails['last_name']); ?></td>
				</tr>
				<tr>
					<td style="background-color:#95a5a6; padding: 8px 10px;">Rent (VND)</td>
					<td style="padding: 8px 10px;"><?php echo number_format($aptdetails['flat_rent'], 0, ',', '.'); ?> VND</td>
				</tr>
				<tr>
					<td style="background-color:#95a5a6; padding: 8px 10px;">City</td>
					<td style="padding: 8px 10px;"><?php echo htmlspecialchars($aptdetails['flat_city']); ?></td>
				</tr>
				<tr>
					<td style="background-color:#95a5a6; padding: 8px 10px;">Location</td>
					<td style="padding: 8px 10px;"><?php echo htmlspecialchars($aptdetails['flat_location']); ?></td>
				</tr>
				<tr>
					<td style="background-color:#95a5a6; padding: 8px 10px;">Rooms</td>
					<td style="padding: 8px 10px;"><?php echo htmlspecialchars($aptdetails['num_of_rooms']); ?></td>
				</tr>
				<tr>
					<td style="background-color:#95a5a6; padding: 8px 10px;">Additional Info</td>
					<td style="padding: 8px 10px;"><?php echo htmlspecialchars($aptdetails['additional_info']); ?></td>
				</tr>
			</table>
		</div>
	</div>

	 </div> 

	</body>
</html>		</div>
		
	</div>

	 </div> 

	</body>
</html>