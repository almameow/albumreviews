<ul class="no_decoration">
<?php  
	foreach($reviews as $review)
	{
		echo "<li><a href='/albums/show_album/" . $review['album_id'] . "'>" . $review['title'] . "</a> - " . $review['artist'] . "</li>";
	}

?>
</ul>