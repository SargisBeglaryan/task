<?php
class Users {

	public $error = [];

	public  function login($email, $password) {
		$email = $this->emailValidate($email);
		$password = $this->passwordValidate($password);
		if($email && $password) {
			$hashPassword = md5($password);
			$db = Db::getConnection();
			$query = $db->prepare("SELECT id, surname, name, email FROM users WHERE email = :email AND password = :password");
		    $query->bindParam(':email', $email);
		    $query->bindParam(':password', $hashPassword);
		    $query->setFetchMode(PDO::FETCH_ASSOC);
		    $query->execute();
		    if($query->rowCount()){
		    	$user = $query->fetch();
		    	$user['password'] = $password;
		    	return $user;
		    } else {
		    	$this->error['user'] = "User not found";
		    	return false;
		    }
		} else {
			return false;
		}
	}

	public function signIn(){
		$email = $this->emailValidate($_POST['signInEmail']);
		$password = $this->passwordValidate($_POST['signInPassword']);
		$name = $this->nameValidate($_POST['name'], 'name');
		$surname = $this->nameValidate($_POST['surname'], 'surname');
		if(isset($_FILES['image']) && $_FILES['image']['error'] != 4){
			$image = $this->imageValidate($_FILES['image']);
		} else {
			$image = false;
			$this->error['image'] = "You dont opload image";
		}
		if($email && $password && $name && $surname && $image){
			$hashPassword = md5($password);
			$db = Db::getConnection();
			$query = $db->prepare("INSERT INTO users (name, surname, email, password, image) 
				VALUES (:name, :surname, :email, :password, :image)");
		    $query->bindParam(':name', $name);
		    $query->bindParam(':surname', $surname);
		    $query->bindParam(':email', $email);
		    $query->bindParam(':password', $hashPassword);
		    $query->bindParam(':image', $image);
		    $query->setFetchMode(PDO::FETCH_ASSOC);
		    $query->execute();
		    if($query->rowCount()){
		    	return $this->login($email, $password);
		    } else {
		    	$this->deleteImage($image);
		    	$this->error['userAdded'] = "Error! User not added";
		    	return false;
		    }
		} else {
			$this->deleteImage($image);
			return false;
		}
	}
	private function nameValidate($name, $input){
		$name = $this->stringFilter($name);
		if($name == ''){
			$this->error[$input] = 'Field is empty';
			return false;
		}elseif(strlen($name) < 3){
			$this->error[$input] = 'Field must have minimum 3 symboles';
			return false;
		}
	    return $name;
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
		return $email;
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
	    return $password;
	}

	private function stringFilter($string) {
		$string = htmlspecialchars($string);
		$string = trim($string);
		$string = filter_var($string, FILTER_SANITIZE_STRING);
		return $string;
	}

	private function imageValidate($data){
       $format = pathinfo($data['name']);
       $imageFormat = array('png', 'jpg', 'PNG', 'JPG', 'JPEG', 'jpeg');
       if(isset($format['extension']) &&  !in_array($format["extension"], $imageFormat)){
	       	$this->error['image'] = "Image format is wrong";
	        return false;
       }
       elseif ($data["size"] > 500000) {
		    $this->error['image'] = "Sorry, your images size large than 5mb";
		    return false;
		} else {
          if(move_uploaded_file($data["tmp_name"], ROOT .'/images/'.$data['name'])) { 
            	return '/images/'.$data['name'];
	       } else {
	        	return false;
	       }
       }
       
    }

    private function deleteImage($image){
    	if($image != false){
    		unlink(ROOT.$image);
    	}
    }

}


	
	