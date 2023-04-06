<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $publisher = $_POST['publisher'];
    $genres = $_POST['selectedGenres'];

    $errors = [];
    $reText = "/^[A-Z][a-z]{1,}$/";
    if (!preg_match($reText, $name)) {
        array_push($errors, "Name isn't ok!");
    }

    if (!preg_match($reText, $description)) {
        array_push($errors, "Description isn't ok!");
    }

    if ($publisher == 0) {
        array_push($errors, "Please choose publisher");
    }
    if (count($genres) == 0) {
        array_push($errors, "Please choose ate least one genre!");
    }
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo json_encode($error);
            http_response_code(422);
        }
    } else {
        require_once '../../config/connection.php';
        $check = checkGameName($name);
        if ($check) {
            echo json_encode("That name is allready taken!");
            http_response_code(409);
        } else {
            try {

                insertNewGame($name, $description, $publisher, $genres);


                echo json_encode([
                    'games' => getAllGames(),
                    'messages' => 'Games has been inserted'
                ]);
                http_response_code(201);
            } catch (PDOException $th) {

                echo json_encode($th->getMessage());
                http_response_code(500);
            }
        }
    }
} else {
    http_response_code(404);
}
