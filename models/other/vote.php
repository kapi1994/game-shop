<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $vote = $_POST['vote'];
    $user_id = isset($_SESSION['user']) ? $_SESSION['user']->id : '';
    $errors = [];

    if ($vote == 0 || $vote == null) {
        array_push($errors, "Please choose your option!");
    }
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo json_encode($error);
            http_response_code(422);
        }
    } else {
        try {
            require_once '../../config/connection.php';
            require '../function.php';
            voteStore($user_id, $vote);
            echo json_encode("Thank you for compliting our survey!");
            http_response_code(201);
        } catch (PDOException $th) {
            echo json_encode("Something went wrong!");
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
