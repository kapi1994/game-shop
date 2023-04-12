<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $errors = [];
    $reFirstLastName = "/^[A-ZŠĐČĆŽ][a-zšđžčć]{3,15}(\s[A-ZČŠĐĆŽ][a-zčćšđž]{3,15})?$/";
    $reMessage = "/^[A-z]{3,}$/";

    if (!preg_match($reFirstLastName, $first_name)) {
        array_push($errors, "First name isn't ok!");
    }
    if (!preg_match($reFirstLastName, $last_name)) {
        array_push($errors, "Last name isn't ok!");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email isn't ok!");
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
            storeMessages($first_name, $last_name, $email, $message);
            http_response_code(201);
            echo json_encode("Thank you for contacting us!");
        } catch (PDOException $th) {
            echo json_encode("Something went wrong!");
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
