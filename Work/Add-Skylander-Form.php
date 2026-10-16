
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add a Skylander</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body>

  <?php include("Navbar.php"); ?>

  <div class="container mt-4">
    <h1>Add a Skylander</h1>

    <?php if ($error !== ""): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="Add-Skylander-Form.php" method="post">

      <div class="mb-3">
        <label for="Skylander_Name" class="form-label">Skylander name</label>
        <input type="text" class="form-control" id="Skylander_Name"
               name="Skylander_Name" required>
      </div>

      <div class="mb-3">
        <label for="Game_Name" class="form-label">Game</label>
        <select class="form-select" id="Game_Name" name="Game_Name" required>
          <option value="" selected disabled>What game is your Skylander from?</option>
          <option value="Skylanders Spyro's Adventure">Skylanders Spyro's Adventure</option>
          <option value="Skylanders Giants">Skylanders Giants</option>
          <option value="Skylanders Swap Force">Skylanders Swap Force</option>
          <option value="Skylanders Trap Team">Skylanders Trap Team</option>
          <option value="Skylanders Super Chargers">Skylanders Super Chargers</option>
          <option value="Skylanders Imaginators">Skylanders Imaginators</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="Element" class="form-label">Element</label>
        <select class="form-select" id="Element" name="Element" required>
          <option value="" selected disabled>Choose an element</option>
          <option>Air</option>
          <option>Dark</option>
          <option>Earth</option>
          <option>Fire</option>
          <option>Life</option>
          <option>Light</option>
          <option>Magic</option>
          <option>Tech</option>
          <option>Undead</option>
          <option>Water</option>
        </select>
      </div>

      <div class="mb-3">
        <label for="Series_Var" class="form-label">Series</label>
        <input type="number" class="form-control" id="Series_Var"
               name="Series_Var" min="0" max="127" step="1" required>
      </div>

      <div class="mb-3">
        <label for="Ingame_Var" class="form-label">In-game variant (optional)</label>
        <input type="text" class="form-control" id="Ingame_Var" name="Ingame_Var">
      </div>

      <div class="mb-3">
        <label for="Skylander_Price" class="form-label">Price (£)</label>
        <input type="number" class="form-control" id="Skylander_Price"
               name="Skylander_Price" min="0" step="0.01" required>
      </div>

      <input type="submit" class="btn btn-primary" value="Add Skylander">
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>