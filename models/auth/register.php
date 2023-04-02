<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];
    $reFirstLastName = '/^[A-ZŠĐČĆŽ][a-zšđžčć]{3,15}(\s[A-ZČŠĐĆŽ][a-zčćšđž]{3,15})?$/';
    $rePassword = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/';
    if (!preg_match($reFirstLastName, $first_name)) {
        array_push($errors, "First name isn't ok!");
    }
    if (!preg_match($reFirstLastName, $last_name)) {
        array_push($errors, "Last name isn't ok!");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        array_push($errors, "Email isn't ok!");
    }
    if (!preg_match($rePassword, $password)) {
        array_push($errors, "Password isn't ok");
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
            $checkUserEmail = checkEmail($email);
            if ($checkUserEmail) {
                echo json_encode("Email is allready taken!");
                http_response_code(409);
            } else {
                insertNewUser($first_name, $last_name, $email, $password);
                echo json_encode("New account is created");
                http_response_code(201);
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
