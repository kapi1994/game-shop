<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $limit = $_GET['limit_page'];

    try {
        require_once '../../config/connection.php';
        include '../function.php';

        echo json_encode([
            'publishers' => getAllPublishers($limit),
            'pagination' => pagination('publishers')
        ]);
    } catch (PDOException $th) {
        echo json_encode("Something went wrong!");
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
