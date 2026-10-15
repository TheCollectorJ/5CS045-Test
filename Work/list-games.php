<!doctype html>
<html lang="en">
<body>
<h1>List of ALL my games!!!</h1>
<?php
// Connect to database
include("db.php");
// Run SQL query
$sql = "SELECT * FROM Skylanders ORDER BY Sklyander_ID";
$results = mysqli_query($mysqli, $sql);
?>
<table>
<?php while($a_row = mysqli_fetch_assoc($results)):?>
<tr>
<td><a href="Details.php?id=<?=$a_row['Skylander_ID']?>"><?=$a_row['Game_Name']?></a>
<td><?=$a_row['Skylander_Name']?></td>
<td><?=$a_row['Game_Name']?></td>
</tr>
<?php endwhile;?>
</table>
<form action="search-games.php" method="post">
<input type="text" name="keywords" placeholder="Search">
<input type="submit" value="Go!">
</form>
</body>
</html>