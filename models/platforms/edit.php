<?php
header("Content-type:application/json");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id = $_GET['id'];
    require_once '../../config/connection.php';
    $query = "select id, name from platforms where id ='$id'";
    $platform = $connection->query($query)->fetch();
    echo json_encode($platform);
} else {
    http_response_code(404);
}
