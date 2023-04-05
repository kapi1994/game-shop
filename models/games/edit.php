<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];

    try {
        require_once '../../config/connection.php';
        include '../function.php';
        $game = getGame($id);
        echo json_encode($game);
    } catch (PDOException $th) {
        echo json_encode("Something went wrong!");
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
