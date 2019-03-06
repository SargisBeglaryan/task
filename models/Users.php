<?php
class Users {

	public $error = [];
	protected $name;
	protected $surname;
	protected $email;
	protected $password;

	public  function login($email, $password) {

		if($this->email && $this->password) {

			$db = Db::getConnection();
			$query = $db->prepare("SELECT id, surname, name, email FROM users WHERE email = :email AND password = :password");
		    $query->bindParam(':email', $email);
		    $query->setFetchMode(PDO::FETCH_ASSOC);
		    $query->execute();
		    if($query->rowCount()){
		    	$user = $query->fetch();
				// if(password_verify($password, $b))
		    	return $user;
		    } else {
		    	$this->error['user'] = "User not found";
		    	return false;
		    }
		} else {
			return false;
		}
	}

	public function register(){

		if($this->email && $this->password && $this->name && $this->surname){
			$hashPassword = password_hash($this->password, PASSWORD_DEFAULT);
			$db = Db::getConnection();
			$query = $db->prepare("INSERT INTO users (name, surname, email, password)
				VALUES (:name, :surname, :email, :password)");
		    $query->bindParam(':name', $this->name);
		    $query->bindParam(':surname', $this->surname);
		    $query->bindParam(':email', $this->email);
		    $query->bindParam(':password', $hashPassword);
		    $query->setFetchMode(PDO::FETCH_ASSOC);
		    $query->execute();
		    if($query->rowCount()){
				$id = $db->lastInsertId();
				return [
					'id'=> $id,
					'name'=>$this->name,
					'surname'=>$this->surname,
					'email'=>$this->email
				];
		    } else {
		    	$this->error['userAdded'] = "Error! User not added";
		    	return false;
		    }
		} else {
			return false;
		}
	}

	public function validate($request) {
		foreach($request as $key=>$value) {
			if($key == 'name' || $key == 'surname') {
				$this->nameValidate($value, $key);
			}
			if(strpos(strtolower($key), 'email') !== false) {
			    $this->emailValidate($value);
			}
			if(strpos(strtolower($key), 'password') !== false) {
			    $this->passwordValidate($value);
			}
		}
		return $this->error;
	}
	private function nameValidate($name, $input){
		$name = $this->stringFilter($name);
		if($name == ''){
			$this->error[$input] = ucfirst($input).' is empty';
			return false;
		}elseif(strlen($name) < 3){
			$this->error[$input] = ucfirst($input). ' must have minimum 3 symboles';
			return false;
		}
		$this->{$input} = $name;
	    return true;
	}

	private function emailValidate($email) {
		$email = htmlspecialchars($email);
		$email = trim($email);
		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if($email == ''){
			$this->error['email'] = 'Email field is empty';
			return false;
		}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		    $this->error['email'] = 'Email format is wrong';
			return false;
		}
		$this->email = $email;
		return true;
	}

	private function passwordValidate($password) {

		$password = $this->stringFilter($password);
		if($password == ''){
			$this->error['password'] = 'Password field is empty';
			return false;
		}elseif(strlen($password) < 4){
			$this->error['password'] = 'Password must have minimum 4 symboles';
			return false;
		}elseif(!preg_match("#[0-9]+#",$password)) {
	        $this->error['password'] = "Your Password Must Contain At Least 1 Number!";
	        return false;
	    }
	    elseif(!preg_match("#[A-Z]+#",$password)) {
	        $this->error['password'] = "Your Password Must Contain At Least 1 Capital Letter!";
	        return false;
	    }
	    elseif(!preg_match("#[a-z]+#",$password)) {
	        $this->error['password'] = "Your Password Must Contain At Least 1 Lowercase Letter!";
	        return false;
	    }
	    $this->password = $password;
		return true;
	}

	private function stringFilter($string) {
		$string = htmlspecialchars($string);
		$string = trim($string);
		$string = filter_var($string, FILTER_SANITIZE_STRING);
		return $string;
	}

}


	
	