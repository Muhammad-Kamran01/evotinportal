<?php
session_start();
require 'db.php'; // Ensure db.php is in the same directory or adjust path

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['student_id'];
    $pass = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM students WHERE student_id=? AND password=?");
    $stmt->bind_param("ss", $id, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $_SESSION['student_id'] = $id;
        header("Location: vote.php");
        exit;
    } else {
        $login_error = "Invalid Login"; // Store error for display
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="index.css">
  <title>Login</title>
</head>
<body>
  <div class="top-section"> <h1>Welcome To E-Voting Portal</h1>
    <p>Securely cast your vote anytime, anywhere with our easy-to-use e-voting portal. Experience a streamlined and transparent voting process. We handle everything from notifying voters to tallying results, ensuring a fair and efficient election. Our platform offers easy ballot creation and flexible design options to fit your specific needs.</p>
  </div>

  <div class="login-container"> <h2 class="login-heading">Student Login</h2>
    <form method="post">
      <input name="student_id" type="text" placeholder="Student ID" required><br>
      <input name="password" type="password" placeholder="Password" required><br>
      <button type="submit">Login</button>
      <?php if (isset($login_error)): ?>
          <p class="error-message"><?= htmlspecialchars($login_error) ?></p>
      <?php endif; ?>
      <p>Don't have an account? <a href="register.php">Register here</a></p>
    </form>
  </div>
</body>
</html>
