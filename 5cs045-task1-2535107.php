<?php
$mysqli = new mysqli("localhost", "2535107", "tt5xlg", "db2535107");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$sql = "SELECT * FROM movies";
$results = mysqli_query($mysqli, $sql);
?>
<!doctype html>
<html lang="en">
<body>

<table>
<tr>
<th>Movie name</th>
<th>Genre</th>
<th>Price</th>
<th>Date of release</th>
</tr>
<?php while($a_row = mysqli_fetch_assoc($results)):?>
<tr>
<td><?=$a_row['Movie_name']?></td>
<td><?=$a_row['Genre']?></td>
<td>£<?=$a_row['Price']?></td>
<td><?=$a_row['Date of release']?></td>
</tr>
<?php endwhile;?>
</table>

</body>
</html>