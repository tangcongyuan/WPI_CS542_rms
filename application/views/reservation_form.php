<html>
<head><title>RMS-Reserve Room</title></head>
<body>
<h2>Create Reservation <?php echo $room_name; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('home/reserve') ?>

	<label for="activity">Activity</label>
	<input type="input" name="activity" /><br />
	<label for="num_people">Number of People</label>
	<input type="input" name="num_people" /><br />
	<label for="start_date">Start Date</label>
	<input type="input" name="start_date" value="<?php echo $startDate; ?>" /><br />
	<label for="end_date">End Date</label>
	<input type="input" name="end_date" value="<?php echo $endDate; ?>" /><br />

	<input type="hidden" name="room_id" value="<?php echo $room_id; ?>" />
	<!--
	<input type="hidden" name="start_date" value="<?php echo $startDate; ?>" />
	<input type="hidden" name="end_date" value="<?php echo $endDate; ?>" />
	-->
	<input type="submit" name="submit" value="Save" />

</form>
</body>
</html>