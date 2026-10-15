<?php
// Read values from the form
$skylander_name = $_POST['Skylander_Name'];
$game_name = $_POST['Game_Name'];

// Connect to database
include("db.php");

// Build SQL statement (? placeholders keep it safe from SQL injection)
$sql = "INSERT INTO Skylanders (Skylander_Name, Game_Name) VALUES (?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("ss", $skylander_name, $game_name);

// Run SQL statement and report errors
if (!$stmt->execute()) {
    echo("<h4>SQL error description: " . htmlspecialchars($stmt->error) . "</h4>");
    exit();
}

// Redirect to list
header("location: List_Skylanders.php");
exit();
?>