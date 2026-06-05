<?php

    class FilmController extends BaseModel{

        public function newFilm() {
            if(isset($_POST['sendFilm'])){
                if(!empty($_POST['idGroup']) && !empty($_POST['nameFilm']) && !empty($_SESSION['idUser'])){
                    $sendFilm = new FilmModel($this->bdd);
                    $filmEntities = new FilmEntities;
                    $_POST['idUser'] = intval($_SESSION['idUser']);
                    Hydrator::hydrate($filmEntities, $_POST);
                    $result = $sendFilm->sendFilm($filmEntities);
                    if($result !== true) {
                        $_SESSION['messageFilm'] = $result; 
                    }
                    $_SESSION['openPanel'] = 'film';
                    header('Location: profil');
                    exit;
                } else {
                    $_SESSION['openPanel'] = 'film';
                    $_SESSION['messageFilm'] = 'Veuillez remplir tous les champs';
                    header('Location: profil');
                    exit;
                }
            }
            return null;
        }


        public function searchAutocomplete() {
            header('Content-Type: application/json; charset=utf-8');

            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
            $dotenv->load();

            $apiKey = $_ENV['TMDB_API_KEY'] ?? null;
            $query = $_GET['q'] ?? '';

            if (!$apiKey || strlen(trim($query)) < 2) {
                echo json_encode(['results' => []]);
                exit;
            }

            // 4. Appel à l'API TMDB
            $url = "https://api.themoviedb.org/3/search/movie?api_key={$apiKey}&query=" . urlencode($query) . "&language=fr-FR";
            $response = @file_get_contents($url);

            if ($response === false) {
                echo json_encode(['results' => [], 'error' => 'Impossible de joindre TMDB']);
            } else {
                echo $response;
            }
            exit;
        }
    }

?>