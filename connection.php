<?php

	$host='localhost';
	$user='id16381796_wp_c1fdf0feee89c3d26f1e19a8d798dc94';
	// Change over time for password
	$pass='lnfSUdAk29$smtj{';
	$db='id16381796_wp_c1fdf0feee89c3d26f1e19a8d798dc94';

	$con=mysqli_connect($host,$user,$pass,$db);
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " .mysqli_connect_error();
	}

?>