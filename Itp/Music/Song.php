<?php namespace Itp\Music;

require_once __DIR__ . '/../Base/Database.php';

class Song extends \Itp\Base\Database{

	private $title;
	private $artist_id;
	private $genre_id;
	private $price;

	//sets a title instance property
	public function setTitle($title){
		$this->title = $title;
	}
	//sets an artist_id instance property
	public function setArtistId($artist_id){
		$this->artist_id = $artist_id;
	}
	//sets a genre_id instance property
	public function setGenreId($genre_id){
		$this->genre_id = $genre_id;
	}
	//sets a price
	public function setPrice($price){
		$this->price = $price;
	}
	//performs the insert
	public function save() {
			$sql = "
			  INSERT INTO songs
			  (title, genre_id, artist_id, price, added, created_at, updated_at)
			  VALUES
			  (?, ?, ?, ?, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)
			";

			$statement = static::$pdo->prepare($sql);

			$statement->bindParam(1, $this->title);
			$statement->bindParam(2, $this->genre_id);
			$statement->bindParam(3, $this->artist_id);
			$statement->bindParam(4, $this->price);
			
			$statement->execute();
	}
	//returns the song title
	public function getTitle(){
		return $this->title;
	}
	//returns the id column of this song in the database (more on this below)
	public function getId(){
		return static::$pdo->lastInsertId();
	}
}

 ?>