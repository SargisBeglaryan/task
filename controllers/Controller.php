<?php

namespace controllers;
session_start();

class Controller {
 
	protected $_token;

	public function __construct(){
		$this->checkActivity();
		if(!isset($_SESSION['_token'])) {
			$token = openssl_random_pseudo_bytes(16);
			$token = bin2hex($token);
			$this->_token = $token;
			$_SESSION['_token'] = $token;
		}

		$this->_token = $_SESSION['_token'];
	}

	protected function checkActivity() {

		if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
		    session_unset();
		    session_destroy();
		}
		$_SESSION['LAST_ACTIVITY'] = time();
	}

	public function getToken() {
		echo "<input type='hidden' name='_token' value='$this->_token'>";
	}
    
}
