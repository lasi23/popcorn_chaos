<?php
    class UserModel {
        private $bdd;

        public function __construct($bdd) {
            $this->bdd = $bdd;
        }
// ----------------------------------------inscription-----------------------------
        public function register(UserEntities $userEntities) {
            try {
                $req = $this->bdd->prepare("INSERT INTO utilisateur (nom_utilisateur, prenom_utilisateur, login_utilisateur, mail_utilisateur, pswrd_utilisateur) VALUES (:name, :surname, :login, :email, :password)");
                $req->bindValue(':name', $userEntities->getName(), PDO::PARAM_STR);
                $req->bindValue(':surname', $userEntities->getSurname(), PDO::PARAM_STR);
                $req->bindValue(':login', $userEntities->getLogin(), PDO::PARAM_STR);
                $req->bindValue(':email', $userEntities->getEmail(), PDO::PARAM_STR);
                $req->bindValue(':password', $userEntities->getPassword(), PDO::PARAM_STR);
                $req->execute();
                return true;
            } catch (PDOException $e) {
                return false;
            }          
        }
        public function emailExists($email) {
            $req = $this->bdd->prepare("SELECT COUNT(*) FROM utilisateur WHERE mail_utilisateur = :email");
            $req->bindValue(':email', $email, PDO::PARAM_STR);
            $req->execute();
            return $req->fetchColumn() > 0;
        }

        public function loginExist($login){
            $req = $this->bdd->prepare("SELECT count(*) FROM utilisateur where login_utilisateur = :login");
            $req->bindValue(':login', $login, PDO::PARAM_STR);
            $req->execute();
            return $req->fetchColumn() > 0;
        }

// ---------------------------------------connection-------------------------------
        
    }
?>