<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['student_id'];
    $pass = $_POST['password'];

    $check = $conn->query("SELECT * FROM students WHERE student_id='$id'");
    if ($check->num_rows > 0) {
        echo "<p>Student ID already exists.</p>";
    } else {
        $sql = "INSERT INTO students (student_id, password) VALUES ('$id', '$pass')";
        if ($conn->query($sql)) {
            echo "<p>Registration successful. <a href='index.php'>Login Now</a></p>";
        } else {
            echo "<p>Error: " . $conn->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="registration.css">
  <title>Register</title>
</head>
<body>
  <h2>Student Registration</h2>
  <form method="post">
    <input name="student_id" type="text" placeholder="Student ID" required><br>
    <input name="password" type="password" placeholder="Password" required><br>
    <button type="submit">Register</button>
  </form>
</body>
</html>