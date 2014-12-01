
<h2>Create Reservation </h2>

<?php echo validation_errors(); ?>

<?php echo form_open('home/reserve') ?>

	<label for="activity">Activity</label>
	<input type="input" name="activity" /><br />
	<label for="num_people">Number of People</label>
	<input type="input" name="num_people" /><br />
	<label for="start_date">Start Date</label>
	<input type="input" name="start_date" id="start_date" value="<?php echo $_POST['start_date']; ?>" /><br />
	<label for="end_date">End Date</label>
	<input type="input" name="end_date"  value="<?php echo $_POST['end_date']; ?>" /><br />
	<input type="hidden" name="room_id" value="<?php echo $_POST['room_id']; ?>" />

	<input type="submit" name="submit" value="Save" />

</form>
