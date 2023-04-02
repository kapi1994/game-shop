<?php
header("Content-type:application/json");
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    require '../../config/connection.php';
    $query = "select id, name from publishers where id = '$id'";
    $publisher = $connection->query($query)->fetch();
    echo json_encode($publisher);
} else {
    http_response_code(404);
}
