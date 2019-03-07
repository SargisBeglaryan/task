<?php

require_once ROOT. '/models/Users.php';
require_once ROOT. '/controllers/Controller.php';

Use controllers\Controller;

class UsersController extends Controller {

	public $userModel;

	public function __construct(){
		parent::__construct();
		$this->userModel= new Users(); 
	}
	public function index($id = null){

		if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id){
			$user =  $this->userModel->getById($id);
			echo 'Hello '. $user['name'];
			echo " <a href='/".WEBSITE."/logout'>Logout</a>";
			return true;
		} else {
			return header("Location: /".WEBSITE."/login");
		}
	}

	public function showLogin(){

		if(isset($_SESSION['user_id'])) {
			return header("Location: /".WEBSITE."/".$_SESSION['user_id']);
		}
		require(ROOT . '/views/auth/login.php');
		return true;
	}
	public function login(){

		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			$user = $this->userModel->login();
			if($user){
				$_SESSION['user_id'] = $user['id'];
				return header("Location: /".WEBSITE."/".$user['id']);
			} else {
				$errors = $this->userModel->error;
			}
		}

		require(ROOT . '/views/auth/login.php');
		return true;
	}

	public function showRegister(){

		if(isset($_SESSION['user_id'])) {
			return header("Location: /".WEBSITE."/".$_SESSION['user_id']);
		}
		require(ROOT . '/views/auth/register.php');
		return true;
	}

	public function register() {
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = $this->userModel->validate($_POST);
			if(count($errors) > 0) {
				require(ROOT . '/views/auth/register.php');
				return false;
			} else {
				$user = $this->userModel->register();
				if($user){
					$_SESSION['user_id'] = $user['id'];
					return header("Location: /".WEBSITE.'/'.$user['id']);
				} else {
					$errors = $this->userModel->error;
					require(ROOT . '/views/auth/register.php');
					return false;
				}
			}
		}
	}

	public function logout(){

		unset($_SESSION['user_id']);
		return header("Location: /".WEBSITE."/login");

	}

}

