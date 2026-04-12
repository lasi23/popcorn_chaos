<?php 
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
    require __DIR__ . '/../vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
    
    require_once __DIR__ . '/../config/database.php';
    require_once __DIR__ . '/../app/tools/sanitize.php';
    require_once __DIR__ . '/../app/tools/hydrator.php';
    
    require_once __DIR__ . '/../app/Entities/UserEntities.php';
    require_once __DIR__ . '/../app/Views/layouts/layout.php';
    require_once __DIR__ . '/../app/Controllers/UserController.php';

    $userController = new UserController($bdd);
    $userController->register();

?>