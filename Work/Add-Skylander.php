<?php
// Read values from the form (?? '' stops "undefined key" warnings)
$skylander_name = trim($_POST['Skylander_Name'] ?? '');
$game_name = trim($_POST['Game_Name'] ?? '');

// Stop with a friendly message if either field didn't arrive
if ($skylander_name === '' || $game_name === '') {
    die("Both fields are required. <a href=\"Add-Skylander-Form.php\">Go back</a>");
}

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
header("location: Main.php");
exit();
?>