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
            $code = $this->generateUniqueCode();
            $req = $this->bdd->prepare("INSERT INTO groupe (nom_groupe, invitation_code, id_createur) VALUES (:namegrp, :code, :idCreator)");
            $req->bindValue(':namegrp', $groupEntities->getName(), PDO::PARAM_STR);
            $req->bindValue(':code', $code, PDO::PARAM_STR);
            $req->bindvalue(':idCreator', $groupEntities->getIdCreator(), PDO::PARAM_STR);
            $req->execute();
            return true;
        }
    }
?>