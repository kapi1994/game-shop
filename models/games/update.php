<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
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
        array_push($errors, "Please choose publusher!");
    }

    if (count($genres) == 0) {
        array_push($errors, "Please choose at least one publisher!");
    }

    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo json_encode($error);
            http_response_code(422);
        }
    } else {
        require_once '../../config/connection.php';
        $checkGameQuery = "select id, name from games where name = '$name'";
        $checkGame = $connection->query($checkGameQuery)->fetch();
        if ($checkGame && $checkGame->name == $name && $checkGame->id != $id) {
            echo json_encode("Game with this name allready exists");
            http_response_code(409);
        } else {
            try {
                $connection->beginTransaction();
                $date = date('Y-m-d H:i:s');
                $queryGameUpdate = "update games set name =?, description=?, publisher_id =?, updated_at =? where id =?";
                $gameUpdate = $connection->prepare($queryGameUpdate);
                $gameUpdate->execute([$name, $description, $publisher, $date, $id]);

                $queryDeletePivot = "delete from game_genre where game_id = ?";
                $deletePivot = $connection->prepare($queryDeletePivot);
                if ($deletePivot->execute([$id])) {
                    $queryPivotParams = [];
                    $queryPivotValues = [];
                    foreach ($genres as $genre) {
                        $queryPivotParams[] = "(?,?)";
                        $queryPivotValues[] = (int) $id;
                        $queryPivotValues[] = (int) $genre;
                    }
                    $queryInsertPivot = "insert into game_genre values" . implode(',', $queryPivotParams);
                    $insertPivot = $connection->prepare($queryInsertPivot);
                    $insertPivot->execute($queryPivotValues);
                }

                $connection->commit();
            } catch (PDOException $th) {
                $connection->rollBack();
                echo json_encode($th->getMessage());
                http_response_code(500);
            }
            $querySelect = "select g.*, p.name as publisherName from games g join publishers p on g.publisher_id = p.id where g.id = '$id'";
            $select = $connection->query($querySelect)->fetch();
            echo json_encode($select);
        }
    }
} else {
    http_response_code(500);
}
