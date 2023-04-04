<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $id = $_POST['id'];

    $reName = "/^([A-Z\d]{2,}|[A-Z][a-z]{1,})(\s[\w]{1,})*$/";
    $errors = [];

    if (!preg_match($reName, $name)) {
        array_push($errors, "Name isn't ok!");
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo json_encode($error);
            http_response_code(500);
        }
    } else {
        try {
            require_once '../../config/connection.php';
            include '../function.php';
            $check = checkPlatformName($name);

            if ($check && $check->id != $id && $check->name == $name) {
                echo json_encode("Platform with same name allready exists");
                http_response_code(409);
            } else {

                updatePlatform($name, $id);
                $platform = getPlatformFullRow($id);
                echo json_encode($platform);
            }
        } catch (PDOException $th) {
            echo json_encode("Something went wrong!");
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
