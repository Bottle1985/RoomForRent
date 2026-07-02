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

	$roomRent = isset($aptdetails['flat_rent']) ? (float)$aptdetails['flat_rent'] : 0;
	$electricUnits = isset($_POST['electric_units']) ? (float)$_POST['electric_units'] : 0;
	$waterUnits = isset($_POST['water_units']) ? (float)$_POST['water_units'] : 0;
	$electricRate = isset($_POST['electric_rate']) ? (float)$_POST['electric_rate'] : 3800;
	$waterRate = isset($_POST['water_rate']) ? (float)$_POST['water_rate'] : 35000;
	$monthlyTotal = $roomRent + ($electricUnits * $electricRate) + ($waterUnits * $waterRate);

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

		<div style="margin-top:20px; padding:15px; border:1px solid #ddd; background:#f9f9f9;">
			<h3 style="margin-top:0;">Tính tiền phòng hàng tháng</h3>
			<form method="post" action="flat_details.php?id=<?php echo htmlspecialchars($apt_id); ?>" style="display:flex; flex-wrap:wrap; gap:12px; align-items:end;">
				<div>
					<label><strong>Số điện (kWh)</strong><br>
					<input type="number" step="0.1" name="electric_units" value="<?php echo htmlspecialchars(isset($_POST['electric_units']) ? $_POST['electric_units'] : ''); ?>" style="min-width:120px;" /></label>
				</div>
				<div>
					<label><strong>Số nước (m3)</strong><br>
					<input type="number" step="0.1" name="water_units" value="<?php echo htmlspecialchars(isset($_POST['water_units']) ? $_POST['water_units'] : ''); ?>" style="min-width:120px;" /></label>
				</div>
				<div>
					<label><strong>Giá điện (VND/kWh)</strong><br>
					<input type="number" step="100" name="electric_rate" value="<?php echo htmlspecialchars(isset($_POST['electric_rate']) ? $_POST['electric_rate'] : '3800'); ?>" style="min-width:140px;" /></label>
				</div>
				<div>
					<label><strong>Giá nước (VND/m3)</strong><br>
					<input type="number" step="100" name="water_rate" value="<?php echo htmlspecialchars(isset($_POST['water_rate']) ? $_POST['water_rate'] : '35000'); ?>" style="min-width:140px;" /></label>
				</div>
				<div>
					<button type="submit" class="button submit">Tính tiền</button>
				</div>
			</form>

			<?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
				<div style="margin-top:12px; padding:10px; background:#ffffff; border-left:4px solid #2c7be5;">
					<strong>Tổng tiền tháng này:</strong> <?php echo number_format($monthlyTotal, 0, ',', '.'); ?> VND<br>
					Phòng: <?php echo number_format($roomRent, 0, ',', '.'); ?> VND + Điện: <?php echo number_format($electricUnits * $electricRate, 0, ',', '.'); ?> VND + Nước: <?php echo number_format($waterUnits * $waterRate, 0, ',', '.'); ?> VND
				</div>
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