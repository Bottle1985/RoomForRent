<?php
	 	include_once "includes/header.php";
	 	include_once "connection.php";

?>


<?php

if(!$_SESSION['id1370950_demo_cse311'])
{
	header ('location:login.php');
}

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
	<table style="border-collapse: collapse;width: 100%">
		<tr>
			<th>ID</th>
			<th>Apartment Size</th>
			<th>No. Of Rooms</th>
			<th>Rent</th>
			<th>Location</th>
			<th>City</th>
			<th>Availability</th>
			<th>Owners Name</th>
		</tr>
		<?php 
			foreach($apartments as $apartment){
		?>
			<tr>
				<td><?php echo $apartment['flat_id'] ?></td>
				<td><?php echo $apartment['flat_size'] ?></td>
				<td><?php echo $apartment['num_of_rooms'] ?></td>
				<td><?php echo $apartment['flat_rent'] ?></td>
				<td><?php echo $apartment['flat_location'] ?></td>
				<td><?php echo $apartment['flat_city'] ?></td>
				<td><?php if($apartment['available']==1){?> <a href="flat_details.php?id=<?php echo $apartment['flat_id'];?>">Show Details</a><?php } else{echo "NOT AVAILABLE"; } ?></td>
				<td><?php echo $apartment['first_name'].' '.$apartment['last_name'] ?></td>
				<td><a href="reserve_flat.php?id=<?php echo $apartment['flat_id'];?>">Reserve Flat</a></td>
			</tr><?php
		}
		?>
		<style>
			table {
			    border-collapse: collapse;
			    width: 100%;
			}

			th, td {
			    padding: 8px;
			    text-align: left;
			    border-bottom: 1px solid #ddd;
			}

			tr:hover{background-color:#f5f5f5}
		</style>
	</table>

		
		 	

	 </div> 

	</body>
</html>