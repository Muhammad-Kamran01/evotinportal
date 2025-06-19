<?php

session_start([
    'cookie_secure' => true,
    'cookie_httponly' => true,
    'use_strict_mode' => true
]);

$conn = mysqli_connect("localhost", "root", "", "votingsystem");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
