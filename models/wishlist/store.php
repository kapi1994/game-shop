<?php
session_start();
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $game_id = $_POST['id'];

    try {
        require_once '../../config/connection.php';
        include '../function.php';

        $user_id =  $_SESSION['user']->id;
        wishlistStore($user_id, $game_id);

        echo json_encode("New item has been added to your wishlist");
        http_response_code(201);
    } catch (PDOException $th) {
        echo json_encode($th->getMessage());
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
