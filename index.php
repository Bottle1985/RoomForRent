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
	<div align="center">
		<strong> Welcome, </strong> <strong> <?php echo $_SESSION['username']?></strong><strong> !</strong>
	</div>

	<!-- <div>
		<div align="center">
			<form method="POST" action="post_ad.php">
				<div class="centerdiv" style="width: 25%; margin: 0 auto;float: left;">
					<button class="button submit" >Post Ad</button>
				</div>
			</form>
			<form method="POST" action="available_flats.php">
				<div class="centerdiv" style="width: 25%; margin: 0 auto;float: right;" >
					<button class="button submit">Find Flats</button>
				</div>
			</form>
	</div> -->
	

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