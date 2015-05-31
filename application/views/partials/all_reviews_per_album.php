<?php 
	foreach($reviews as $review)
	{
		$date = date_create($review['created_at']);
?>
		<div class="row col-md-offset-1 border_top">
			<p class="inline">Rating:</p>
<?php
			for($i=0; $i<$review['rating']; $i++)
			{
				echo "<span class='glyphicon glyphicon-star text-purple' aria-hidden='true'></span>";
			}
			for($j=0; $j<(5 - $review['rating']); $j++)
			{
				echo "<span class='glyphicon glyphicon-star-empty text-purple' aria-hidden='true'></span>";
			}			
			echo "<p><a href='#'>" . $review['username'] . "</a> says: " . $review['review'] . "</p>";
			echo "<p><i>Posted on " . date_format($date, "F j, Y") . "</i></p></div>";
			// if($review['user_id'] == $this->session->username("current_user"))
			// {
			// 	echo "<a class='col-md-offset-9' href='#'>Delete this review</a>";
			// }
	}
 ?>