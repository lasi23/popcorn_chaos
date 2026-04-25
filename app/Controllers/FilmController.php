<?php

    class FilmController extends BaseModel{

        public function newFilm() {
            if(isset($_POST['sendFilm'])){

        var_dump($_POST);
                if(!empty($_POST['idGroup']) && !empty($_POST['nameFilm'])){
                    $sendFilm = new FilmModel($this->bdd);
                    $filmEntities = new FilmEntities;
                    Hydrator::hydrate($filmEntities, $_POST);
                    $sendFilm->sendFilm($filmEntities);
                    header('Location: profil');
                    exit;
                }else{
                    return 'Veuillez remplir tous les champs';
                }
            }
        }

    }

?>