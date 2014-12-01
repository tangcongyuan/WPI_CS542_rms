<html>
<head>
<title>RMS-Room Calendar</title>
<meta charset='utf-8' />
<link href='<?php echo base_url(); ?>/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='<?php echo base_url(); ?>/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='<?php echo base_url(); ?>/fullcalendar/lib/moment.min.js'></script>
<script src='<?php echo base_url(); ?>/fullcalendar/lib/jquery.min.js'></script>
<script src='<?php echo base_url(); ?>/fullcalendar/fullcalendar.min.js'></script>

<script src="<?php echo base_url(); ?>/fullcalendar/jquery-ui.min.js"></script>

<link rel="stylesheet" href="<?php echo base_url(); ?>/fullcalendar/jquery-ui.css" />

<script>

	$(document).ready(function() {

		$('#calendar').fullCalendar({

			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			selectable: true,
			defaultDate: '2014-11-12',
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
					window.location.href = "http://localhost/WPI_CS542_rms/index.php/home/reserve/" + <?php echo $room_id; ?> + "/" + date.format("YYYY-MM-DD");
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


				if(view.name == 'agendaDay'){
					var opt = {
							autoOpen: false,
							modal: true,
							width: 550,
							title: 'Details',
							buttons: {
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
							}
					};
				 $("#dialog").dialog(opt).dialog("open");


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
				<input type="input" name="start_date" value="" /><br />
				<label for="end_date">End Date</label>
				<input type="input" name="end_date" value="" /><br />

				<input type="hidden" name="room_id" value="<?php echo $room_id; ?>" />

				<input type="submit" name="submit" value="Save" />

			<?php echo form_close(); ?>
    </div>
  </div>

	<h2 align="center">Room Calendar - <?php echo $room_name; ?></h2>
	<div id='calendar'></div>

</body>
</html>
