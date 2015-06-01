<?php 
	foreach($reviews as $review)
	{
		$date = date_create($review['created_at']);
?>
		<div class="col-md-11 col-md-offset-1 border_top">
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
			echo "<p><a href='/index/users/" . $review['user_id'] . "'>" . $review['username'] . "</a> says: " . $review['review'] . "</p>";
			echo "<p class='inline'><i>Posted on " . date_format($date, "F j, Y") . "</i></p>";
			if($review['user_id'] == $this->session->userdata("current_user"))
			{
				echo "<p class='inline col-md-offset-6'><a href='/albums/delete_review/" . $this->session->userdata("current_album_id") . "'>Delete this review</a></p>";
			}
?>
		</div>
<?php
	}
 ?>