<?php namespace Itp\Music;

require_once __DIR__ . '/../Base/Database.php';

class GenreQuery extends \Itp\Base\Database{

	public function __construct(){
		parent::__construct();
		session_start();
	}
	
	public function getAll(){

		$sql = "
		  SELECT *
		  FROM genres
		  ORDER BY genre ASC
		";

		$statement = static::$pdo->prepare($sql);
		$statement->execute();
		$genres = $statement->fetchAll(\PDO::FETCH_OBJ);

		return $genres;
	}
}

 ?>