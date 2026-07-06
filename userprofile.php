<?php
	include_once"includes/header.php";
	include_once"connection.php";

	if(!$_SESSION['id1370950_demo_cse311']){
		header('location:login.php');
	}

	$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
	$memberQuery = mysqli_query($con, "SELECT member_id FROM members WHERE username='" . mysqli_real_escape_string($con, $username) . "' LIMIT 1");
	$memberRow = mysqli_fetch_assoc($memberQuery);
	$memberId = $memberRow ? (int)$memberRow['member_id'] : 0;

	$selectedFlatId = isset($_POST['flat_id']) ? intval($_POST['flat_id']) : 0;
	$myFlats = array();
	if ($memberId > 0) {
		$flatQuery = mysqli_query($con, "SELECT f.flat_id, f.flat_city, f.flat_location, f.flat_rent, d.additional_info FROM available_flats f LEFT JOIN flat_details d ON d.flat_id = f.flat_id WHERE f.owner_id='$memberId' ORDER BY f.flat_id DESC");
		while ($flatRow = mysqli_fetch_assoc($flatQuery)) {
			$myFlats[] = $flatRow;
		}
	}
	if ($selectedFlatId <= 0 && !empty($myFlats)) {
		$selectedFlatId = (int)$myFlats[0]['flat_id'];
	}

	$selectedFlat = null;
	foreach ($myFlats as $flatRow) {
		if ((int)$flatRow['flat_id'] === $selectedFlatId) {
			$selectedFlat = $flatRow;
			break;
		}
	}

	$meterTableSql = "CREATE TABLE IF NOT EXISTS meter_readings (
		id INT(100) NOT NULL AUTO_INCREMENT,
		flat_id INT(100) NOT NULL,
		month_label VARCHAR(20) NOT NULL,
		electric_reading DECIMAL(10,2) NOT NULL DEFAULT 0.00,
		water_reading DECIMAL(10,2) NOT NULL DEFAULT 0.00,
		 electric_rate DECIMAL(10,2) NOT NULL DEFAULT 5000.00,
		 water_rate DECIMAL(10,2) NOT NULL DEFAULT 15000.00,
		rent_amount DECIMAL(10,2) NOT NULL DEFAULT 0.00,
		created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
		PRIMARY KEY (id),
		UNIQUE KEY flat_month_unique (flat_id, month_label)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1";
	mysqli_query($con, $meterTableSql);
	$columnCheck = mysqli_query($con, "SHOW COLUMNS FROM meter_readings LIKE 'rent_amount'");
	if (!$columnCheck || mysqli_num_rows($columnCheck) === 0) {
		mysqli_query($con, "ALTER TABLE meter_readings ADD rent_amount DECIMAL(10,2) NOT NULL DEFAULT 0.00");
	}
	$columnCheck = mysqli_query($con, "SHOW COLUMNS FROM meter_readings LIKE 'electric_rate'");
	if (!$columnCheck || mysqli_num_rows($columnCheck) === 0) {
		mysqli_query($con, "ALTER TABLE meter_readings ADD electric_rate DECIMAL(10,2) NOT NULL DEFAULT 5000.00");
	}
	$columnCheck = mysqli_query($con, "SHOW COLUMNS FROM meter_readings LIKE 'water_rate'");
	if (!$columnCheck || mysqli_num_rows($columnCheck) === 0) {
		mysqli_query($con, "ALTER TABLE meter_readings ADD water_rate DECIMAL(10,2) NOT NULL DEFAULT 15000.00");
	}

	$meterSavedMessage = '';
	$meterMonthValue = isset($_POST['meter_month']) ? trim($_POST['meter_month']) : '';
	$meterElectricValue = isset($_POST['electric_reading']) ? trim($_POST['electric_reading']) : '';
	$meterWaterValue = isset($_POST['water_reading']) ? trim($_POST['water_reading']) : '';
	$electricRateValue = isset($_POST['electric_rate']) ? trim($_POST['electric_rate']) : '5000';
	$waterRateValue = isset($_POST['water_rate']) ? trim($_POST['water_rate']) : '15000';
	$editMeterId = isset($_POST['edit_meter_id']) ? intval($_POST['edit_meter_id']) : 0;

	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_meter_reading']) && $selectedFlatId > 0) {
		$meterMonth = isset($_POST['meter_month']) ? trim($_POST['meter_month']) : '';
		$meterElectric = isset($_POST['electric_reading']) ? (float)$_POST['electric_reading'] : 0;
		$meterWater = isset($_POST['water_reading']) ? (float)$_POST['water_reading'] : 0;
		$roomRent = $selectedFlat ? (float)$selectedFlat['flat_rent'] : 0;
		$electricRate = isset($_POST['electric_rate']) ? (float)$_POST['electric_rate'] : 5000;
		$waterRate = isset($_POST['water_rate']) ? (float)$_POST['water_rate'] : 15000;

		if ($meterMonth !== '') {
			$meterMonthEsc = mysqli_real_escape_string($con, $meterMonth);
			$meterElectricEsc = mysqli_real_escape_string($con, $meterElectric);
			$meterWaterEsc = mysqli_real_escape_string($con, $meterWater);

			$prevUnitsSql = "SELECT electric_reading, water_reading FROM meter_readings WHERE flat_id='$selectedFlatId' AND month_label < '$meterMonthEsc' ORDER BY month_label DESC LIMIT 1";
			$prevUnitsResult = mysqli_query($con, $prevUnitsSql);
			$prevMeter = mysqli_fetch_assoc($prevUnitsResult);
			if ($prevMeter) {
				$electricUnits = max(0, $meterElectric - (float)$prevMeter['electric_reading']);
				$waterUnits = max(0, $meterWater - (float)$prevMeter['water_reading']);
			} else {
				$electricUnits = max(0, $meterElectric);
				$waterUnits = max(0, $meterWater);
			}
			$rentAmount = $roomRent + ($electricUnits * $electricRate) + ($waterUnits * $waterRate);
			$rentAmountEsc = mysqli_real_escape_string($con, $rentAmount);
			$electricRateEsc = mysqli_real_escape_string($con, $electricRate);
			$waterRateEsc = mysqli_real_escape_string($con, $waterRate);

			if ($editMeterId > 0) {
				$saveMeterSql = "UPDATE meter_readings SET month_label='$meterMonthEsc', electric_reading='$meterElectricEsc', water_reading='$meterWaterEsc', rent_amount='$rentAmountEsc', electric_rate='$electricRateEsc', water_rate='$waterRateEsc' WHERE id='$editMeterId' AND flat_id='$selectedFlatId'";
				if (mysqli_query($con, $saveMeterSql)) {
					$meterSavedMessage = 'Đã cập nhật chỉ số đồng hồ cho tháng ' . htmlspecialchars($meterMonth) . '.';
				} else {
					$meterSavedMessage = 'Không thể cập nhật chỉ số đồng hồ.';
				}
			} else {
				$saveMeterSql = "INSERT INTO meter_readings (flat_id, month_label, electric_reading, water_reading, rent_amount, electric_rate, water_rate)
					VALUES ('$selectedFlatId', '$meterMonthEsc', '$meterElectricEsc', '$meterWaterEsc', '$rentAmountEsc', '$electricRateEsc', '$waterRateEsc')
					ON DUPLICATE KEY UPDATE electric_reading='$meterElectricEsc', water_reading='$meterWaterEsc', rent_amount='$rentAmountEsc', electric_rate='$electricRateEsc', water_rate='$waterRateEsc'";
				if (mysqli_query($con, $saveMeterSql)) {
					$meterSavedMessage = 'Đã lưu chỉ số đồng hồ cho tháng ' . htmlspecialchars($meterMonth) . '.';
				} else {
					$meterSavedMessage = 'Không thể lưu chỉ số đồng hồ.';
				}
			}
		} else {
			$meterSavedMessage = 'Vui lòng nhập tháng.';
		}
	}

	$meterHistoryRows = array();
	if ($selectedFlatId > 0) {
		$meterHistorySql = "SELECT id, month_label, electric_reading, water_reading, rent_amount, electric_rate, water_rate FROM meter_readings WHERE flat_id='$selectedFlatId' ORDER BY month_label DESC";
		$meterHistory = mysqli_query($con, $meterHistorySql);
		while ($meterRow = mysqli_fetch_assoc($meterHistory)) {
			$meterHistoryRows[] = $meterRow;
		}
	}

	$roomRent = $selectedFlat ? (float)$selectedFlat['flat_rent'] : 0;
	$latestMeterReading = !empty($meterHistoryRows) ? $meterHistoryRows[0] : null;
	$previousMeterReading = count($meterHistoryRows) > 1 ? $meterHistoryRows[1] : null;
	$electricRate = $latestMeterReading !== null ? (float)$latestMeterReading['electric_rate'] : 5000;
	$waterRate = $latestMeterReading !== null ? (float)$latestMeterReading['water_rate'] : 15000;
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && !$latestMeterReading) {
		$electricRate = isset($_POST['electric_rate']) ? (float)$_POST['electric_rate'] : $electricRate;
		$waterRate = isset($_POST['water_rate']) ? (float)$_POST['water_rate'] : $waterRate;
	}
	$autoElectricUnits = 0;
	$autoWaterUnits = 0;
	$billingMonthLabel = $latestMeterReading !== null ? $latestMeterReading['month_label'] : '';
	if ($latestMeterReading !== null) {
		$autoElectricUnits = (float)$latestMeterReading['electric_reading'];
		$autoWaterUnits = (float)$latestMeterReading['water_reading'];
		if ($previousMeterReading !== null) {
			$autoElectricUnits = max(0, (float)$latestMeterReading['electric_reading'] - (float)$previousMeterReading['electric_reading']);
			$autoWaterUnits = max(0, (float)$latestMeterReading['water_reading'] - (float)$previousMeterReading['water_reading']);
		}
	}
	$electricUnits = isset($_POST['electric_units']) && trim($_POST['electric_units']) !== '' ? (float)$_POST['electric_units'] : $autoElectricUnits;
	$waterUnits = isset($_POST['water_units']) && trim($_POST['water_units']) !== '' ? (float)$_POST['water_units'] : $autoWaterUnits;
	$monthlyTotal = $roomRent + ($electricUnits * $electricRate) + ($waterUnits * $waterRate);
	$showBillingResult = $selectedFlat !== null;

?>
			<div align="center">
				<p> <strong><a href="myads.php">Edit Your Ads</a></strong>
				<strong><a href="seevalues.php">User Details</a></strong>
			<strong><a href="editprofile.php">Edit Profile</a></strong>
				
				</p>
				<p>
					<form action="logout.php">
					<button type="submit" class="button submit">Log Out</button>
					</form>
				</p>
			</div>

			<div style="max-width:1000px; margin:20px auto; padding:20px; border:1px solid #ddd; background:#f9f9f9;">
				<h2>Tính tiền phòng</h2>
				<?php if (empty($myFlats)): ?>
					<p>Bạn chưa đăng phòng nào.</p>
				<?php else: ?>
					<form method="post" action="userprofile.php" style="margin-bottom:15px;">
						<label><strong>Chọn phòng</strong><br>
						<select name="flat_id" onchange="this.form.submit()">
							<?php foreach ($myFlats as $flatRow): ?>
							<option value="<?php echo (int)$flatRow['flat_id']; ?>" <?php if ($selectedFlatId === (int)$flatRow['flat_id']) echo 'selected'; ?>><?php echo htmlspecialchars($flatRow['flat_location'] . ' - ' . $flatRow['additional_info']); ?></option>
						<?php endforeach; ?>
					</select></label>
				</form>

				<?php if ($selectedFlat !== null): ?>
					<div style="margin-bottom:15px; padding:10px; background:#fff; border:1px solid #ddd;">
						<strong>Phòng đã chọn:</strong> <?php echo htmlspecialchars($selectedFlat['flat_location'] . ' - ' . $selectedFlat['additional_info']); ?><br>
							<div style="margin-bottom:10px; padding:8px 10px; background:#eaf7ea; border:1px solid #c7e6c7; color:#1f5a1f;">
								<?php echo htmlspecialchars($meterSavedMessage); ?>
							</div>
					</div>

						<form method="post" action="userprofile.php" style="display:flex; flex-wrap:wrap; gap:12px; align-items:end; margin-bottom:15px;">
							<input type="hidden" name="flat_id" value="<?php echo htmlspecialchars($selectedFlatId); ?>">
							<input type="hidden" name="save_meter_reading" value="1">
							<?php if ($editMeterId > 0): ?>
								<input type="hidden" name="edit_meter_id" value="<?php echo htmlspecialchars($editMeterId); ?>">
							<?php endif; ?>
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
								<label><strong>Giá điện (VND/kWh)</strong><br>
								<input type="number" step="100" name="electric_rate" value="<?php echo htmlspecialchars($electricRateValue); ?>" style="min-width:120px;" /></label>
							</div>
							<div>
								<label><strong>Giá nước (VND/m3)</strong><br>
								<input type="number" step="100" name="water_rate" value="<?php echo htmlspecialchars($waterRateValue); ?>" style="min-width:120px;" /></label>
							</div>
							<div>
								<button type="submit" class="button submit">Lưu chỉ số</button>
							</div>
						</form>


						<?php if (!empty($meterHistoryRows)): ?>
							<div style="margin-top:12px;">
								<strong>Lịch sử đồng hồ</strong>
								<table class="tblclss" style="border-collapse: collapse; width: 100%; margin-top:8px;">
									<tr>
										<th style="background-color:#95a5a6; padding:8px 10px;">Tháng</th>
										<th style="background-color:#95a5a6; padding:8px 10px;">Tiền thuê</th>
										<th style="background-color:#95a5a6; padding:8px 10px;">Điện</th>
										<th style="background-color:#95a5a6; padding:8px 10px;">Nước</th>
										<th style="background-color:#95a5a6; padding:8px 10px;">Action</th>
									</tr>
									<?php foreach ($meterHistoryRows as $meterRow): ?>
									<tr>
										<td style="padding:8px 10px;"><?php echo htmlspecialchars($meterRow['month_label']); ?></td>
										<td style="padding:8px 10px;"><?php echo number_format($meterRow['rent_amount'], 0, ',', '.'); ?> VND</td>
										<td style="padding:8px 10px;"><?php echo htmlspecialchars($meterRow['electric_reading']); ?></td>
										<td style="padding:8px 10px;"><?php echo htmlspecialchars($meterRow['water_reading']); ?></td>
										<td style="padding:8px 10px;">
											<form method="post" action="userprofile.php" style="display:inline;">
												<input type="hidden" name="flat_id" value="<?php echo htmlspecialchars($selectedFlatId); ?>">
												<input type="hidden" name="edit_meter_id" value="<?php echo (int)$meterRow['id']; ?>">
												<input type="hidden" name="meter_month" value="<?php echo htmlspecialchars($meterRow['month_label']); ?>">
												<input type="hidden" name="electric_reading" value="<?php echo htmlspecialchars($meterRow['electric_reading']); ?>">
												<input type="hidden" name="water_reading" value="<?php echo htmlspecialchars($meterRow['water_reading']); ?>">
											<input type="hidden" name="electric_rate" value="<?php echo htmlspecialchars($meterRow['electric_rate']); ?>">
											<input type="hidden" name="water_rate" value="<?php echo htmlspecialchars($meterRow['water_rate']); ?>">
												<button type="submit" class="button submit">Sửa</button>
											</form>
										</td>
									</tr>
									<?php endforeach; ?>
								</table>
							</div>
						<?php else: ?>
							<div style="margin-top:12px; color:#666;">Chưa có chỉ số đồng hồ nào được lưu cho phòng này.</div>
						<?php endif; ?>

						<?php if ($showBillingResult): ?>
							<div style="margin-top:12px; padding:10px; background:#ffffff; border-left:4px solid #2c7be5;">
								<strong>Tổng tiền tháng này<?php echo $billingMonthLabel !== '' ? ' (' . htmlspecialchars($billingMonthLabel) . ')' : ''; ?>:</strong> <?php echo number_format($monthlyTotal, 0, ',', '.'); ?> VND<br>
								Phòng: <?php echo number_format($roomRent, 0, ',', '.'); ?> VND + Điện: <?php echo number_format($electricUnits * $electricRate, 0, ',', '.'); ?> VND + Nước: <?php echo number_format($waterUnits * $waterRate, 0, ',', '.'); ?> VND<br>
								Số điện dùng: <?php echo number_format($electricUnits, 2, ',', '.'); ?> kWh | Số nước dùng: <?php echo number_format($waterUnits, 2, ',', '.'); ?> m3
							</div>
						<?php endif; ?>
					<?php endif; ?>
				<?php endif; ?>
			</div>

	</div> 

	</body>
</html>
