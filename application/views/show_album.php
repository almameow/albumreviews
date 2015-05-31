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
			$.get('/albums/get_reviews_per_album', function(res){ //$.get is obtaining all data values; put it here to load db as soon as page loads
				$('#all_reviews').html(res);
			});
		});
	</script>
</head>
<body>
<div class="container-fluid">
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<!-- Navbar at top -->
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
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Home</a></li>
					<li><a href="/index/logout">Logout</a></li>
				</ul>
			</div>
		</div>
	</nav>

	<!-- Content -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<?php
					echo "<h3 class='text-purple'>" . $reviews['title'] . "</h3>";
					echo "<p>Album Artist: " . $reviews['artist'] . "</p>";
				?>

				<h4>Reviews:</h4>
				<div id="all_reviews"></div>
			</div>

			<div class="col-md-6">
				<div class="col-md-8 col-md-offset-1">
					<form class="col-md-offset-3" action="#" method="post">
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
						<button type="submit" class="btn btn-purple col-md-offset-4">Submit review</button>
					</form>
				</div>
			</div>

		</div>
	</div>
</div>
</body>
</html>