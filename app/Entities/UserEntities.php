<?php
class UserEntities {
    private $idUser;
    private $nameUser;
    private $surnameUser;
    private $loginUser;
    private $emailUser;
    private $passwordUser;


   

    /**
     * Get the value of idUser
     */
    public function getIdUser() {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     */
    public function setIdUser($idUser): self {
        $this->idUser = $idUser;
        return $this;
    }

    /**
     * Get the value of nameUser
     */
    public function getNameUser() {
        return $this->nameUser;
    }

    /**
     * Set the value of nameUser
     */
    public function setNameUser($nameUser): self {
        $this->nameUser = $nameUser;
        return $this;
    }

    /**
     * Get the value of surnameUser
     */
    public function getSurnameUser() {
        return $this->surnameUser;
    }

    /**
     * Set the value of surnameUser
     */
    public function setSurnameUser($surnameUser): self {
        $this->surnameUser = $surnameUser;
        return $this;
    }

    /**
     * Get the value of loginUser
     */
    public function getLoginUser() {
        return $this->loginUser;
    }

    /**
     * Set the value of loginUser
     */
    public function setLoginUser($loginUser): self {
        $this->loginUser = $loginUser;
        return $this;
    }

    /**
     * Get the value of emailUser
     */
    public function getEmailUser() {
        return $this->emailUser;
    }

    /**
     * Set the value of emailUser
     */
    public function setEmailUser($emailUser): self {
        $this->emailUser = $emailUser;
        return $this;
    }

    /**
     * Get the value of passwordUser
     */
    public function getPasswordUser() {
        return $this->passwordUser;
    }

    /**
     * Set the value of passwordUser
     */
    public function setPasswordUser($passwordUser): self {
        $this->passwordUser = $passwordUser;
        return $this;
    }
}
?>