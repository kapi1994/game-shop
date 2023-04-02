<?php
session_start();
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];
    $rePassword = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "email isn't ok!");
    }
    if (!preg_match($rePassword, $password)) {
        array_push($errors, "Password isn't ok!");
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo json_encode($error);
            http_response_code(422);
        }
    } else {
        require_once '../../config/connection.php';
        include '../function.php';
        $user = login($email, $password);

        if ($user) {
            $_SESSION['user'] = $user;
            echo json_encode($user->role_id);
        } else {
            echo json_encode("Your credentials aren't ok!");
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
