<?php

	$host='localhost';
	$user='id18253098_bottle1985';
	// Change over time for password
	$pass='*iD3Mw@?RfIJO9]o';
	$db='id18253098_apartment';

	$con=mysqli_connect($host,$user,$pass,$db);
	if(mysqli_connect_errno())
	{
		echo "Failed to connect to MySQL: " .mysqli_connect_error();
	}

?>