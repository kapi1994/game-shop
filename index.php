<?php
session_start();
require_once 'config/connection.php';
include 'includes/fixed/head.php';
include 'includes/fixed/navigation.php';
$page = '';
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'login':
            include 'includes/auth/login.php';
            break;
        case 'register':
            include 'includes/auth/register.php';
            break;
        case 'admin':
            
    }
}
include 'includes/fixed/footer.php';
