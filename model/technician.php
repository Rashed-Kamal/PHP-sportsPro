<?php
class Technician {
    private $techID, $firstName, $lastName, $fullName, $email, $phone, $password;

    public function __construct($techID,$firstName, $lastName, $email, $phone, $password) {
        $this->techID = $techID;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($value) {
        $this->firstName = $value;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($value) {
        $this->lastName = $value;
    }

    
    public function getTechID() {
        return $this->techID;
    }

    public function setTechID($value) {
        $this->techID = $value;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($value) {
        $this->email = $value;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function setPhone($value) {
        $this->phone = $value;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($value) {
        $this->password = $value;
    }

    public  function getFullName() {
        return $this->fullName = $this->firstName." ".$this->lastName;
        
    }

}
?>