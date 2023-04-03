<?php
header("Content-type:application/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $status = $_POST['status'];
    $id = $_POST['id'];

    try {
        require_once '../../config/connection.php';
        require '../function.php';

        changeStatus('game_edition', $status, $id);
        $edition = editGameEdition($id);
        echo json_encode($edition);
    } catch (PDOException $th) {
        echo json_encode("Something went wrong!");
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
