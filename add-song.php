<?php 
require_once __DIR__ . '/vendor/autoload.php'; 

use Symfony\Component\HttpFoundation\Session\Session;
$session = new \Symfony\Component\HttpFoundation\Session\Session();
$session->start();

$artistQuery = new Itp\Music\ArtistQuery(); 
$artists = $artistQuery->getAll();

$genreQuery = new Itp\Music\GenreQuery(); 
$genres = $genreQuery->getAll();

if (isset($_POST['submit'])) {
	$title = $_POST['title'];
	$artist = $_POST['artist'];
	$genre = $_POST['genre'];
	$price = $_POST['price'];
		
	$song = new Itp\Music\Song();

	if($title !="" && $price!=""){
		$song->setTitle($title);
		$song->setArtistId($artist);
		$song->setGenreId($genre);
		$song->setPrice($price);
		$song->save();

		$status = 'The song ' . $song->getTitle() . ' with an ID of ' . $song->getId() . ' was inserted successfully!';
		$session->getFlashBag()->add('success', $status);
		header('Location: add-song.php');
		exit; 		
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Insert Song</title>
	<link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
	<div class="jumbotron">
		<div class="container"><h2>Insert A Song</h2></div>		
	</div>
	<div class-"container">
	<div class="panel panel-default">
		<div class="panel-body">
		<form method="post">
			<div class="form-group">
				<label>Title: </label>
				<input type="text" name="title">
			</div>
			<div class="form-group">
				<label>Artist: </label>
				<select name="artist">				
				<?php foreach($artists as $artistObj) : ?>
					<option value="<?php echo $artistObj->id ?>"><?php echo $artistObj->artist_name ?></option>
				<?php endforeach; ?>
				</select>
			</div>
			<div class="form-group">
				<label>Genre: </label>
				<select name="genre">				
				<?php foreach($genres as $genreObj) : ?>
					<option value="<?php echo $genreObj->id ?>"><?php echo $genreObj->genre ?></option>
				<?php endforeach; ?>
				</select>
			</div>			
			<div class="form-group">
				<label>Price: </label>
				<input type="text" name="price">
			</div>			
			<input type="submit" name="submit" class="btn btn-default" value="Submit">
		</form>		
		</div>
		<?php foreach ($session->getFlashBag()->get('success') as $message) : ?>
			<div class="panel-footer"><p><?php echo $message ?></p></div>
		<?php endforeach; ?> 
	</div>
	</div>
</body>
</html>

