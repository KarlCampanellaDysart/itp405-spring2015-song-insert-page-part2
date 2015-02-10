<?php namespace Itp\Music;

require_once __DIR__ . '/../Base/Database.php';

class ArtistQuery extends \Itp\Base\Database{

	public function __construct(){
		parent::__construct();
		session_start();
	}
	
	public function getAll(){

		$sql = "
		  SELECT * 
		  FROM artists
		  ORDER BY artist_name ASC
		";

		$statement = static::$pdo->prepare($sql);
		$statement->execute();
		$artists = $statement->fetchAll(\PDO::FETCH_OBJ);

		return $artists;
	}
}


 ?>