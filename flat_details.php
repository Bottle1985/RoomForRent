<?php
	 	include_once "includes/header.php";
	 	include_once "connection.php";

	$apt_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

	$sqldetails=mysqli_query($con,"SELECT * 
		FROM available_flats f 
		join members m on m.member_id =f.owner_id 
		join flat_details d on d.flat_id=f.flat_id 
		where f.flat_id=$apt_id");
	/*print_r($sqldetails);*/
	$aptdetails = mysqli_fetch_array($sqldetails,MYSQLI_BOTH);
	$guestQuery = mysqli_query($con, "SELECT bidder_name, bidder_contact, bidder_username FROM reserved_flats WHERE flat_id=$apt_id ORDER BY bidder_name");

?>


	<div  ><strong> </strong>
		<div style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:20px;">
			<?php
			$imageField = trim($aptdetails['image']);
			if (!empty($imageField)) {
				$images = explode(',', $imageField);
				foreach ($images as $img) {
					$img = trim($img);
					if (!empty($img)) {
						echo '<div style="flex: 1 1 calc(50% - 10px); max-width: calc(50% - 10px);"><img style="width:100%; height:auto; display:block;" src="apartment_images/' . htmlspecialchars($img) . '" alt="Flat image"></div>';
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

		<div style="margin-top: 20px;">
			<h3 style="margin-bottom: 10px;">Current Guests</h3>
			<?php if ($guestQuery && mysqli_num_rows($guestQuery) > 0): ?>
				<table class="tblclss" style="border-collapse: collapse; width: 100%;">
					<tr>
						<th style="background-color:#95a5a6; padding: 8px 10px;">Name</th>
						<th style="background-color:#95a5a6; padding: 8px 10px;">Contact</th>
						<th style="background-color:#95a5a6; padding: 8px 10px;">Username</th>
					</tr>
					<?php while ($guest = mysqli_fetch_assoc($guestQuery)): ?>
					<tr>
						<td style="padding: 8px 10px;"><?php echo htmlspecialchars($guest['bidder_name']); ?></td>
						<td style="padding: 8px 10px;"><?php echo htmlspecialchars($guest['bidder_contact']); ?></td>
						<td style="padding: 8px 10px;"><?php echo htmlspecialchars(!empty($guest['bidder_username']) ? $guest['bidder_username'] : 'N/A'); ?></td>
					</tr>
					<?php endwhile; ?>
				</table>
			<?php else: ?>
				<p>No current guest information for this room yet.</p>
			<?php endif; ?>
		</div>
	</div>

	 </div> 

	</body>
</html>		</div>
		
	</div>

	 </div> 

	</body>
</html>