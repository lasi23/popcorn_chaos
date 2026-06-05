<?php

    class FilmModel extends BaseModel{
        public function sendFilm($filmEntities){

            $req1 = $this->bdd->prepare("SELECT id_film FROM film WHERE nom_film = ?");
            $req1->execute([$filmEntities->getNameFilm()]);
            $result = $req1->fetch();
            if($result){
                return "Le film a déjà été enregistré";
            }

            $req2 = $this->bdd->prepare("INSERT INTO film (nom_film, id_groupe, id_utilisateur) VALUES (?, ?, ?)"); 
            $req2->bindValue(1, $filmEntities->getNameFilm(), PDO::PARAM_STR);
            $req2->bindValue(2, $filmEntities->getIdGroup(), PDO::PARAM_INT); 
            $req2->bindValue(3, $filmEntities->getIdUser(), PDO::PARAM_INT); 
            $req2->execute();
            return true;
        }
    }

?>