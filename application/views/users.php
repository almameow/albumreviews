<html>
<head>
	<title>Albums Home</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script src="http://getbootstrap.com/dist/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="/../assets/style.css">
	<link rel="shortcut icon" href="/../assets/favicon.ico" type="image/x-icon" />
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
					<li><a href="/index/go_home">Return to <?= $current_user['name'] ?>'s Dashboard</a></li>
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
			<div class="col-md-12">
				<h3 class="text-purple">Username: <?= $user['username'] ?></h3>
				<ul class="no_decoration_padding">
					<li>Name: <?= $user['name'] ?></li>
					<li>Email: <?= $user['email'] ?></li>
					<li>Total Reviews: <?= count($reviews) ?></li>
				</ul>

				<h4>Posted reviews on the following albums:</h4>
				<?php  
					echo "<ul class='no_decoration_padding'>";
					foreach($reviews as $review)
					{
						echo "<li><a href='/albums/show_album/" . $review['id'] . "'>" . $review['title'] . "</a> by " . $review['artist'] . "</li>";
					}
					echo "</ul>"
				?>
				</div>
			</div>
		</div>
	</div>
<?php
}
?>
</body>
</html>