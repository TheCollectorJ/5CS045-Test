<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Search results</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>
<body>
<?php include("Navbar.php"); ?>
<?php
include("db.php");

$keywords = isset($_POST['keywords']) ? trim($_POST['keywords']) : '';
$like = "%" . $keywords . "%";

$stmt = $mysqli->prepare(
  "SELECT * FROM Skylanders
   WHERE Skylander_Name LIKE ?
   ORDER BY Skylander_ID"
);
$stmt->bind_param("s", $like);
$stmt->execute();
$results = $stmt->get_result();
?>
<div class="container mt-4">
<h1>Search results</h1>
<p>You searched for: <strong><?= htmlspecialchars($keywords) ?></strong></p>

<?php if ($results->num_rows == 0): ?>
  <div class="alert alert-warning">No results found.</div>
<?php else: ?>
  <table class="table table-striped">
  <?php while ($a_row = $results->fetch_assoc()): ?>
    <tr>
      <td><a href="Details.php?id=<?= (int) $a_row['Skylander_ID'] ?>"><?= htmlspecialchars($a_row['Skylander_Name']) ?></a></td>
      <td><?= htmlspecialchars($a_row['Game_Name']) ?></td>
    </tr>
  <?php endwhile; ?>
  </table>
<?php endif; ?>

<a href="List_Skylanders.php">&lt;&lt; Back to list</a>
</div>
</body>
</html> 