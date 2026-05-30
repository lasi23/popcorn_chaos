<?php

    class FilmModel extends BaseModel{
        public function sendFilm($filmEntities){
            $req = $this->bdd->prepare("INSERT INTO film (nom_film, id_groupe, id_utilisateur) VALUES (?, ?, ?)"); 
            $req->bindValue(1, $filmEntities->getNameFilm(), PDO::PARAM_STR);
            $req->bindValue(2, $filmEntities->getIdGroup(), PDO::PARAM_INT); 
            $req->bindValue(3, $filmEntities->getIdUser(), PDO::PARAM_INT); 
            $req->execute();
            return true;
        }
    }

?>