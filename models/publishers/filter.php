<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $limit = $_GET['limit_page'];

    require_once '../../config/connection.php';
    include '../function.php';

    echo json_encode([
        'publishers' => getAllPublishers($limit),
        'pagination' => pagination('publishers')
    ]);
} else {
    http_response_code(404);
}
