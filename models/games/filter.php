<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $text = $_GET['text'];
    $limit  = isset($_GET['limit']) ? $_GET['limit'] : 0;
    try {
        require_once '../../config/connection.php';
        include '../function.php';

        echo json_encode([
            'games' => getAllGames($limit, $text),
            'pagination' => gamesPagination($text)
        ]);
    } catch (PDOException $th) {
        echo json_encode($th->getMessage());
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
