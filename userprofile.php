<?php
	include_once"includes/header.php";
	include_once"connection.php";

	/*session_start();*/
	if(!$_SESSION['id1370950_demo_cse311']){
		header('location:login.php');
	}

?>
			<div align="center">
				<p> <strong><a href="myads.php">Edit Your Ads</a></strong>
				<strong><a href="seevalues.php">User Details</a></strong>
				
				</p>
				<p>
					<form action="logout.php">
					<button type="submit" class="button submit">Log Out</button>
					</form>
				</p>
			</div>

			

	</div> 

	</body>
</html>