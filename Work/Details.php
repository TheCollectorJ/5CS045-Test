<?php
// Connect to database and run SQL query
include("db.php");
// Grabs id value from URL
$id = $_GET['id'];
$sql = "SELECT * FROM Skylanders WHERE Skylander_ID = {$id}";
$rst = mysqli_query($mysqli, $sql);
$a_row = mysqli_fetch_assoc($rst);
?>
<h1><?=$a_row['Skylander_Name']?></h1>
<p><?=$a_row['Game_Name']?></p>
<p><?=$a_row['Skylander_ID']?></p>
<a href="Main.php"><< Back to list</a>