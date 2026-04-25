<?php
    class GroupModel extends BaseModel {

        private function generateUniqueCode() {
            do {
                $code = '';
                $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                for ($i = 0; $i < 6; $i++) {
                    $code .= $chars[random_int(0, strlen($chars) - 1)];
                }
                $req = $this->bdd->prepare("SELECT id_groupe FROM groupe WHERE invitation_code = ?");
                $req->execute([$code]);
                $existe = $req->fetch();
            } while ($existe);

            return $code;
        }

        public function create($groupEntities) {
            // Vérifier si le nom existe déjà
            $check = $this->bdd->prepare("SELECT id_groupe FROM groupe WHERE nom_groupe = :name");
            $check->execute(['name' => $groupEntities->getNameGroup()]);
            if($check->fetch()) {
                return false; // nom déjà pris
            }

            $code = $this->generateUniqueCode(); 
            
            $req = $this->bdd->prepare("INSERT INTO groupe (nom_groupe, invitation_code, id_createur) VALUES (:namegrp, :code, :idCreator)");
            $req->bindValue(':namegrp', $groupEntities->getNameGroup(), PDO::PARAM_STR);
            $req->bindValue(':code', $code, PDO::PARAM_STR);
            $req->bindValue(':idCreator', $groupEntities->getIdCreator(), PDO::PARAM_STR);
            $req->execute();
            
            $idGroupe = $this->bdd->lastInsertId();
            
            $req2 = $this->bdd->prepare("INSERT INTO groupe_utilisateur (id_groupe, id_utilisateur) VALUES (:idGroupe, :idUtilisateur)");
            $req2->bindValue(':idGroupe', $idGroupe, PDO::PARAM_INT);
            $req2->bindValue(':idUtilisateur', $groupEntities->getIdCreator(), PDO::PARAM_INT);
            $req2->execute();
            
            return true;
        }

        public function getGroups($userId) {
            $sql = "
                SELECT groupe.id_groupe AS idGroup, groupe.nom_groupe AS nameGroup
                FROM groupe
                INNER JOIN groupe_utilisateur ON groupe_utilisateur.id_groupe = groupe.id_groupe
                WHERE groupe_utilisateur.id_utilisateur = :user_id
                ORDER BY groupe.nom_groupe ASC
            ";

            $req = $this->bdd->prepare($sql);
            $req->execute(['user_id' => $userId]);
            return $req->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>