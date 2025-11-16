<?php 
session_start();

// check if seller is logged in
function isLoggedIn() {
    return isset($_SESSION['id']);
}

// redirect if seller is not logged in
function requireLogin() {
    if(!isLoggedIn()) {
        header("location: /RPL-KOLABORASI/login.php");
        exit();
    }
}

// get current seller ID
function getCurrentSellerId() {
    return $_SESSION['id'] ?? null;
}

// logout
function logout() {
    session_destroy();
    header("location: login.php");
    exit();
}


?>
