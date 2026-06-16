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