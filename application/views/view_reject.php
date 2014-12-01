<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <title>RMS-Home-Reject Reservation</title>
</head>
<?php 
//print_r($css_files);

$session_data = $this->session->userdata('logged_in'); ?>
<body>
   <h1>Reject Reservation</h1>
   <!--<h2>Welcome <?php echo $session_data['email']; ?>!</h2>-->
    
   <br />
   <div>
		<?php echo form_open('approval/reject') ?>
       <label for="activity">Reason: </label>
       <input type="input" name="reason" /><br/>
       <input type="hidden" name="reservation_id" value="<?php echo $reservation_id; ?>" /><br/>
      <input type="submit" name="submit" value="Save" />
    </form>
   </div>

   <a href="home/logout">Logout</a>
</body>
</html>