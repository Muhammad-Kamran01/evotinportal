<?php
session_start();
require 'db.php'; // Ensure db.php is in the same directory or adjust path

if (!isset($_SESSION['student_id'])) {
    header("Location: index.php");
    exit;
}

$id = $_SESSION['student_id'];
$result = $conn->query("SELECT has_voted FROM students WHERE student_id='$id'");
$row = $result->fetch_assoc();

if ($row['has_voted']) {
    echo "<!DOCTYPE html>
          <html>
          <head>
            <link rel='stylesheet' href='voting.css'>
            <title>Vote Status</title>
          </head>
          <body>
            <p>You have already voted.</p>
            <a href='results.php'>View Results</a>
          </body>
          </html>";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $candidate = $_POST['candidate'];

    $conn->query("UPDATE candidates SET vote_count = vote_count + 1 WHERE name='$candidate'");
    $conn->query("UPDATE students SET has_voted = 1 WHERE student_id='$id'");

    echo "<!DOCTYPE html>
          <html>
          <head>
            <link rel='stylesheet' href='voting.css'>
            <title>Vote Status</title>
          </head>
          <body>
            <p>Vote submitted successfully!</p>
            <a href='results.php'>View Results</a>
          </body>
          </html>";
    exit;
}

$candidates = $conn->query("SELECT name FROM candidates");
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="voting.css"> <title>Vote</title>
</head>
<body>
  <h2>Cast Your Vote</h2>
  <form method="post">
    <?php while ($row = $candidates->fetch_assoc()): ?>
      <div class="candidate-option">
        <input type="radio" name="candidate" id="<?= htmlspecialchars($row['name']) ?>" value="<?= htmlspecialchars($row['name']) ?>" required>
        <label for="<?= htmlspecialchars($row['name']) ?>"><?= htmlspecialchars($row['name']) ?></label>
      </div>
    <?php endwhile; ?>
    <button type="submit">Submit Vote</button>
  </form>
</body>
</html>