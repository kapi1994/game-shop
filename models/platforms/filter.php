<?php
header("Content-type:application/json");
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $limit = $_GET['limit'];

    try {
        require_once '../../config/connection.php';
        include '../function.php';
        echo json_encode([
            'platforms' => getAllPlatforms($limit),
            'pagination' => pagination('platforms')
        ]);
    } catch (PDOException $th) {
        echo json_encode("Something went wrong!");
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
