<?php

    class FilmController extends BaseModel{

        public function newFilm() {
            if(isset($_POST['sendFilm'])){
                if(!empty($_POST['groupe']) && !empty($_POST['film'])){
                    $sendFilm = new FilmModel($this->bdd);
                    $filmEntities = new FilmEntities;
                    Hydrator::hydrate($filmEntities, $_POST);
                    $sendFilm->sendFilm($filmEntities);
                }
            }
        }

    }

?>