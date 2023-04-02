<?php

define("ELEMENTS_PER_ADMIN", 5);


function getOne($query)
{
    global $connection;
    return $connection->query($query)->fetch();
}
function checkEmail($email)
{
    $query = "select email from users where email = '$email'";
    return getOne($query);
}
function insertNewUser($first_name, $last_name, $email, $password)
{
    global $connection;
    define('ROLE_ID', 1);
    $query = "insert into users (first_name, last_name, email, password, role_id) values(?,?,?,?,?)";
    $queryInsert = $connection->prepare($query);
    $queryInsert->execute([$first_name, $last_name, $email, md5($password), ROLE_ID]);
}

function login($email, $password)
{
    global $connection;
    $query = "select id, role_id from users where email = ? and password = ? ";
    $queryUser = $connection->prepare($query);
    $queryUser->execute([$email, md5($password)]);
    return $queryUser->fetch();
}


function gamePivot($game_id)
{
    global $connection;
    $selectGenres = "select * from game_genre where game_id = '$game_id'";
    $genres = $connection->query($selectGenres)->fetchAll();
    $selectedGenres = [];
    foreach ($genres as $genre) {
        array_push($selectedGenres, $genre->genre_id);
    }
    return $selectedGenres;
}

function getAllPublishers($limit = 0)
{
    global $connection;
    $queryBase = "select * from publishers";
    $offset = ELEMENTS_PER_ADMIN;
    $limit = $limit * $offset;
    $queryLimit = " LIMIT $limit, $offset";
    $query = $queryBase . $queryLimit;
    return $connection->query($query)->fetchAll();
}

function pagination($table)
{
    global $connection;
    $query = "select count(*) as numberOfElements from $table";
    $elements = $connection->query($query)->fetch();
    $pages = ceil($elements->numberOfElements / ELEMENTS_PER_ADMIN);
    return $pages;
}
