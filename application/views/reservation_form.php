
<h4>Create Reservation </h4>

<?php echo validation_errors(); ?>

<?php echo form_open('home/reserve') ?>
<fieldset>
	<div class="form-group">
		<label for="activity">Activity</label>
		<input type="input" name="activity" class="form-control" />
	</div>
	<div class="form-group">
	<label for="num_people">Number of People</label>
	<input type="input" name="num_people" class="form-control" />
	</div>
	<div class="form-group">
	<label for="start_date">Start Date</label>
	<input type="input" name="start_date" id="start_date" class="form-control" value="<?php echo $_POST['start_date']; ?>" />
	</div>
	<div class="form-group">
	<label for="end_date">End Date</label>
	<input type="input" name="end_date" class="form-control"  value="<?php echo $_POST['end_date']; ?>" />
	</div>
	<div class="form-group">
	<input type="hidden" name="room_id" value="<?php echo $_POST['room_id']; ?>" />

	<input type="submit" name="submit" value="Save" />
</fieldset>
</form>
