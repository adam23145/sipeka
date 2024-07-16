<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">

  <title>Detail Mahasiswa | SIWALI</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url();?>public/assets/vendors/css/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>public/assets/core/css/adminlte.min.css">
</head>

<body class="layout-top-nav grey" style="height: auto;">
    <div class="wrapper">

	  <!-- Navbar -->
	  <nav class="main-header navbar navbar-expand navbar-light navbar-white">
		<div class="container">
		
		  <a href="" class="navbar-brand">
			<img src="<?php echo base_url();?>public/assets/core/images/logo1.png" alt="SIPEKA LOGO" class="brand-image img-circle elevation-8" style="opacity: 1">
			<span class="brand-text font-weight-light">SIPEKA</span>
		  </a>

		  <!-- Right navbar links -->
		  <ul class="navbar-nav ml-auto">
			<!-- Messages Dropdown Menu -->
			<li class="nav-item dropdown">				
				<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
				  <div style="margin-top: -3px; margin-left: -7px" class="image">
						<img style="width: 35px" src="<?php echo base_url();?>public/assets/core/images/user2-160x160.jpg" class="img-circle elevation-3" alt="User Image">
				  </div>
				</a>
				<div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
				  <div class="dropdown-divider"></div>
				  <a href="<?php echo base_url();?>profile/ch_passwd" class="dropdown-item">
					<i class="fas fa fa-key"></i> Change Password
				  </a>

				  <div class="dropdown-divider"></div>
				  <a href="<?php echo base_url();?>profile" class="dropdown-item">
					<i class="fas fa fa-user"></i> Edit Profile
				  </a>

				  <div class="dropdown-divider"></div>
				  <a href="<?php echo base_url();?>login/logout" class="dropdown-item">
					<i class="fas fa-sign-out-alt"></i> Logout
				  </a>
				</div>
			</li>
		  </ul>
		</div>
	  </nav>
	  <!-- /.navbar -->

	  <!-- Content Wrapper. Contains page content -->
	  <div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<div class="content-header">
		  <div class="container">
			<div class="row mb-2">
			  <div class="col-sm-6">
				<h1 class="m-0 text-dark"> Mahasiswa </h1>
			  </div><!-- /.col -->
			  <div class="col-sm-6">
				
			  </div><!-- /.col -->
			</div><!-- /.row -->
		  </div><!-- /.container-fluid -->
		</div>
		<!-- /.content-header -->

		<!-- Main content -->
		<div class="content">
		  <div class="container">
			<div class="row">
			  <div class="col-md-3">

				<!-- Profile Image -->
				<div class="card card-primary card-outline">
				  <div class="card-body box-profile">
					<div class="text-center">
					  <img class="profile-user-img img-fluid img-circle"
						   src="<?php echo base_url();?>public/assets/core/images/user2-160x160.jpg"
						   alt="User profile picture">
					</div>
					<p style="margin-bottom: 0px;">&nbsp;</p>
					<p style="margin-bottom: 3px;" class="text-muted text-center">Nama</p>
					<p class="text-muted text-center">NIM</p>
					
				  </div>
				  <!-- /.card-body -->
				</div>
				<!-- /.card -->

			  </div>
			  <!-- /.col -->
			  <div class="col-md-9">
			
					
				<!-- About Me Box -->
				<div class="card card-primary card-outline">
				  <!-- /.card-header -->
				  <div class="card-body">
					  <div class="row">
						<div class="col-md-6">
							<strong><i class="fa fa-calendar"></i> Tempat &amp; Tanggal Lahir</strong>
							<p class="text-muted">SUKABUMI, 1985-08-11</p>
						</div>
						<div class="col-md-6">
							<strong><i class="fas fa-user-friends"></i> Nama Ibu Kandung</strong>
							<p class="text-muted">Siti</p>
						</div>
					  </div>
					  <div class="row">
						<div class="col-md-6">
							<strong><i class="fas fa-transgender"></i> Jenis Kelamin</strong>
							<p class="text-muted">Laki - Laki</p>
						</div>
						<div class="col-md-6">
							<strong><i class="fas fa-graduation-cap"></i> Program Study </strong>
							<p class="text-muted">Ekonomi Syariah</p>
						</div>
					  </div>
					  <div class="row">
						<div class="col-md-6">
							<strong><i class="fas fa-globe"></i> Agama</strong>
							<p class="text-muted">Islam</p>
						</div>
						<div class="col-md-6">
							<strong><i class="fa fa-calendar"></i> Tanggal Masuk / Angkatan</strong>
							<p class="text-muted">26/03/2017 - 2017</p>
						</div>
					  </div>
				  
				  </div>
				  <!-- /.card-body -->
				</div>
				<!-- /.card -->
			  </div>
			  <!-- /.col -->
			</div>
			
			<div class="row">
				<div class="col-md-12">
				<div class="card">
				  <div class="card-header p-2">
					<ul class="nav nav-pills">
					  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
					  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
					  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
					</ul>
				  </div><!-- /.card-header -->
				  <div class="card-body">
					<div class="tab-content">
					  <div class="active tab-pane" id="activity">
						<!-- Post -->
						<div class="post clearfix">
						  <!-- /.user-block -->
						  <p>
							Lorem ipsum represents a long-held tradition for designers,
							typographers and the like. Some people hate it and argue for
							its demise, but others ignore the hate as they create awesome
							tools to help create filler text for everyone from bacon lovers
							to Charlie Sheen fans.
						  </p>
						</div>
						<!-- /.post -->

						<!-- Post -->
						<div class="post clearfix">
						  
						  <p>
							Lorem ipsum represents a long-held tradition for designers,
							typographers and the like. Some people hate it and argue for
							its demise, but others ignore the hate as they create awesome
							tools to help create filler text for everyone from bacon lovers
							to Charlie Sheen fans.
						  </p>

						</div>
						<!-- /.post -->
						
						<!-- Post -->
						<div class="post clearfix">
						  
						  <p>
							Lorem ipsum represents a long-held tradition for designers,
							typographers and the like. Some people hate it and argue for
							its demise, but others ignore the hate as they create awesome
							tools to help create filler text for everyone from bacon lovers
							to Charlie Sheen fans.
						  </p>

						</div>
						<!-- /.post -->

					  </div>
					  <!-- /.tab-pane -->
					  <div class="tab-pane" id="timeline">
						<!-- The timeline -->
						<ul class="timeline timeline-inverse">
						  <!-- timeline time label -->
						  <li class="time-label">
							<span class="bg-danger">
							  10 Feb. 2014
							</span>
						  </li>
						  <!-- /.timeline-label -->
						  <!-- timeline item -->
						  <li>
							<i class="fas fa-envelope bg-primary"></i>

							<div class="timeline-item">
							  <span class="time"><i class="far fa-clock"></i> 12:05</span>

							  <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>

							  <div class="timeline-body">
								Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
								weebly ning heekya handango imeem plugg dopplr jibjab, movity
								jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
								quora plaxo ideeli hulu weebly balihoo...
							  </div>
							  <div class="timeline-footer">
								<a href="#" class="btn btn-primary btn-sm">Read more</a>
								<a href="#" class="btn btn-danger btn-sm">Delete</a>
							  </div>
							</div>
						  </li>
						  <!-- END timeline item -->
						  <!-- timeline item -->
						  <li>
							<i class="fas fa-user bg-info"></i>

							<div class="timeline-item">
							  <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

							  <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted your friend request
							  </h3>
							</div>
						  </li>
						  <!-- END timeline item -->
						  <!-- timeline item -->
						  <li>
							<i class="fas fa-comments bg-warning"></i>

							<div class="timeline-item">
							  <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

							  <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post</h3>

							  <div class="timeline-body">
								Take me to your leader!
								Switzerland is small and neutral!
								We are more like Germany, ambitious and misunderstood!
							  </div>
							  <div class="timeline-footer">
								<a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
							  </div>
							</div>
						  </li>
						  <!-- END timeline item -->
						  <!-- timeline time label -->
						  <li class="time-label">
							<span class="bg-success">
							  3 Jan. 2014
							</span>
						  </li>
						  <!-- /.timeline-label -->
						  <!-- timeline item -->
						  <li>
							<i class="fas fa-camera bg-purple"></i>

							<div class="timeline-item">
							  <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

							  <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos</h3>

							  <div class="timeline-body">
								<img src="http://placehold.it/150x100" alt="..." class="margin">
								<img src="http://placehold.it/150x100" alt="..." class="margin">
								<img src="http://placehold.it/150x100" alt="..." class="margin">
								<img src="http://placehold.it/150x100" alt="..." class="margin">
							  </div>
							</div>
						  </li>
						  <!-- END timeline item -->
						  <li>
							<i class="far fa-clock bg-gray"></i>
						  </li>
						</ul>
					  </div>
					  <!-- /.tab-pane -->

					  <div class="tab-pane" id="settings">
						<form class="form-horizontal">
						  <div class="form-group">
							<label for="inputName" class="col-sm-2 control-label">Name</label>

							<div class="col-sm-10">
							  <input type="email" class="form-control" id="inputName" placeholder="Name">
							</div>
						  </div>
						  <div class="form-group">
							<label for="inputEmail" class="col-sm-2 control-label">Email</label>

							<div class="col-sm-10">
							  <input type="email" class="form-control" id="inputEmail" placeholder="Email">
							</div>
						  </div>
						  <div class="form-group">
							<label for="inputName2" class="col-sm-2 control-label">Name</label>

							<div class="col-sm-10">
							  <input type="text" class="form-control" id="inputName2" placeholder="Name">
							</div>
						  </div>
						  <div class="form-group">
							<label for="inputExperience" class="col-sm-2 control-label">Experience</label>

							<div class="col-sm-10">
							  <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
							</div>
						  </div>
						  <div class="form-group">
							<label for="inputSkills" class="col-sm-2 control-label">Skills</label>

							<div class="col-sm-10">
							  <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
							</div>
						  </div>
						  <div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
							  <div class="checkbox">
								<label>
								  <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
								</label>
							  </div>
							</div>
						  </div>
						  <div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
							  <button type="submit" class="btn btn-danger">Submit</button>
							</div>
						  </div>
						</form>
					  </div>
					  <!-- /.tab-pane -->
					</div>
					<!-- /.tab-content -->
				  </div><!-- /.card-body -->
				</div>
				<!-- /.nav-tabs-custom -->
			  </div>
			  <!-- /.col -->
			</div>
			
			<!-- /.row -->
		  </div><!-- /.container-fluid -->
		</div>
		<!-- /.content -->
	  </div>
	  <!-- /.content-wrapper -->

	  <!-- Main Footer -->
	  <!--footer class="main-footer">
		<!-- To the right -->
		<!--div class="float-right d-none d-sm-inline">
		  Anything you want
		</div>
		<!-- Default to the left -->
		<!--strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
	  </footer-->
	</div>
	<!-- ./wrapper -->
</body>

<!-- jQuery -->
<script src="<?php echo base_url();?>public/assets/vendors/js/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url();?>public/assets/vendors/js/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<!-- <script src="../../dist/js/adminlte.min.js"></script> -->
<script type="text/javascript">

</script>

</html>