<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'] == 0 ? 1 : 0;

    try {
        require_once '../../config/connection.php';
        $queryUpdate = "update publishers set is_deleted = ? where id = ?";
        $update = $connection->prepare($queryUpdate);
        $update->execute([$status, $id]);

        $querySelect = "select * from publishers where id = '$id'";
        $select = $connection->query($querySelect)->fetch();
        echo json_encode($select);
    } catch (PDOException $th) {
        echo json_encode($th->getMessage());
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
