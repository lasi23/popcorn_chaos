<?php

    class FilmModel extends BaseModel{
        public function sendFilm($filmEntities){
            $req = $this->bdd->prepare("INSERT INTO film (nom_film, id_groupe) VALUES (:nameFilm, :idGroup)"); // ) manquante
            $req->bindValue(':nameFilm', $filmEntities->getNameFilm(), PDO::PARAM_STR);
            $req->bindValue(':idGroup', $filmEntities->getIdGroup(), PDO::PARAM_INT); // : manquant
            $req->execute();
            return true;
        }
    }

?>