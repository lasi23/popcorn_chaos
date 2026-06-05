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
            
            $req = $this->bdd->prepare("INSERT INTO groupe (nom_groupe, invitation_code, id_createur) VALUES (?, ?, ?)");
            $req->bindValue(1, $groupEntities->getNameGroup(), PDO::PARAM_STR);
            $req->bindValue(2, $code, PDO::PARAM_STR);
            $req->bindValue(3, $groupEntities->getIdCreator(), PDO::PARAM_STR);
            $req->execute();
            
            $idGroupe = $this->bdd->lastInsertId();
            
            $req2 = $this->bdd->prepare("INSERT INTO groupe_utilisateur (id_groupe, id_utilisateur) VALUES (?, ?)");
            $req2->bindValue(1, $idGroupe, PDO::PARAM_INT);
            $req2->bindValue(2, $groupEntities->getIdCreator(), PDO::PARAM_INT);
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

        public function getCodeGroup($idGroup){
            $sql = "
                SELECT invitation_code AS codeGroup from groupe where id_groupe = :idGroup";
            $req = $this->bdd->prepare($sql);
            $req->bindValue(':idGroup', $idGroup->getIdGroup(), PDO::PARAM_INT);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            return $data ? $data['codeGroup'] : 'Code introuvable'; 
        }

        public function joinGroup($code, $idUser){
            $sql = "INSERT ignore INTO groupe_utilisateur (id_groupe, id_utilisateur, importance)
                    SELECT id_groupe, ?, NULL
                    FROM groupe
                    WHERE invitation_code = ?";
            
            $req = $this->bdd->prepare($sql);
            $req->bindValue(1, $idUser, PDO::PARAM_INT);
            $req->bindValue(2, $code, PDO::PARAM_STR);
            $req->execute();
            
            return $req->rowCount() > 0 
                ? 'Vous avez rejoint le groupe !' 
                : 'Code rejeté. Vous avez été trahi avant même de commencer.';
        }

        public function takeHat($group){
            try {
                $this->bdd->beginTransaction();

                // 1. Tirer un utilisateur aléatoire du groupe
                $sql1 = "SELECT id_utilisateur FROM groupe_utilisateur WHERE id_groupe = ? ORDER BY RAND() LIMIT 1";
                $req1 = $this->bdd->prepare($sql1);
                $req1->bindValue(1, $group, PDO::PARAM_INT);
                $req1->execute();
                $user = $req1->fetch();
                if(!$user) return [];
                
                // 2. Tirer un film aléatoire de cet utilisateur pas encore tiré
                $sql2 = "SELECT f.id_film, f.nom_film as nameFilm
                        FROM film f
                        INNER JOIN groupe_utilisateur gu ON f.id_groupe = gu.id_groupe
                        WHERE f.deja_tire = FALSE 
                        AND gu.id_utilisateur = ?
                        AND f.id_groupe = ?
                        ORDER BY RAND() 
                        LIMIT 1";
                $req2 = $this->bdd->prepare($sql2);
                $req2->execute([$user['id_utilisateur'], $group]);
                $film = $req2->fetch();
                if(!$film) return [];

                // 3. Marquer le film comme tiré
                $sql3 = "UPDATE film SET deja_tire = TRUE WHERE id_film = ?";
                $req3 = $this->bdd->prepare($sql3);
                $req3->execute([$film['id_film']]);

                $this->bdd->commit();
                return $film;
            } catch(Exception $e) {
                $this->bdd->rollBack();
                return false;
            }
        }
    }
?>