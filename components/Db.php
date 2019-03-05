<?php

class Db
{

		public static function getConnection()
		{
			try {
				$paramsPath = ROOT . '/config/db_params.php';
				$params = include($paramsPath);
				$dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
				$db = new PDO($dsn, $params['user'], $params['password']);
			    // set the PDO error mode to exception
			    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    return $db;
			    }
			catch(PDOException $e)
			    {
			    echo "Connection failed: " . $e->getMessage();
			    }
		}
}

