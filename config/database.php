<?php 
    $host = $_ENV['DB_HOST'];
    $dbname = $_ENV['DB_NAME'];
    $dbuser = $_ENV['DB_USER'];
    $dbpass = $_ENV['DB_PASSWORD'];

    try {
    $bdd = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $dbuser,
        $dbpass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]
    );
} catch (PDOException $e) {
    die('Erreur BDD : ' . $e->getMessage());
}

?>