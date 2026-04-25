<?php
    class UserModel extends BaseModel{
        
// ----------------------------------------inscription-----------------------------
        public function register($userEntities) {
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
        public function connect($login) {
            try {
                $stmt = $this->bdd->prepare("SELECT id_utilisateur AS id, login_utilisateur AS login, pswrd_utilisateur AS password, nom_utilisateur AS name, prenom_utilisateur AS surname, mail_utilisateur AS email FROM utilisateur WHERE login_utilisateur = :login");
                $stmt->bindValue(':login', $login, PDO::PARAM_STR);
                $stmt->execute();
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                
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