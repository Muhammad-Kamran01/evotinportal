<?php
require 'db.php';
$candidates = $conn->query("SELECT * FROM candidates");
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="results.css">
  <title>Results</title>
</head>
<body>
  <h2>Live Voting Results</h2>
  <table border="1">
    <tr><th>Candidate</th><th>Votes</th></tr>
    <?php while ($row = $candidates->fetch_assoc()): ?>
      <tr><td><?= $row['name'] ?></td><td><?= $row['vote_count'] ?></td></tr>
    <?php endwhile; ?>
  </table>
</body>
</html>