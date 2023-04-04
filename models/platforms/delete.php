<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $platforms = $_POST['status'];

    try {
        require '../../config/connection.php';
        include '../function.php';
        changeStatus('platforms', $status, $id);

      $platform = getOnePlatform($id);
      echo json_encode($platform);
    } catch (PDOException $th) {
        echo json_encode("Something went wrong!");
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
