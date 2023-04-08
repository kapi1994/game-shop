<?php
header("Content-type:application/json");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $game_id = $_POST['game_id'];
    $edition = $_POST['edition'];
    $price = $_POST['price'];
    $platform = $_POST['platform'];
    $id = $_POST['id'];
    $new_image_name = '';



    $rePrice  = '/^[\d]{3,}$/';
    $errors = [];

    if (!preg_match($rePrice, $price)) {
        array_push($errors, "Price isn't ok!");
    }
    if ($platform == 0) {
        array_push($errors, "Publisher isn't ok!");
    }
    if ($edition == 0) {
        array_push($errors, "Edition isn't ok!");
    }

    if (isset($_FILES['image'])) {
        $image = $_FILES['image'];
        $allowedTypes = ['image/png', 'image/jpg', 'image/jpeg'];

        $image_size = $image['size'];
        $image_name  = $image['name'];
        $image_type = $image['type'];
        $image_tmp_name = $image['tmp_name'];


        if ($image_size > 3 * 1024 * 1024) {
            array_push($errors, "Image isn't ok!");
        }

        if (!in_array($image_type, $allowedTypes)) {
            array_push($errors, "Image extension isn't ok!");
        }
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
            if ($check && $check->platform_id == $platform && $check->edition_id == $edition && $check->game_id == $game_id && $check->id != $id) {
                echo json_encode("Game on that platform with this edition allready exists!");
                http_response_code(409);
            } else {
                $new_image_name = '';
                if (isset($_FILES['image'])) {
                    $cover = $_POST['img_cover'];
                    $new_image_name = time() . "_" . $image_name;
                    $image_path = "../../assets/img/$new_image_name";
                    move_uploaded_file($image_tmp_name, $image_path);
                }

                updateGameEdition($platform, $edition, $price, $id, $new_image_name);
                $edition = getGameEdition($id);
                echo json_encode($edition);
            }
        } catch (PDOException $th) {
            echo json_encode($th->getMessage());
            http_response_code(500);
        }
    }
} else {
    http_response_code(404);
}
