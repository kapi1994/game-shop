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
        $queryCheck = "select name from games where name ='$name'";
        $check = $connection->query($queryCheck)->fetch();
        if ($check) {
            echo json_encode("That name is allready taken!");
            http_response_code(409);
        } else {
            try {


                $connection->beginTransaction();

                $queryInsert = "insert into games (name, description, publisher_id) values(?,?,?)";
                $insertGame = $connection->prepare($queryInsert);
                $insertGame->execute([$name, $description, $publisher]);
                $last_id = $connection->lastInsertId();

                $queryParamPivot = [];
                $queryValuePivot = [];

                foreach ($genres as $genre) {
                    $queryParamPivot[] = "(?,?)";
                    $queryValuePivot[] = (int)$last_id;
                    $queryValuePivot[] = (int)$genre;
                }

                $queryInsertPivot = "insert into game_genre (game_id, genre_id) values" . implode(',', $queryParamPivot);
                $insertPivot = $connection->prepare($queryInsertPivot);
                $connection->commit();


                $querySelect = "select g.*, p.name as publisherName from games g join publishers p on g.publisher_id = p.id ";
                $games = $connection->query($querySelect)->fetchAll();


                echo json_encode([
                    'games' => $games,
                    'messages' => 'Games has been inserted'
                ]);
                http_response_code(201);
            } catch (PDOException $th) {
                $connection->rollBack();
                echo json_encode($th->getMessage());
                http_response_code(500);
            }
        }
    }
} else {
    http_response_code(404);
}
