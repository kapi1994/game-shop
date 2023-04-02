<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];

    require_once '../../config/connection.php';
    include '../function.php';
    $querySelect = "select id, name, description, publisher_id from games where id='$id'";
    $game = $connection->query($querySelect)->fetch();
    $game->genres = gamePivot($game->id);
    echo json_encode($game);
} else {
    http_response_code(404);
}
