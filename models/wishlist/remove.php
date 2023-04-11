<?php
session_start();
header("Content-type:appliction/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $user_id = $_SESSION['user']->id;
    try {
        require_once '../../config/connection.php';
        include '../function.php';

        deleteWishlistItems($id);

        echo json_encode(wishlistItems($user_id));
    } catch (PDOException $th) {
        echo json_encode($th->getMessage());
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
