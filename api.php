<?php
require_once 'vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$apiKey = $_ENV['TMDB_API_KEY'] ?? null;

$query = $_GET['q'] ?? '';

header('Content-Type: application/json');

if (!$apiKey || strlen(trim($query)) < 2) {
    echo json_encode(['results' => []]);
    exit;
}

$url = "https://api.themoviedb.org/3/search/movie?api_key={$apiKey}&query=" . urlencode($query) . "&language=fr-FR";

// Le @ évite un vieux warning PHP crado si TMDB est inaccessible
$response = @file_get_contents($url);

if ($response === false) {
    echo json_encode(['results' => [], 'error' => 'Impossible de joindre TMDB']);
} else {
    echo $response;
}