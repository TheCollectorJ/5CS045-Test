<?php
// Connect to database and run SQL query
include("db.php");
// Grabs id value from URL (forced to a whole number)
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$stmt = $mysqli->prepare("SELECT * FROM Skylanders WHERE Skylander_ID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$a_row = $stmt->get_result()->fetch_assoc();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Skylander details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>
<body>
<?php include("Navbar.php"); ?>
<div class="container mt-4">
<?php if (!$a_row): ?>
  <div class="alert alert-warning">Skylander not found.</div>
<?php else: ?>
  <h1><?= htmlspecialchars($a_row['Skylander_Name']) ?></h1>
  <p><?= htmlspecialchars($a_row['Game_Name']) ?></p>
  <p class="text-body-secondary">ID: <?= (int) $a_row['Skylander_ID'] ?></p>
<?php endif; ?>
<a href="Main.php">&lt;&lt; Back to list</a>
</div>
</body>
</html>