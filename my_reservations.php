<?php
	include_once "includes/header.php";
	include_once "connection.php";

	if (!isset($_SESSION['username'])) {
		header('Location: login.php');
		exit();
	}

	$username = mysqli_real_escape_string($con, $_SESSION['username']);

	$query = "SELECT r.flat_id, r.bidder_username, f.flat_city, f.flat_location, f.flat_rent, f.available,
		d.flat_size, d.num_of_rooms, d.additional_info,
		m.first_name, m.last_name
		FROM reserved_flats r
		JOIN available_flats f ON f.flat_id = r.flat_id
		JOIN flat_details d ON d.flat_id = f.flat_id
		JOIN members m ON m.member_id = f.owner_id
		WHERE r.bidder_username = '$username'";

	$reservations = mysqli_query($con, $query);
?>

<h2>My Reserved Flats</h2>

<?php if ($reservations && mysqli_num_rows($reservations) > 0): ?>
	<div class="responsive-table">
		<table style="border-collapse: collapse; width: 100%;">
			<thead>
				<tr>
					<th>ID</th>
					<th>Size</th>
					<th>Rooms</th>
					<th>Rent</th>
					<th>Location</th>
					<th>City</th>
					<th>Owner</th>
					<th>Details</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($row = mysqli_fetch_assoc($reservations)): ?>
					<tr>
						<td><?php echo htmlspecialchars($row['flat_id']); ?></td>
						<td><?php echo htmlspecialchars($row['flat_size']); ?></td>
						<td><?php echo htmlspecialchars($row['num_of_rooms']); ?></td>
						<td><?php echo number_format($row['flat_rent'], 0, ',', '.'); ?> VND</td>
						<td><?php echo htmlspecialchars($row['flat_location']); ?></td>
						<td><?php echo htmlspecialchars($row['flat_city']); ?></td>
						<td><?php echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']); ?></td>
						<td><a href="flat_details.php?id=<?php echo $row['flat_id']; ?>">View</a></td>
					</tr>
				<?php endwhile; ?>
			</tbody>
		</table>
	</div>
<?php else: ?>
	<p>You have no reserved flats yet.</p>
<?php endif; ?>

</div>
</body>
</html>
