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
  <p class="lead"><?= htmlspecialchars($a_row['Game_Name']) ?></p>

  <table class="table table-striped w-auto">
    <tr>
      <th scope="row">Element</th>
      <td><?= htmlspecialchars($a_row['Element']) ?></td>
    </tr>
    <tr>
      <th scope="row">Price</th>
      <td>£<?= number_format((float) $a_row['Skylander_Price'], 2) ?></td>
    </tr>
    <tr>
      <th scope="row">Series</th>
      <td><?= (int) $a_row['Series_Var'] ?></td>
    </tr>
    <tr>
      <th scope="row">In-game variant</th>
      <td><?= !empty($a_row['Ingame_Var']) ? htmlspecialchars($a_row['Ingame_Var']) : 'N/A' ?></td>
    </tr>
    <tr>
      <th scope="row">ID</th>
      <td><?= (int) $a_row['Skylander_ID'] ?></td>
    </tr>
  </table>

<?php endif; ?>
<a href="Main.php">&lt;&lt; Back to list</a>
</div>
</body>
</html>