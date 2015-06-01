<html>
<head>
	<title>Album Reviews</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/../assets/style.css">
	<link rel="shortcut icon" href="/../assets/favicon.ico" type="image/x-icon" />
	<style type="text/css">
		body{
			padding-top: 0px;
		}
	</style>
</head>
<body>
<!-- Video background -->
<video loop muted autoplay poster="/../assets/shimmer.png" class="fullscreen-bg-video">
    <source src="/../assets/shimmer.mp4" type="video/mp4">
    <source src="/../assets/shimmer.webm" type="video/webm">
</video>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="title-text">Album Reviews</h1>
		</div>
	</div>

	<div class="row">
		<!-- Registration Box -->
		<div class="col-md-5 border white">
			<h3 class="text-purple col-md-11 col-md-offset-1">Register</h3>
			<?php
				if($this->session->flashdata("reg_error"))
					echo "<h6 class='text-danger col-md-11 col-md-offset-1'>" . $this->session->flashdata('reg_error') . "</h6>";
				if($this->session->flashdata("reg_success"))
					echo "<h6 class='text-success col-md-11 col-md-offset-1'>" . $this->session->flashdata('reg_success') . "</h6>";
			?>
			<form action="/index/register" class="col-md-8 col-md-offset-2" method="post">
				<div class="form-group">
					<label for="name">Name:</label>
					<input type="text" class="form-control" id="name" name="name">
				</div>
				<div class="form-group">
					<label for="username">Username:</label>
					<input type="text" class="form-control" id="username" name="username">
				</div>
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="email" class="form-control" id="email" name="email">
				</div>
				<div class="form-group">
					<label for="pass">Password:</label>
					<input type="password" class="form-control" id="pass" name="pass">
				</div>
				<div class="form-group">
					<label for="confirm_pass">Confirm Password:</label>
					<input type="password" class="form-control" id="confirm_pass" name="confirm_pass">
				</div>
				<button type="submit" class="btn btn-purple col-md-5 col-md-offset-7">Register</button>
			</form>
		</div>

		<!-- Login Box -->
		<div class="col-md-5 col-md-offset-2 border white">
			<h3 class="text-purple col-md-offset-1">Login</h3>
			<?php
				if($this->session->flashdata("login_error"))
					echo "<h6 class='text-danger col-md-11 col-md-offset-1'>" . $this->session->flashdata('login_error') . "</h6>";
			?>
			<form action="/index/login" class="col-md-8 col-md-offset-2" method="post">
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="email" class="form-control" id="email" name="email">
				</div>
				<div class="form-group">
					<label for="pass">Password:</label>
					<input type="password" class="form-control" id="pass" name="pass">
				</div>
				<button type="submit" class="btn btn-purple col-md-5 col-md-offset-7">Login</button>
			</form>
		</div>
	</div>
</div>
</body>
</html>