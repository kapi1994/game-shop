<?php
session_start();
header("Content-type:application/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user_id = $_SESSION['user']->id;
    $rating = $_POST['rating'];
    $message = $_POST['message'];
    $game_id  = $_POST['game_id'];


    $errors = [];
    $reMessage = "/^[A-z]$/";
    if ($rating == 0) {
        array_push($errors, "Please rate!");
    }
    if (!preg_match($reMessage, $message)) {
        array_push($errors, "Message isn't ok!");
    }
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo json_encode($error);
            http_response_code(422);
        }
    } else {
        try {
            require_once '../../config/connection.php';
            include '../function.php';

            $comment = insertComment($user_id, $game_id, $rating, $message);
            echo json_encode($comment);
        } catch (PDOException $th) {
            echo json_encode("Something went wrong!");
            http_response_code(503);
        }
    }
} else {
    http_response_code(404);
}
