<html>
<head>
	<title>Albums Home</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/../assets/style.css">
	<link rel="shortcut icon" href="/../assets/favicon.ico" type="image/x-icon" />
	<script>
		$(document).ready(function(){
			// 
			$.get('/albums/get_reviews_per_album', function(res){ 
				$('#all_reviews').html(res);
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
					<li><a href="/albums/add">Add Album and Review</a></li>
					<li><a href="/index/logout">Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Content -->
	<div class="container-fluid">
		<div class="row">

			<!-- Album name and reviews -->
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12">
						<?php
							echo "<h3 class='text-purple'>" . $reviews['title'] . "</h3>";
							echo "<p>Album Artist: " . $reviews['artist'] . "</p>";
						?>

						<h4>Reviews:</h4>
					</div>
				</div>
				<div class="row">
					<div id="all_reviews"></div>
				</div>
			</div>
			

			<!-- Add a review -->
			<div class="col-md-4 col-md-offset-1">
				<form action="/albums/add_review_to_album" method="post">
					<div class="form-group">
						<label for="review">Add a review:</label>
						<textarea class="form-control less_width" name="review" rows="3"></textarea>
					</div>
					<div class="form-group">
						<label for="rating">Rating:</label>
						<select class="form-control least_width" name="rating" id="rating">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select>
					</div>
					<button type="submit" class="btn btn-purple col-md-3">Submit review</button>
				</form>
			</div>

		</div>
	</div>
</div>
<?php
}
?>
</body>
</html>