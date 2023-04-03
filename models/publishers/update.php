<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $id = $_POST['id'];


    $errors = [];
    $reName = "/^([A-Z\d]{2,}|[A-Z][a-z]{1,})(\s[\w]{1,})*$/";
    if (!preg_match($reName, $name)) {
        array_push($errors, "Name isn't ok!");
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
            $check = checkPublisherName($name);
            if ($check && $check->name == $name && $check->id != $id) {
                echo json_encode("Publisher name is allready taken!");
                http_response_code(409);
            } else {
                updatePublisher($name, $id);
                $publisher = getPublisherFullRow($id);
                echo json_encode($publisher);
            }
        } catch (PDOException $th) {
            echo json_encode("Something went wrong!");
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
