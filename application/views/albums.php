<html>
<head>
	<title>Album Reviews</title>
	<!-- Call Twitter bootstrap -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
	
	<link rel="stylesheet" href="/../assets/style.css">
	<script>
		$(document).ready(function(){
			// Obtain 5 most recent reviews 
			$.get('/albums/get_recent_reviews', function(res){ 
				$('#recent_reviews').html(res);
			});
			// Obtain all album reviews
			$.get('/albums/get_all_reviews', function(res){ 
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
					<li><p class="text-purple navbar-text">Welcome <?= $user['name'] ?>!</p></li>
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
			<!-- Recent Reviews Column -->
			<div class="col-md-6">
				<h3 class="text-purple">Recent Reviews:</h3>
				<div id="recent_reviews">
				</div>
			</div>

			<!-- All Albums Column -->
			<div class="col-md-6">
				<h3 class="text-purple">Other Albums with Reviews:</h3>
				<div class="col-md-9 col-md-offset-1 border scroll_box" id="all_reviews">
				</div>
			</div>
		</div>
	</div>
<?php
}
?>
</body>
</html>