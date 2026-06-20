<?php
	 	include_once "includes/header.php";
	 	include_once "connection.php";

?>


<?php
// Allow public viewing of available flats without forcing login.
?>

<?php

	$apartments = mysqli_query($con,"SELECT m.first_name, m.last_name, f.flat_id, f.flat_city, f.flat_location, f.flat_rent, f.available, 
		d.flat_size,d.num_of_rooms, d.additional_info 
		FROM available_flats f 
		join members m on m.member_id =f.owner_id 
		join flat_details d on d.flat_id=f.flat_id");
	/*foreach ($apartments as $apartment ) {
		print_r($apartment);
		# code...
	}*/

	
?>
	<div class="responsive-table">
	<table style="border-collapse: collapse;width: 100%">
		<thead>
		<tr>
			<th>ID</th>
			<th>Apartment Size</th>
			<th>No. Of Rooms</th>
			<th>Rent</th>
			<th>Location</th>
			<th>City</th>
			<th>Availability</th>
			<th>Owners Name</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		<?php 
			foreach($apartments as $apartment){
		?>
			<tr>
				<td data-label="ID"><?php echo $apartment['flat_id'] ?></td>
				<td data-label="Apartment Size"><?php echo $apartment['flat_size'] ?></td>
				<td data-label="No. Of Rooms"><?php echo $apartment['num_of_rooms'] ?></td>
				<td data-label="Rent"><?php echo $apartment['flat_rent'] ?></td>
				<td data-label="Location"><?php echo $apartment['flat_location'] ?></td>
				<td data-label="City"><?php echo $apartment['flat_city'] ?></td>
				<td data-label="Availability"><?php if($apartment['available']==1){?> <a href="flat_details.php?id=<?php echo $apartment['flat_id'];?>">Show Details</a><?php } else{echo "NOT AVAILABLE"; } ?></td>
				<td data-label="Owner"><?php echo $apartment['first_name'].' '.$apartment['last_name'] ?></td>
				<td data-label="Action"><a href="reserve_flat.php?id=<?php echo $apartment['flat_id'];?>">Reserve Flat</a></td>
			</tr><?php
		}
		?>
		</tbody>
	</table>
	</div>
</html>