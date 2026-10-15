<h1>Search results</h1>
<?php
// Connect to database and run SQL query
include("db.php");
// Read value from form
$keywords = $_POST['keywords'];
// Run SQL query
$sql = "SELECT * FROM Skylanders
WHERE Skylanders_Name LIKE '%{$keywords}%'
ORDER BY Skylander_Name";
$results = mysqli_query($mysqli, $sql);
?>
<table>
<?php while($a_row = mysqli_fetch_assoc($results)):?>
<tr>
<td><a href="Details.php?id=<?=$a_row['Skylander_ID']?>"><?=$a_row['Skylander_Name']?></a></td>
</tr>
<?php endwhile;?>
</table>