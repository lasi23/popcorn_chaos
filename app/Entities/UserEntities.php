<?php
class UserEntities {
    private $id;
    private $name;
    private $surname;
    private $login;
    private $email;
    private $password;


    // Getters and setters for each property

    /**
     * Get the value of id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set the value of name
     */
    public function setName($name): self {
        $this->name = $name;
        return $this;
    }

    /**
     * Get the value of surname
     */
    public function getSurname() {
        return $this->surname;
    }

    /**
     * Set the value of surname
     */
    public function setSurname($surname): self {
        $this->surname = $surname;
        return $this;
    }

    /**
     * Get the value of login
     */
    public function getLogin() {
        return $this->login;
    }

    /**
     * Set the value of login
     */
    public function setLogin($login): self {
        $this->login = $login;
        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set the value of email
     */
    public function setEmail($email): self {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set the value of password
     */
    public function setPassword($password): self {
        $this->password = $password;
        return $this;
    }
}
?>