<?php
require_once ROOT. '/models/Users.php';
session_start();

class UsersController {

	public $userModel;

	public function __construct(){
		$this->userModel= new Users(); 
	}
	public function index($id = null){

		if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id){
			echo 'Hello '. $_SESSION['name'];
			echo "<a href='/".WEBSITE."/logout'>Logout</a>";
			return true;
		} else {
			return header("Location: /".WEBSITE."/login");
		}
	}

	public function showLogin(){
		require(ROOT . '/views/auth/login.php');
		return true;
	}
	public function login(){
		$errors;
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			$errors = $this->userModel->validate($_POST);
			if(count($errors) > 0) {
				require(ROOT . '/views/auth/register.php');
				return false;
			} else {
				$user = $this->userModel->login($_POST['loginEmail'], $_POST['loginPassword']);
				if($user){
					$_SESSION['password'] = $user['password'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['name'] = $user['name'];
					return header("Location: /".WEBSITE."/index/".$user['id']);
				} else {
					$errors = $this->userModel->error;
				}
			}
		}

		require(ROOT . '/views/auth/login.php');
		return true;
	}

	public function showRegister(){
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
					$_SESSION['email'] = $user['email'];
					$_SESSION['name'] = $user['name'];
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

		session_destroy();
		return header("Location: /".WEBSITE."/login");

	}

}

