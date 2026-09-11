<?php 
include_once"includes/header.php";
include_once"connection.php";

$apt_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sqldetails = mysqli_query($con, "SELECT * 
FROM available_flats f 
join members m on m.member_id = f.owner_id 
join flat_details d on d.flat_id = f.flat_id 
where f.flat_id = $apt_id");
if (!$sqldetails || mysqli_num_rows($sqldetails) == 0) {
header('location: myads.php');
exit;
}
$aptdetails = mysqli_fetch_array($sqldetails, MYSQLI_BOTH);
?>
<form method="post" action="posteditdone.php" enctype="multipart/form-data">
<div class="left">
<div>
<input type="hidden" name="id" value="<?php echo $apt_id ?>">
</div>

<p>
<strong>Availablity</strong><br>
<input type="radio" name="available" value="1" <?php if($aptdetails['available']==1) echo 'checked="checked"'; ?> />Available
<input type="radio" name="available" value="0" <?php if($aptdetails['available']==0) echo 'checked="checked"'; ?>/>Not Available
</p>

<p>
<strong>Flat City</strong><br>
<select name="flat_city">
<option value="Nha Trang" <?php if($aptdetails['flat_city']=='Nha Trang') echo 'selected'; ?>>Nha Trang</option>
<option value="Hà Nội" <?php if($aptdetails['flat_city']=='Hà Nội') echo 'selected'; ?>>Hà Nội</option>
<option value="TP HCM" <?php if($aptdetails['flat_city']=='TP HCM') echo 'selected'; ?>>TP HCM</option>
</select>
</p>

<p>
<strong>Flat Location</strong><br>
<input id="text5" type="text" name="flat_location" value="<?php echo htmlspecialchars($aptdetails['flat_location']); ?>"/>
</p>

<p>
<strong>Flat Rent (VND)</strong><br>
<input id="text5" type="number" name="flat_rent" value="<?php echo htmlspecialchars($aptdetails['flat_rent']); ?>"/>
</p>
</div>

<div class="right">
<p>
<strong>Flat Size</strong><br>
<input id="text5" type="number" name="flat_size" value="<?php echo htmlspecialchars($aptdetails['flat_size']); ?>"/>
</p>
<p>
<strong>Number of Rooms</strong><br>
<input id="text5" type="text" name="num_of_rooms" value="<?php echo htmlspecialchars($aptdetails['num_of_rooms']); ?>"/>
</p>

<div>
<strong>Change Images</strong><br>
<input type="file" name="image[]" id="image" multiple><br>
<input type="hidden" name="current_images" value="<?php echo htmlspecialchars($aptdetails['image']); ?>">
<?php if (!empty($aptdetails['image'])): ?>
<span>Current images:</span><br>
<?php foreach (explode(',', $aptdetails['image']) as $currentImage): ?>
<?php $currentImage = trim($currentImage); if (!empty($currentImage)): ?>
<div style="margin-top:8px;">
<span><?php echo htmlspecialchars($currentImage); ?></span><br>
<img src="apartment_images/<?php echo htmlspecialchars($currentImage); ?>" alt="Current flat image" style="max-width:100%; max-height:120px; margin-top:4px; border:1px solid #ccc; padding:4px;" />
</div>
<?php endif; ?>
<?php endforeach; ?>
<?php else: ?>
<span>No current image available</span>
<?php endif; ?>
</div>

<p>
<strong>Apartment Video URL</strong><br>
<input id="text5" type="text" name="video_url" value="<?php echo htmlspecialchars($aptdetails['video']); ?>" placeholder="https://youtu.be/... or video.mp4"/>
</p>

<p>
<strong>Replace Video File</strong><br>
<input type="file" name="video" id="video" accept="video/mp4,video/webm,video/ogg,video/quicktime"><br>
<input type="hidden" name="current_video" value="<?php echo htmlspecialchars($aptdetails['video']); ?>">
<?php if (!empty($aptdetails['video'])): ?>
<span>Current video:</span><br>
<?php if (preg_match('/(?:youtube\.com\/watch\?v=|youtube\.com\/embed\/|youtu\.be\/)([A-Za-z0-9_-]+)/i', $aptdetails['video'], $match)): ?>
<a href="<?php echo htmlspecialchars($aptdetails['video']); ?>" target="_blank" rel="noopener"><?php echo htmlspecialchars($aptdetails['video']); ?></a>
<?php else: ?>
<a href="<?php echo htmlspecialchars(strpos($aptdetails['video'], 'http') === 0 ? $aptdetails['video'] : 'apartment_images/' . $aptdetails['video']); ?>" target="_blank" rel="noopener"><?php echo htmlspecialchars($aptdetails['video']); ?></a>
<?php endif; ?>
<?php else: ?>
<span>No current video available</span>
<?php endif; ?>
</p>

<p>
<strong>Additional Informations</strong><br>
<input id="text5" type="text" name="additional_info" value="<?php echo htmlspecialchars($aptdetails['additional_info']); ?>"/>
</p>
<p>
<button class="button submit">Update!</button>
</p>
</div>
</form>
</div>
</body>
</html>
