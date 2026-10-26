<?php
// Read values from the form
$skylander_name  = trim($_POST['Skylander_Name'] ?? '');
$game_name       = trim($_POST['Game_Name'] ?? '');
$element         = trim($_POST['Element'] ?? '');
$series_var      = isset($_POST['Series_Var']) ? (int) $_POST['Series_Var'] : 0;
$ingame_var      = trim($_POST['Ingame_Var'] ?? '');
$skylander_price = isset($_POST['Skylander_Price']) ? (float) $_POST['Skylander_Price'] : 0;

// Stop with a friendly message if required fields are missing
if ($skylander_name === '' || $game_name === '' || $element === '') {
    die("Name, game and element are required. <a href=\"Add-Skylander-Form.php\">Go back</a>");
}

// Connect to database
include("db.php");

$sql = "INSERT INTO Skylanders
          (Skylander_Name, Game_Name, Element, Series_Var, Ingame_Var, Skylander_Price)
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sssisd", $skylander_name, $game_name, $element,
                  $series_var, $ingame_var, $skylander_price);
$stmt->execute();

header("location: Main.php");
exit();
?>