<?php
header("Content-type:application/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'];

    try {
        require_once '../../config/connection.php';
        include '../function.php';

        changeStatus('games', $status, $id);
        $game = getGameFullRow($id);
        echo json_encode($game);
    } catch (PDOException $th) {
        echo json_encode("Something went wrong!");
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
