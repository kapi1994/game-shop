<?php
header("Contentt-type:application/json");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    require_once '../../config/connection.php';


    $ordersCountQuery = "select count(*) as numberOfOrders from orders";
    $orders = $connection->query($ordersCountQuery)->fetch();

    $usersCountQuery = "select count(*) as numberOfUsers from users u join roles r on u.role_id = r.id where r.name != 'Admin'";
    $users = $connection->query($usersCountQuery)->fetch();

    $platformsQuery = "select id,name from platforms";
    $platforms = $connection->query($platformsQuery)->fetchAll();

    $votesQuery = "select platform_id from votes";
    $votes = $connection->query($votesQuery)->fetchAll();

    $gamesQuery = "select count(*) as numberOfGames from games";
    $games = $connection->query($gamesQuery)->fetch();

    // var_dump($platforms);

    $platformsArray = [];
    foreach ($platforms as $platform) {
        if (!array_key_exists($platform->name, $platformsArray)) {
            $platformsArray[$platform->name] = 0;
        }
        foreach ($votes as $vote) {
            if ($vote->platform_id == $platform->id) {
                $platformsArray[$platform->name]++;
            }
        }
    }

    echo json_encode([
        'orders' => $orders,
        'users' => $users,
        'platformVotes' => $platformsArray,
        'games' => $games

    ]);
} else {
    http_response_code(404);
}
