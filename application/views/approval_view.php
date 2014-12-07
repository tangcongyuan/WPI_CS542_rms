
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RMS - Manage Reservation</title>
   <?php 
    foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
  <?php endforeach; ?>
  <?php foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
  <?php endforeach; ?>
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
                             <b>Manage Reservation</b>
                        </div>
            <div class="panel-body">
              <?php echo $output; ?>
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
