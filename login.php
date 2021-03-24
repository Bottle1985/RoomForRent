<?php
	include_once"includes/header.php";
	
	if($_POST){

		$host="localhost";
		$user="id16381796_wp_c1fdf0feee89c3d26f1e19a8d798dc94";
		$pass="alohamorah7";
		$db="id16381796_wp_c1fdf0feee89c3d26f1e19a8d798dc94";

		$username=$_POST['username'];
		$password=$_POST['password'];
		$con=mysqli_connect($host,$user,$pass,$db);

		$query="SELECT * from members where username='$username' and password='$password'";
        /*print($query);die();*/
		$result=mysqli_query($con,$query);

		if(mysqli_num_rows($result)==1)
		{
				/*session_start();*/
				$_SESSION['id1370950_demo_cse311']='true';
				header('location:userprofile.php');
				$_SESSION['username']=$username;
				
			}
			else{
				echo "wrong username or password";
				}
}
?>

<h1>Login</h1>
<form method="POST">
<div class="centerdiv" style="width: 25%; margin: 0 auto;">
	<strong>Username:<br></strong>
	<input id="text5" type="text" name="username"><br>
	<strong>Password:<br></strong>
	<input id="text5" type="password" name="password"><br>
	<p>
		<button class="button submit">Login</button>
	</p>
</div>


</form>

 </div> 

	</body>
</html>