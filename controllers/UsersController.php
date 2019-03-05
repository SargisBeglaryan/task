<?php
require_once ROOT. '/models/Users.php';
session_start();

class UsersController {

	public $userModel;

	public function __construct(){
		$this->userModel= new Users(); 
	}
	public function index($id = null){
		if(isset($_SESSION['password']) && isset($_SESSION['email'])){
			echo 'Hello '. $_SESSION['name'];
			echo "<a href='".WEBSITE."/users/logout'>Logout</a>";
			return true;
		} else {
			return header("Location: ".WEBSITE."/users/login");
		}
	}

	public function login(){
		$errors;
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
			if(isset($_POST['login'])) {
				$user = $this->userModel->login($_POST['loginEmail'], $_POST['loginPassword']);
				if($user){
					session_start();
					$_SESSION['password'] = $user['password'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['name'] = $user['name'];
					return header("Location: ".WEBSITE."/users/index/".$user['id']);
				} else {
					$errors = $this->userModel->error;
				}
			} else if(isset($_POST['signIn'])){
				$user = $this->userModel->signIn();

				if($user){
					session_start();
					$_SESSION['password'] = $user['password'];
					$_SESSION['email'] = $user['email'];
					$_SESSION['name'] = $user['name'];
?>
					<!-- <script>localStorage.setItem("name", $users['name']);</script> -->
<?php
					return header("Location: ".WEBSITE.'/'.$user['id']);
				} else {
					$errors = $this->userModel->error;
				}
			}
		}

		require_once(ROOT . '/views/users/login.php');
		return true;
	}

	public function actionLogout(){
		unset($_SESSION['password']);
		unset($_SESSION['email']);
		unset($_SESSION['name']);
		return header("Location: ".WEBSITE."/users/login");

	}

}

