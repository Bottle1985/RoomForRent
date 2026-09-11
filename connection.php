<?php

	$host='sql211.infinityfree.com';
	$user='if0_40797762';
	// Change over time for password
	$pass='mbL68p8nsevaw';
	$db='if0_40797762_apartment';

	$con=mysqli_connect($host,$user,$pass,$db);
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " .mysqli_connect_error();
	}
	else
	{
		// Keep databases imported from the original schema compatible with video listings.
		$videoColumn = mysqli_query($con, "SHOW COLUMNS FROM flat_details LIKE 'video'");
		if ($videoColumn && mysqli_num_rows($videoColumn) === 0) {
			mysqli_query($con, "ALTER TABLE flat_details ADD video TEXT NOT NULL DEFAULT ''");
		}
	}

?>