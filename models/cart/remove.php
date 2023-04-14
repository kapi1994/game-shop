<?php
session_start();
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cartItemId = $_POST['id'];
    try {
        require_once '../../config/connection.php';
        include '../function.php';

        removeCartItem($cartItemId);
        echo json_encode(cartItems($_SESSION['user']->id));
    } catch (PDOException $th) {
        echo json_encode($th->getMessage());
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
