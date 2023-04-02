<?php
session_start();
require_once 'config/connection.php';
include 'models/function.php';
include 'includes/fixed/head.php';
include 'includes/fixed/navigation.php';
$page = '';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'home':
            include 'includes/admin/index.php';
            break;
        case 'publishers':
            include 'includes/admin/publishers/index.php';
            break;
        case 'platforms':
            include 'includes/admin/platforms/index.php';
            break;
        case 'games':
            include 'includes/admin/games/index.php';
            break;
        case 'show':
            include 'includes/admin/games/show.php';
            break;
    }
} else {
    include 'includes/admin/index.php';
}
include 'includes/fixed/footer.php';
