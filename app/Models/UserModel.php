<?php
    class UserModel extends BaseModel{
        
// ----------------------------------------inscription-----------------------------
        public function register($userEntities) {
            try {
                $req = $this->bdd->prepare("INSERT INTO utilisateur (nom_utilisateur, prenom_utilisateur, login_utilisateur, mail_utilisateur, pswrd_utilisateur) VALUES (:name, :surname, :login, :email, :password)");
                $req->bindValue(':name', $userEntities->getNameUser(), PDO::PARAM_STR);
                $req->bindValue(':surname', $userEntities->getSurnameUser(), PDO::PARAM_STR);
                $req->bindValue(':login', $userEntities->getLoginUser(), PDO::PARAM_STR);
                $req->bindValue(':email', $userEntities->getEmailUser(), PDO::PARAM_STR);
                $req->bindValue(':password', $userEntities->getPasswordUser(), PDO::PARAM_STR);
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
        public function connect($login) {
            try {
                $req = $this->bdd->prepare("SELECT id_utilisateur AS idUser, login_utilisateur AS loginUser, pswrd_utilisateur AS passwordUser, nom_utilisateur AS nameUser, prenom_utilisateur AS surnameUser, mail_utilisateur AS emailUser FROM utilisateur WHERE login_utilisateur = :login");
                $req->bindValue(':login', $login, PDO::PARAM_STR);
                $req->execute();
                $data = $req->fetch(PDO::FETCH_ASSOC);
                
                if ($data) {
                    $userEntities = new UserEntities;
                    Hydrator::hydrate($userEntities, $data);
                    return $userEntities; // ← on retourne l'objet
                }
                return false;
            } catch (PDOException $e) {
                return false;
            }
        }
    }
?>