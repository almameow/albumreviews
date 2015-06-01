<html>
<head>
	<title>Albums Home</title>
	<!-- Call Twitter bootstrap -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="/../assets/style.css">

	<script>
		$(document).ready(function(){
			// Obtain all album artists from DB
			$.get('/albums/get_all_artists', function(res){ 
				$('#all_artists').html(res);
			});
		});
	</script>
</head>
<body>
<!-- Load body only if user is logged in -->
<?php if($this->session->userdata("logged_in") == TRUE)
{ ?>
	<!-- Navbar -->
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#uncollapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<span class="glyphicon glyphicon-music navbar-brand" aria-hidden="true"></span>
			</div>
			<div class="collapse navbar-collapse" id="uncollapse">
				<ul class="nav navbar-nav">
					<li><a href="/index/go_home">Return to <?= $user['name'] ?>'s Dashboard</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><p class="navbar-text">Add Album and Review</p></li>
					<li><a href="/index/logout">Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Content -->
	<div class="container-fluid">

		<!-- Title -->
		<div class="row">
			<div class="col-md-12">
				<?php
				if($this->session->flashdata("add_error"))
					echo "<h6 class='text-danger'>" . $this->session->flashdata("add_error") . "</h6>";
				if($this->session->flashdata("add_success"))
					echo "<h6 class='text-success'>" . $this->session->flashdata("add_success") . "</h6>";
				?>
				<h3 class="text-purple">Add a new album and a review:</h3>
			</div>
		</div>

		<!-- Form -->
		<div class="row">
			<form class="col-md-9 col-md-offset-1" action="/albums/add_album_review" method="post">
				<div class="row">
					<div class="form-group col-md-8">
						<label for="title">Album Title:</label>
						<input type="text" class="form-control" id="title" name="title">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-8">
						<label for="artist">Album Artist:</label>
						<h6><label for="artist" >Select from the list: </label></h6>
						<div id="all_artists" name="artist"></div>
						<h6><label for="artist2">Or add a new artist:</label></h6>
						<input type="text" class="form-control" id="artist2" name="artist">
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-8">
						<label for="review">Review:</label>
						<textarea class="form-control" name="review" rows="3"></textarea>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-8">
						<label for="rating">Rating:</label>
						<select class="form-control" name="rating" id="rating">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
				</div>
				<div class="row">
					<button type="submit" class="btn btn-purple btn-margin-left col-md-3">Add album and review</button>
				</div>
			</form>
		</div>

	</div>
<?php
}
?>
</body>
</html>