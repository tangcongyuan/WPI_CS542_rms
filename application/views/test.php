<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <title>Simple Login with CodeIgniter - Private Area</title>
   <?php 
		foreach($css_files as $file): ?>
		<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
	<?php endforeach; ?>
	<?php foreach($js_files as $file): ?>
		<script src="<?php echo $file; ?>"></script>
	<?php endforeach; ?>
</head>
<?php 
//print_r($css_files);

$session_data = $this->session->userdata('logged_in'); ?>
<body>
   <h1>Home</h1>
   <h2>Welcome <?php echo $session_data['email']; ?>!</h2>
   
   <br />
   <div>
		<?php echo $output; ?>
    </div>
   <a href="logout">Logout</a>
</body>
</html>