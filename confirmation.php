<?php session_start(); if (!isset($_SESSION['student_id'])) header("Location: index.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Confirmation</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="container">
        <h2>Thank You!</h2>
        <p>Your vote has been recorded successfully.</p>
        <a href="results.php">View Live Results</a>
    </div>
</body>
</html>