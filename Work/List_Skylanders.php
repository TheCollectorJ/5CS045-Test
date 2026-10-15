<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>List of Skylanders</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>
<body>
<?php include("Navbar.php"); ?>
<?php
// Connect to database
include("db.php");
// Run SQL query
$sql = "SELECT * FROM Skylanders ORDER BY Skylander_ID";
$results = mysqli_query($mysqli, $sql);
if (!$results) { die("Query failed: " . mysqli_error($mysqli)); }
?>
<div class="container mt-4">
<h1>List of ALL my games!!!</h1>

<table class="table table-striped">
<?php while($a_row = mysqli_fetch_assoc($results)):?>
<tr>
<td><a href="Details.php?id=<?= (int) $a_row['Skylander_ID'] ?>"><?= htmlspecialchars($a_row['Skylander_Name']) ?></a></td>
<td><?= htmlspecialchars($a_row['Game_Name']) ?></td>
</tr>
<?php endwhile;?>
</table>

<form action="Search_Skylanders.php" method="post" class="d-flex mb-3">
<input type="text" name="keywords" class="form-control me-2" placeholder="Search">
<input type="submit" class="btn btn-secondary" value="Go!">
</form>

<a href="Add-Skylander-Form.php" class="btn btn-primary">Add a Skylander</a>
</div>
</body>
</html>