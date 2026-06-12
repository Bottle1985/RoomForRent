<?php
	 	include_once "includes/header.php";
	 	include_once "connection.php";

?>


<?php
// check that the 'registered' key exists
if (isset($_SESSION['registered'])) {

    // it does; output the message
    echo $_SESSION['registered'];

    // remove the key so we don't keep outputting the message
    unset($_SESSION['registered']);
}
$loggedIn = isset($_SESSION['id1370950_demo_cse311']) && $_SESSION['id1370950_demo_cse311'];

// Fetch public apartment listings
$apartments = mysqli_query($con,"SELECT m.first_name, m.last_name, f.flat_id, f.flat_city, f.flat_location, f.flat_rent, f.available, 
	d.flat_size, d.num_of_rooms, d.additional_info 
	FROM available_flats f 
	JOIN members m ON m.member_id = f.owner_id 
	JOIN flat_details d ON d.flat_id = f.flat_id
	WHERE f.available = 1");
?>
	<div align="center">
		<?php if ($loggedIn) { ?>
			<strong> Welcome, </strong> <strong> <?php echo htmlspecialchars($_SESSION['username']); ?></strong><strong> !</strong>
		<?php } else { ?>
			<strong> Welcome to Home Port</strong>
			<p>Please <a href="login.php">login</a> or <a href="register_page.php">sign up</a> to access member features.</p>
		<?php } ?>
	</div>

	<div style="padding: 20px;">
		<h2>Available Apartments</h2>
		<?php if ($apartments && mysqli_num_rows($apartments) > 0) { ?>
			<table style="border-collapse: collapse; width: 100%;">
				<tr style="background-color: #95a5a6; color: white;">
					<th style="padding: 10px;">ID</th>
					<th style="padding: 10px;">Size (m²)</th>
					<th style="padding: 10px;">Rooms</th>
					<th style="padding: 10px;">Rent</th>
					<th style="padding: 10px;">Location</th>
					<th style="padding: 10px;">City</th>
					<th style="padding: 10px;">Owner</th>
					<th style="padding: 10px;">Action</th>
				</tr>
				<?php while($apartment = mysqli_fetch_assoc($apartments)) { ?>
					<tr style="border-bottom: 1px solid #ddd;">
						<td style="padding: 10px;"><?php echo $apartment['flat_id']; ?></td>
						<td style="padding: 10px;"><?php echo $apartment['flat_size']; ?></td>
						<td style="padding: 10px;"><?php echo $apartment['num_of_rooms']; ?></td>
						<td style="padding: 10px;"><?php echo number_format($apartment['flat_rent']); ?></td>
						<td style="padding: 10px;"><?php echo htmlspecialchars($apartment['flat_location']); ?></td>
						<td style="padding: 10px;"><?php echo htmlspecialchars($apartment['flat_city']); ?></td>
						<td style="padding: 10px;"><?php echo htmlspecialchars($apartment['first_name'] . ' ' . $apartment['last_name']); ?></td>
						<td style="padding: 10px;">
							<a href="flat_details.php?id=<?php echo $apartment['flat_id']; ?>">View Details</a>
							<?php if ($loggedIn) { ?>
								| <a href="reserve_flat.php?id=<?php echo $apartment['flat_id']; ?>">Reserve</a>
							<?php } ?>
						</td>
					</tr>
				<?php } ?>
			</table>
		<?php } else { ?>
			<p>No apartments available at the moment.</p>
		<?php } ?>
	</div>

	
	

	<div>
		<div>
			
			<?php
			include_once"slideshow_container.php";
			?>
		</div>
	</div>

		

		
		 	

	 </div> 

	</body>
</html>