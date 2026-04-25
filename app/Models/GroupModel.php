<?php
    class GroupModel extends BaseModel {
        public function create($groupEntities){
            $req = $this->bdd->prepare("INSERT TO groupe (nom_groupe, )")
        }
    }
?>