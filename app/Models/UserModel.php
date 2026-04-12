<?php
    class UserModel {
        private $bdd;

        public function __construct($bdd) {
            $this->bdd = $bdd;
        }

        public function register(UserEntities $userEntities) {
            $stmt = $this->bdd->prepare("INSERT INTO utilisateur (nom_utilisateur, prenom_utilisateur, login_utilisateur, mail_utilisateur, pswrd_utilisateur) VALUES (:name, :surname, :login, :email, :password)");
            $stmt->bindValue(':name', $userEntities->getName(), PDO::PARAM_STR);
            $stmt->bindValue(':surname', $userEntities->getSurname(), PDO::PARAM_STR);
            $stmt->bindValue(':login', $userEntities->getLogin(), PDO::PARAM_STR);
            $stmt->bindValue(':email', $userEntities->getEmail(), PDO::PARAM_STR);
            $stmt->bindValue(':password', $userEntities->getPassword(), PDO::PARAM_STR);
            return $stmt->execute();
        }
    }
?>