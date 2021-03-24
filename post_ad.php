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


<h2>Post advertisement for your flats here!</h2>

	<form name="post_ad" method="post" action="post_ad_save.php" enctype="multipart/form-data">
	 		<div class="left">

				<p>
					<strong>Flat City</strong><br>
					<select name="flat_city">
						<option value="dhaka">Dhaka</option>
						<option value="chittagong">Chittagong</option>
						<option value="barisal">Barisal</option>
					</select> 
				</p> 
				<p>
					<strong>Flat Location</strong><br>
					<input id="text5" type="text" name="flat_location"/>
				</p> 
				<p>
					<strong>Desired Rent</strong><br>
					<input id="text5" type="text" name="flat_rent"/>
				</p>

				<p>
					<strong>Flat Size (in square feet)</strong><br>
					<input id="text5" type="number" name="flat_size"/>
				</p> 
				
			</div>

			<div class="right">
				<p>
					<strong>Number of Rooms</strong><br>
					<input id="text5" type="text" name="num_of_rooms"/>
				</p> 
				<div><strong>Upload Image</strong>
    			<input type="file" name="image" id="image">
    			</div>
				<p>
					<strong>Additional Informations</strong><br>
					<input id="text5" type="text" name="additional_info"/>
				</p>  
				<br>
				
				<p>
					<button class="button submit">Sumbit</button>
				</p>
					 		
	 		</div>
	 	</form>


		 	

	 </div> 

	</body>
</html>