<?php
session_start();
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $game_id = $_POST['id'];
    $user_id = $_SESSION['user']->id;
    $from = $_POST['page'];
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : 1;


    try {
        require_once '../../config/connection.php';
        include '../function.php';

        storeInCart($user_id, $game_id, $quantity, $from);
        http_response_code(201);
        echo json_encode("New item has been added to your cart");
    } catch (PDOException $th) {
        echo json_encode("Something went wrong!");
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
