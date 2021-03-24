<?php
	include_once"includes/header.php";
	include_once"connection.php";
	
	$username=$_SESSION['username'];
	$uid=mysqli_query($con,"SELECT member_id from members where username='$username'");
	$row = mysqli_fetch_array($uid,MYSQLI_BOTH);
	$uid=$row['member_id'];

	$adinfos=mysqli_query($con,"SELECT * 
		FROM available_flats f 
		join members m on m.member_id =f.owner_id 
		join flat_details d on d.flat_id=f.flat_id 
		where m.member_id='$uid'");	

?>

<table>
		<tr>
			<th>Serial No</th>
			<th>Apartment Size</th>
			<th>No. Of Rooms</th>
			<th>Rent</th>
			<th>Location</th>
			<th>City</th>
			<th>Action</th>
			
		</tr>
		<?php $i=1;
			foreach($adinfos as $adinfo){
		?>
			<tr>
				<td><?php echo  $i; ?></td>
				<td><?php echo $adinfo['flat_size'] ?></td>
				<td><?php echo $adinfo['num_of_rooms'] ?></td>
				<td><?php echo $adinfo['flat_rent'] ?></td>
				<td><?php echo $adinfo['flat_location'] ?></td>
				<td><?php echo $adinfo['flat_city'] ?></td>
				<td><a href="post_edit.php?id=<?php echo $adinfo['flat_id'];?>">Edit Ad</a></td>
			</tr><?php $i++;
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