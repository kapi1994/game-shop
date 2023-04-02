<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $reName = "/^([A-Z\d]{2,}|[A-Z][a-z]{1,})(\s[\w]{1,})*$/";
    $errors = [];

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
            $queryCheck = "select name from platforms where name = '$name'";
            $check = $connection->query($queryCheck)->fetch();
            if ($check) {
                echo json_encode("Platform with this name allready exists");
                http_response_code(422);
            } else {
                $queryInsert = "insert into platforms (name) values (?)";
                $insert = $connection->prepare($queryInsert);
                $insert->execute([$name]);

                $querySelect = "select * from platforms";
                $select = $connection->query($querySelect)->fetchAll();

                echo json_encode([
                    'platforms' => $select,
                    'message' => "Platform has been added"
                ]);
            }
        } catch (PDOException $th) {
            echo json_encode($th->getMessage());
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
