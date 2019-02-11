<?php 

class User {
  private $id;
  private $firstName;
  private $lastName;
  private $email;
  private $password;
  private $password2;
  private $passHash;
  private $activateKey;
  private $errors = [];

  public function __construct($firstName, $lastName, $email, $password, $password2) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->password2 = $password2;
        $this->passHash = password_hash($password, PASSWORD_DEFAULT);
        $this->activateKey = sha1(time());
  }

  private function validateInput() {
     
    if (!preg_match('/^[\p{Latin}]+$/u', $this->firstName)) {
        $this->errors['e_firstName'] = "Imię może składać się tylko z liter!";
    }

    if ($this->firstName == '') {
        $this->errors['e_firstName'] = "Imię nie może być puste!";
    }

    if (!preg_match('/^[\p{Latin}]+$/u', $this->lastName)) {
        $this->errors['e_lastName'] = "Nazwisko może składać się tylko z liter!";
    }

    if ($this->lastName == '') {
        $this->errors['e_lastName'] = "Nazwisko nie może być puste!";
    }

    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
        $this->errors['e_email'] = "Adres email jest nie poprawny!";
    }

    if ($this->password == '') {
        $this->errors['e_password'] = "Hasło nie może być puste!";
    }

    if ($this->password != $this->password2) {
        $this->errors['e_password'] = "Podane hasła muszą być identyczne!";
    }

    if (empty($this->errors)) {
        return true;
    } else {
        return false;
    }
  }

  public function createUser($conn) {
    $smtp = $conn->prepare("SELECT email FROM users WHERE email=:email");
    $smtp->execute(['email' => $this->email]);
    $row = $smtp->fetch();

    if ($row) {
        $this->errors['e_exist'] = "Istnieje już użytkownik o podanym adresie email!";
    }

    if ($this->validateInput() && $row == 0) {
        $stmt = $conn->prepare("INSERT INTO users VALUES (NULL, :firstName, :lastName, :email, :password, :activateString, :is_active)");

        $stmt->execute(['firstName' => $this->firstName, 
                                'lastName' => $this->lastName, 
                                'email' => $this->email, 
                                'password' => $this->passHash, 'activateString' => $this->activateKey,
                                'is_active' => 0]);
        return $this->activateKey;
        
    } else {
        return $this->errors;
    }
  }

  public function getErrors() {
      return $this->errors;
  }

  public function getActivationKey() {
    return $this->activateKey;
  }
}


 