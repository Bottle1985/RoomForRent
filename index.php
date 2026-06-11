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
?>
	<div align="center">
		<?php if ($loggedIn) { ?>
			<strong> Welcome, </strong> <strong> <?php echo htmlspecialchars($_SESSION['username']); ?></strong><strong> !</strong>
		<?php } else { ?>
			<strong> Welcome to Home Port</strong>
			<p>Please <a href="login.php">login</a> or <a href="register_page.php">sign up</a> to access member features.</p>
		<?php } ?>
	</div>

	<!--<div>
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
	</div>-->
	

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