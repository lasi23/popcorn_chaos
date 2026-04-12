<?php session_start();
    require 'vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    
    require __DIR__ . '/../app/Views/layouts/layout.php';
?>