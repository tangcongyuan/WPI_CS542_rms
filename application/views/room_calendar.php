<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RMS - Choose Room</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>admin-theme/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>admin-theme/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>admin-theme/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>admin-theme/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<link href='<?php echo base_url(); ?>/fullcalendar/fullcalendar.css' rel='stylesheet' />
	<link href='<?php echo base_url(); ?>/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
	<script src='<?php echo base_url(); ?>/fullcalendar/lib/moment.min.js'></script>
	<script src='<?php echo base_url(); ?>/fullcalendar/lib/jquery.min.js'></script>
	<script src='<?php echo base_url(); ?>/fullcalendar/fullcalendar.min.js'></script>

	<script src="<?php echo base_url(); ?>/fullcalendar/jquery-ui.min.js"></script>

	<link rel="stylesheet" href="<?php echo base_url(); ?>/fullcalendar/jquery-ui.css" />
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Room Management System</a>
            </div>
            <!-- /.navbar-header -->


            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url(); ?>index.php/user/profile"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="<?php echo base_url(); ?>index.php/user/changePassword"><i class="fa fa-lock fa-fw"></i> Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>index.php/home/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

<div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="home"><i class="fa fa-book fa-fw"></i> Reservation<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/home"><i class="fa fa-calendar fa-fw"></i>  Reserve</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url(); ?>index.php/home/cancel"><i class="fa fa-eraser fa-fw"></i>  Cancel Reservation</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url(); ?>index.php/home/history"><i class="fa fa-archive fa-fw"></i>  Reservation History</a>
                                </li>								
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<?php 
							$session_data = $this->session->userdata('logged_in');
							if($session_data['role'] == 2 || $session_data['role'] == 3) //reserver=1, approval=2, admin=3
							{
						?>
						<li>
                           <a href="#"><i class="fa fa-check fa-fw"></i> Approval<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/approval"><i class="fa fa-edit fa-fw"></i> Approve/Reject</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url(); ?>index.php/approval/history"><i class="fa fa-archive fa-fw"></i> Approval History</a>
                                </li>
                            </ul>
                        </li>
						<?php
							}
							if($session_data['role'] == 3) //reserver=1, approval=2, admin=3
							{
						?>
                        <li>
                            <a href="#"><i class="fa fa-cogs fa-fw"></i> Management<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/building"><i class="fa fa-building fa-fw"></i> Building</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url(); ?>index.php/room"><i class="fa fa-home fa-fw"></i> Room</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url(); ?>index.php/equipment"><i class="fa fa-gear fa-fw"></i> Equipment</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url(); ?>index.php/room_equipment"><i class="fa fa-briefcase fa-fw"></i> Room Equipment</a>
                                </li>
								<li>
                                    <a href="<?php echo base_url(); ?>index.php/user"><i class="fa fa-user fa-fw"></i> User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
						<?php
							}
						?>
                        <li>
                            <a class="active" href="<?php echo base_url(); ?>index.php/report"><i class="fa fa-dashboard fa-fw"></i> Report</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->        </nav>
<script>

	$(document).ready(function() {

		$('#calendar').fullCalendar({

			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			selectable: true,
			//defaultDate: '2014-11-12',
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: {
				url: 'http://localhost/WPI_CS542_rms/index.php/home/getJson/' + <?php echo $room_id; ?>,
				error: function() {
					$('#script-warning').show();
				}
			},
			/* dayRender: function (date, cell) {
				cell.prepend("<a href='adfs'>Reserve</a>");
			}, */
			dayClick: function(date, jsEvent, view) {

				//alert('Clicked on: ' + date.format());

				//alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);

				//alert('Current view: ' + view.name);

				// change the day's background color just for fun
				//$(this).css('background-color', 'red');
				//window.location.href = "http://localhost/WPI_CS542_rms/index.php/home/reserve/1/" + date.format("YYYY-MM-DD");


				if(view.name == 'agendaDay')
				{
					//alert(date.format('TT'));
					//window.location.href = "http://localhost/WPI_CS542_rms/index.php/home/reserve/" + <?php echo $room_id; ?> + "/" + date.format("YYYY-MM-DD");
				}
				//alert(date.format('TT'));
				if(view.name == 'month')
				{
					$('#calendar').fullCalendar('gotoDate',date);
					$('#calendar').fullCalendar('changeView','agendaDay');
				}
			},
			select: function(start, end, jsEvent, view){

				/* if(view.name == 'agendaDay'){
					window.location.href = "http://localhost/WPI_CS542_rms/index.php/home/reserve/1/"+start.format('YYYY-MM-DD')+"/"+start.format('HH:mm')+"/"+start.format('YYYY-MM-DD')+"/"+end.format('HH:mm');

				} */
				$('#calendar').fullCalendar('unselect');
				//alert(startDate + "adsf" + endDate)

				var loadDate = {
								  'start_date' : start.format("YYYY-MM-DD HH:mm:ss"),
								  'end_date' : end.format("YYYY-MM-DD HH:mm:ss"),
								  'room_id' : <?php echo $room_id; ?>
							   };


				if(view.name == 'agendaDay'){
					var opt = {
							autoOpen: false,
							modal: true,
							width: 550,
							title: 'Details',
							/* buttons: {
								"Save": function() {
									insert(
										$( "#activity" ).val(),
										$( "#num_people" ).val()
									);
									$( this ).dialog( "close" );
									setTimeout(function(){location.reload(true);},500);
								},
								"Cancel": function() {
									$( this ).dialog( "close" );
								}
							} */
					};

				// $("#dialog").dialog(opt).dialog("open");

				 $("#dialog").html('').load('http://localhost/WPI_CS542_rms/index.php/home/formReservation', loadDate, function () {
						$("#dialog").dialog(opt).dialog("open");
					});

				/* var title= prompt('Event Title: ');
				var num_people= prompt('Num of People: ');
				var eventData;
				if(title){
					eventData = {
						title: title,
					};
					$.ajax({
						type: 'POST',
						url: 'http://localhost/WPI_CS542_rms/index.php/home/saveData/1/',
						data: eventData,
						success: function(data){
							alert('success');
						}
					});
				} */


				}
				//window.location.href = "http://localhost/WPI_CS542_rms/index.php/home/reserve/1/" + date.format("YYYY-MM-DD");
			}
		});

    $('#calendar').fullCalendar();

	});

	function insert(activity, num_people) {
		//alert(activity);
        mydata = {
                "activity"      : activity ,
                "num_people"    : num_people
				};

        $.ajax({
            type: "POST",
            url: 'http://localhost/WPI_CS542_rms/index.php/home/saveData/1/',
						data: mydata,
						dataType: "json",
						success: function(data){
							alert('success');
						}
        });
    }


</script>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">						
                        <h1 class="page-header">Welcome</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
				<div class="row">
                    <div class="col-lg-12">
						<div class="panel panel-primary">
                        <div class="panel-heading">
                             <b>Reserve a Room >> <i class="fa fa-building-o fa-fw"></i> Choose Building:  >> <i class="fa fa-home fa-fw"></i> Choose Room >> <i class="fa fa-calendar fa-fw"></i> Look-up Calendar for Room <?php echo $room_name; ?></b>
                        </div>
						<?php echo $message; ?>
						<div class="panel-body">
						<div align="right"><a href="<?php echo base_url(); ?>index.php/home" class="btn btn-primary btn-sm">Back</a></div>
						<h2 align="center">Room Calendar <?php echo $room_name; ?></h2>
	<div id='calendar'></div>
							<div id="dialog" class="event-dialog" title="Event"  style="display:none;">
		<div id="dialog-inner">
			<!--
<?php //echo "This is the room id: ".$room_id; ?>
<style>

	body {
		margin: 40px 10px;
		padding: 0;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		font-size: 14px;
	}

	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}

</style>
</head>
<body>

	<div id="dialog" class="event-dialog" title="Event"  style="display:none;">
		<div id="dialog-inner">

			<?php echo form_open('home/reserve') ?>

				<label for="activity">Activity</label>
				<input type="input" name="activity" id="activity" /><br />
				<label for="num_people">Number of People</label>
				<input type="input" name="num_people" id="num_people" /><br />
				<label for="start_date">Start Date</label>
				<input type="input" name="start_date" id="start_date" /><br />
				<label for="end_date">End Date</label>
				<input type="input" name="end_date" /><br />

				<input type="hidden" name="room_id" value="<?php echo $room_id; ?>" />

				<input type="submit" name="submit" value="Save" />

<<<<<<< HEAD
			<?php echo form_close(); ?>-->
		</div>
    </div>

			<?php echo form_close(); ?>
    </div>
  </div>

	
						</div>
						</div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery
    <script src="<?php echo base_url(); ?>admin-theme/js/jquery.js"></script>
 -->
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>admin-theme/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>admin-theme/js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>admin-theme/js/sb-admin-2.js"></script>




</body>

</html>
