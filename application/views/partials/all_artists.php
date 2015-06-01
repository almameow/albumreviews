<select class="form-control" name="artist1" id="artist">
	<option value=""></option>
<?php 
	foreach($artists as $artist)
	{
		echo "<option value='" . $artist['artist'] . "'>" . $artist['artist'] . "</option>";
	}
 ?>
</select>