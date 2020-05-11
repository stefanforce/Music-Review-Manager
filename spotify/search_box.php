<?php include('spotify_search.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Spotify Search</title>
</head>
<body>
 <h2>Search</h2>
<br>
<form method="post" action="spotify_search.php">
	<label for="search_type">Artist/Album/Track</label>
	<select name="search_type" id="search_type">
		<option value="artist">Artist</option>
		<option value="album">Album</option>
		<option value="track">Track</option>
	</select>
	<br>
  	<div class="input-group">
  	  <label>Query</label>
  	  <input type="text" name="query" pattern="[A-Za-z0-9._- ]{1,64}" title="Maximum 64 alphanumerics or (. / _ / -)">
  	</div>
	<br>
	<div class="input-group">
  	  <button type="submit" class="btn" name="spotify_search">Search</button>
  	</div>
</form>
</body>
</html>