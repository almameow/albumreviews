<?php  
	foreach($reviews as $review)
	{
	echo "<div class='row col-md-11 col-md-offset-1'>";
		echo "<h4><a href='/albums/show_album/" . $review['album_id'] . "'>" . $review['title'] . "</a> by " . $review['artist'] . "</h4>";
		echo "<p class='inline'>Rating:</p>";
		for($i=0; $i<$review['rating']; $i++)
		{
			echo "<span class='glyphicon glyphicon-star text-purple' aria-hidden='true'></span>";
		}
		for($j=0; $j<(5 - $review['rating']); $j++)
		{
			echo "<span class='glyphicon glyphicon-star-empty text-purple' aria-hidden='true'></span>";
		}			
		echo "<p><a href='/index/users/" . $review['user_id'] . "'>" . $review['username'] . "</a> says: " . $review['review'] . "</p></div>";
	}
?>