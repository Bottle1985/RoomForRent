<?php
	 	include_once "includes/header.php";
	 	include_once "connection.php";

	$apt_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

	$meterTableSql = "CREATE TABLE IF NOT EXISTS meter_readings (
		id INT(100) NOT NULL AUTO_INCREMENT,
		flat_id INT(100) NOT NULL,
		month_label VARCHAR(20) NOT NULL,
		electric_reading DECIMAL(10,2) NOT NULL DEFAULT 0.00,
		water_reading DECIMAL(10,2) NOT NULL DEFAULT 0.00,
		created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id),
		UNIQUE KEY flat_month_unique (flat_id, month_label)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	mysqli_query($con, $meterTableSql);

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

	$meterSavedMessage = '';
	$meterMonthValue = isset($_POST['meter_month']) ? trim($_POST['meter_month']) : '';
	$meterElectricValue = isset($_POST['electric_reading']) ? trim($_POST['electric_reading']) : '';
	$meterWaterValue = isset($_POST['water_reading']) ? trim($_POST['water_reading']) : '';

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_meter_reading'])) {
		$meterMonth = isset($_POST['meter_month']) ? trim($_POST['meter_month']) : '';
		$meterElectric = isset($_POST['electric_reading']) ? (float)$_POST['electric_reading'] : 0;
		$meterWater = isset($_POST['water_reading']) ? (float)$_POST['water_reading'] : 0;

		if ($apt_id > 0 && $meterMonth !== '') {
			$meterMonthEsc = mysqli_real_escape_string($con, $meterMonth);
			$meterElectricEsc = mysqli_real_escape_string($con, $meterElectric);
			$meterWaterEsc = mysqli_real_escape_string($con, $meterWater);
			$saveMeterSql = "INSERT INTO meter_readings (flat_id, month_label, electric_reading, water_reading)
				VALUES ('$apt_id', '$meterMonthEsc', '$meterElectricEsc', '$meterWaterEsc')
				ON DUPLICATE KEY UPDATE electric_reading='$meterElectricEsc', water_reading='$meterWaterEsc'";
			if (mysqli_query($con, $saveMeterSql)) {
				$meterSavedMessage = 'Đã lưu chỉ số đồng hồ cho tháng ' . htmlspecialchars($meterMonth) . '.';
			} else {
				$meterSavedMessage = 'Không thể lưu chỉ số đồng hồ.';
			}
		} else {
			$meterSavedMessage = 'Vui lòng nhập tháng và chỉ số đồng hồ.';
		}
	}

	$meterHistorySql = "SELECT month_label, electric_reading, water_reading, created_at FROM meter_readings WHERE flat_id='$apt_id' ORDER BY month_label DESC";
	$meterHistory = mysqli_query($con, $meterHistorySql);

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
			<h3 style="margin-top:0;">Ghi chỉ số điện nước đồng hồ hàng tháng</h3>
			<?php if ($meterSavedMessage !== ''): ?>
				<div style="margin-bottom:10px; padding:8px 10px; background:#eaf7ea; border:1px solid #c7e6c7; color:#1f5a1f;">
					<?php echo htmlspecialchars($meterSavedMessage); ?>
				</div>
			<?php endif; ?>
			<form method="post" action="flat_details.php?id=<?php echo htmlspecialchars($apt_id); ?>" style="display:flex; flex-wrap:wrap; gap:12px; align-items:end;">
				<input type="hidden" name="save_meter_reading" value="1">
				<div>
					<label><strong>Tháng</strong><br>
					<input type="month" name="meter_month" value="<?php echo htmlspecialchars($meterMonthValue); ?>" style="min-width:150px;" /></label>
				</div>
				<div>
					<label><strong>Chỉ số điện</strong><br>
					<input type="number" step="0.1" name="electric_reading" value="<?php echo htmlspecialchars($meterElectricValue); ?>" style="min-width:120px;" /></label>
				</div>
				<div>
					<label><strong>Chỉ số nước</strong><br>
					<input type="number" step="0.1" name="water_reading" value="<?php echo htmlspecialchars($meterWaterValue); ?>" style="min-width:120px;" /></label>
				</div>
				<div>
					<button type="submit" class="button submit">Lưu chỉ số</button>
				</div>
			</form>

			<?php if ($meterHistory && mysqli_num_rows($meterHistory) > 0): ?>
				<div style="margin-top:12px;">
					<strong>Lịch sử đồng hồ</strong>
					<table class="tblclss" style="border-collapse: collapse; width: 100%; margin-top:8px;">
						<tr>
							<th style="background-color:#95a5a6; padding:8px 10px;">Tháng</th>
							<th style="background-color:#95a5a6; padding:8px 10px;">Điện</th>
							<th style="background-color:#95a5a6; padding:8px 10px;">Nước</th>
						</tr>
						<?php while ($meterRow = mysqli_fetch_assoc($meterHistory)): ?>
						<tr>
							<td style="padding:8px 10px;"><?php echo htmlspecialchars($meterRow['month_label']); ?></td>
							<td style="padding:8px 10px;"><?php echo htmlspecialchars($meterRow['electric_reading']); ?></td>
							<td style="padding:8px 10px;"><?php echo htmlspecialchars($meterRow['water_reading']); ?></td>
						</tr>
						<?php endwhile; ?>
					</table>
				</div>
			<?php else: ?>
				<div style="margin-top:12px; color:#666;">Chưa có chỉ số đồng hồ nào được lưu.</div>
			<?php endif; ?>
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