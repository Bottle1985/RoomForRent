<?php
include_once "includes/header.php";
include_once "connection.php";

if (!isset($_SESSION['id1370950_demo_cse311'])) {
    header('location:login.php');
    exit;
}

$member_id = $_POST['member_id'];
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$password = $_POST['password'];
$cpasswd = $_POST['cpasswd'];
$city = $_POST['city'];
$location = $_POST['location'];
$contact_no = $_POST['contact_no'];
$gender = $_POST['gender'];

if (!empty($password) && $password !== $cpasswd) {
    echo "Passwords do not match.";
    exit;
}

$updates = [];
$updates[] = "first_name='$first_name'";
$updates[] = "last_name='$last_name'";
$updates[] = "username='$username'";
$updates[] = "city='$city'";
$updates[] = "location='$location'";
$updates[] = "contact_no='$contact_no'";
$updates[] = "gender='$gender'";

if (!empty($password)) {
    $updates[] = "password='$password'";
}

$update_sql = "UPDATE members SET " . implode(', ', $updates) . " WHERE member_id='$member_id'";

if (mysqli_query($con, $update_sql)) {
    $_SESSION['username'] = $username;
    ?>
    <div style="width: 70%; margin: 0 auto;">
        <div style="float: left; width: 25%; font-size: 5em; text-align: center; color: #28a745;">✓</div>
        <div><h1 style="float: right; font-size: 1.5em;">Profile Updated Successfully!</h1></div>
    </div>
    <?php
} else {
    echo "Error updating profile: " . mysqli_error($con);
}

mysqli_close($con);
?>

</div>
</body>
</html>
