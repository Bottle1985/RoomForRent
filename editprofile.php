<?php
include_once "includes/header.php";
include_once "connection.php";

if (!isset($_SESSION['id1370950_demo_cse311'])) {
    header('location:login.php');
    exit;
}

$uname = $_SESSION['username'];
$user = mysqli_query($con, "SELECT * FROM members WHERE username='$uname'");
$row = mysqli_fetch_array($user, MYSQLI_ASSOC);

if (!$row) {
    echo "User not found.";
    exit;
}
?>

<form method="post" action="save_profile.php">
    <input type="hidden" name="member_id" value="<?php echo $row['member_id']; ?>" />

    <div class="left">
        <p>
            <strong>First Name</strong><br>
            <input id="text5" type="text" name="first_name" value="<?php echo htmlspecialchars($row['first_name']); ?>" required />
        </p>
        <p>
            <strong>Last Name</strong><br>
            <input id="text5" type="text" name="last_name" value="<?php echo htmlspecialchars($row['last_name']); ?>" required />
        </p>
        <p>
            <strong>Gender:</strong><br>
            <input type="radio" name="gender" value="Male" <?php if ($row['gender'] == 'Male') echo 'checked'; ?> />Male&nbsp;
            <input type="radio" name="gender" value="Female" <?php if ($row['gender'] == 'Female') echo 'checked'; ?> />Female&nbsp;
            <input type="radio" name="gender" value="Other" <?php if ($row['gender'] == 'Other') echo 'checked'; ?> />Other&nbsp;
        </p>
        <p>
            <strong>Username</strong><br>
            <input id="text5" type="text" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required />
        </p>
        <p>
            <strong>New Password</strong><br>
            <input id="text5" type="password" name="password" />
        </p>
        <p>
            <strong>Confirm Password</strong><br>
            <input id="text5" type="password" name="cpasswd" />
        </p>
    </div>

    <div class="right">
        <p>
            <strong>City</strong><br>
            <select name="city" required>
                <option value="nhatrang" <?php if ($row['city'] == 'nhatrang') echo 'selected'; ?>>Nha Trang</option>
                <option value="hochiminh" <?php if ($row['city'] == 'hochiminh') echo 'selected'; ?>>Hồ Chí Minh</option>
                <option value="hanoi" <?php if ($row['city'] == 'hanoi') echo 'selected'; ?>>Hà Nội</option>
            </select>
        </p>
        <p>
            <strong>Location</strong><br>
            <input id="text5" type="text" name="location" value="<?php echo htmlspecialchars($row['location']); ?>" required />
        </p>
        <p>
            <strong>Contact Number</strong><br>
            <input id="text5" type="text" name="contact_no" value="<?php echo htmlspecialchars($row['contact_no']); ?>" required />
        </p>
        <p>
            <button class="button submit">Save Profile</button>
        </p>
    </div>
</form>

</div>
</body>
</html>
