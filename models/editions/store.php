<?php
header("Content-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $game_id = $_POST['game_id'];
    $platform = $_POST['platform'];
    $edition = $_POST['edition'];
    $price = $_POST['price'];

    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_size = $image['size'];
    $image_tmp_name = $image['tmp_name'];
    $image_type = $image['type'];


    $rePrice = '/^[\d]{3,}$/';
    $errors = [];
    $allowedTypes = ['image/png', 'image/jpg', 'image/jpeg'];

    if ($platform == 0) {
        array_push($errors, "Please choose publisher!");
    }
    if ($edition == 0) {
        array_push($errors, "Please choose edition!");
    }

    if (!preg_match($rePrice, $price)) {
        array_push($errors, "Price isn't ok!");
    }
    if (!in_array($image_type, $allowedTypes)) {
        array_push($errors, "Image extension isn't ok!");
    }
    if ($image_size > 3 * 1024 * 1024) {
        array_push($errors, "Image size isn't ok!");
    }
    if (count($errors) > 0) {
        foreach ($errors as $error) {
            echo json_encode($error);
            http_response_code(422);
        }
    } else {
        try {
            require_once '../../config/connection.php';
            include '../function.php';
            $check = checkGameEdition($game_id, $edition, $platform);

            if ($check) {
                echo json_encode("Game with this edition on this platform allready exists!");
                http_response_code(409);
            } else {
                $new_image_name = time() . "_" . $image_name;
                $image_path = "../../assets/img/$new_image_name";
                move_uploaded_file($image_tmp_name, $image_path);

                insertNewGameEdition($game_id, $platform, $edition, $price, $new_image_name);

                echo json_encode([
                    'editions' => editions($game_id),
                    'message' => "New edition has been added"
                ]);
                http_response_code(201);
            }
        } catch (PDOException $th) {
            echo json_encode($th->getMessage());
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
