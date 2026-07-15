<?php
include_once "includes/header.php";
include_once "connection.php";

$flat_id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

// Prefill from logged-in user if available
$prefill_name = '';
$prefill_contact = '';
if (isset($_SESSION['username'])) {
    $uname = mysqli_real_escape_string($con, $_SESSION['username']);
    $mres = mysqli_query($con, "SELECT first_name, last_name, contact_no FROM members WHERE username='$uname' LIMIT 1");
    if ($mres && mysqli_num_rows($mres) > 0) {
        $mrow = mysqli_fetch_assoc($mres);
        $prefill_name = trim($mrow['first_name'] . ' ' . $mrow['last_name']);
        $prefill_contact = $mrow['contact_no'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flat_id = isset($_POST['flat_id']) ? intval($_POST['flat_id']) : $flat_id;
    $bidder_username = isset($_SESSION['username']) ? mysqli_real_escape_string($con, $_SESSION['username']) : '';
    $bidder_name = isset($_POST['bidder_name']) ? mysqli_real_escape_string($con, trim($_POST['bidder_name'])) : '';
    $bidder_contact = isset($_POST['bidder_contact']) ? mysqli_real_escape_string($con, trim($_POST['bidder_contact'])) : '';

    $flatResult = mysqli_query($con, "SELECT flat_id FROM available_flats WHERE flat_id=$flat_id AND available=1 LIMIT 1");

    if ($flat_id <= 0 || empty($bidder_name) || empty($bidder_contact)) {
        $error = 'Please provide name and contact number.';
    } elseif (!$flatResult || mysqli_num_rows($flatResult) === 0) {
        $error = 'This flat is no longer available for reservation.';
    } else {
        $sql = "INSERT INTO reserved_flats (flat_id, bidder_username, bidder_name, bidder_contact) VALUES ('$flat_id', '$bidder_username', '$bidder_name', '$bidder_contact')";
        if (mysqli_query($con, $sql)) {
            ?>
            <div style="width: 70%; margin: 20px auto;">
                <div style="float:left; width:25%;"><img src="images/success.png" alt="Success Icon" style="width:100%;"/></div>
                <div style="float:right; width:70%;"><h1 style="font-size: 1.5em;">Your reservation has been posted!</h1></div>
                <div style="clear:both"></div>
            </div>
            <?php
            mysqli_close($con);
            exit;
        } else {
            $error = 'Database error: ' . mysqli_error($con);
        }
    }
}
?>

<div style="max-width:700px;margin:20px auto;padding:10px;border:1px solid #ddd;">
    <h2>Reserve Flat</h2>
    <?php if (!isset($_SESSION['username'])): ?>
        <p>You can reserve as a guest. An account is not required.</p>
    <?php endif; ?>
    <?php if (!empty($error)): ?><div style="color:red;margin-bottom:10px;"><?php echo htmlspecialchars($error); ?></div><?php endif; ?>
    <form method="post" action="reserve_flat.php" accept-charset="utf-8">
        <input type="hidden" name="flat_id" value="<?php echo htmlspecialchars($flat_id); ?>">
        <p>
            <label><strong>Your Name</strong><br>
            <input type="text" name="bidder_name" value="<?php echo htmlspecialchars(isset($_POST['bidder_name']) ? $_POST['bidder_name'] : $prefill_name); ?>" style="width:100%;" required></label>
        </p>
        <p>
            <label><strong>Contact Number</strong><br>
            <input type="text" name="bidder_contact" value="<?php echo htmlspecialchars(isset($_POST['bidder_contact']) ? $_POST['bidder_contact'] : $prefill_contact); ?>" style="width:100%;" required></label>
        </p>
        <p>
            <button type="submit" class="button submit">Submit Reservation</button>
        </p>
    </form>
</div>

</body>
</html>
