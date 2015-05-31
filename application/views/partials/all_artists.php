<select class="form-control least_width" name="artist" id="artist artist1">
	<option value=""></option>
<?php 
	foreach($artists as $artist)
	{
		echo "<option value='" . $artist['artist'] . "'>" . $artist['artist'] . "</option>";
	}
 ?>
</select>