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

?>