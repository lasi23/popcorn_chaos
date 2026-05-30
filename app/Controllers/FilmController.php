<?php

    class FilmController extends BaseModel{

        public function newFilm() {
            if(isset($_POST['sendFilm'])){

                if(!empty($_POST['idGroup']) && !empty($_POST['nameFilm']) && !empty($_SESSION['idUser'])){
                    $sendFilm = new FilmModel($this->bdd);
                    $filmEntities = new FilmEntities;
                    $_POST['idUser'] = intval($_SESSION['idUser']);
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