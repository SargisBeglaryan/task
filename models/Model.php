<?php

namespace models;

class Model {

	public function __construct() {

		if($_SERVER['REQUEST_METHOD'] == 'POST') {

			if(!isset($_SESSION['_token'])) {
				throw new \Exception("Invalid token!");
			}

			$token = $_SESSION['_token'];

			if(!isset($_POST['_token']) || $_POST['_token'] != $token) {
				throw new \Exception("Invalid token!");
			}
		}
	}

	public function getById($id) {

		$table = strtolower(get_class($this));
		$db = \Db::getConnection();
		$query = $db->prepare("SELECT * FROM $table WHERE id = :id");
		$query->bindParam(':id', $id);
		$query->setFetchMode(\PDO::FETCH_ASSOC);
		$query->execute();
		if($query->rowCount()){
			$user = $query->fetch();
			return $user;
		} else {
			return null;
		}
	}
}