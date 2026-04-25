<?php 
    session_start();
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    require __DIR__ . '/../vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
    
    require_once __DIR__ . '/../config/database.php';
    require_once __DIR__ . '/../app/tools/sanitize.php';
    require_once __DIR__ . '/../app/tools/hydrator.php';
    
    require_once __DIR__ . '/../app/Entities/UserEntities.php';
    require_once __DIR__ . '/../app/Controllers/UserController.php';

// *********************inscription*********************  
    $userInscription = new UserController($bdd);    
    $messageInscription = $userInscription->register();
    
    // ***********************Connection***********************
    $userConnection = new UserController($bdd);
    $messageConnection = $userConnection->connection();

    // ***************************creation groupe***********************
    $createGroup = new GroupController($bdd);
    $messagecreationGroup = $createGroup->create();

    
    // **************affichage des pages***********
    
    $routes = require '../config/routes.php';
    $page = $_GET['page'] ?? 'connection';
    
    if ($page === '') {
        $page = 'connection';
        }
        
        if (isset($routes[$page])) {
            $content = $routes[$page]['view'];
            $cssPage = $routes[$page]['css'];
            } 
            // else {
            //     $content = '../app/Views/404.php';
            //     $title   = 'Erreur 404';
            //     $cssPage = null;
            //     }
    // **************************layout******************
    require_once __DIR__ . '/../app/Views/layouts/layout.php';
?>