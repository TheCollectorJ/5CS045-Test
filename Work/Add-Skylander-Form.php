<!doctype html>
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

    <form action="Add-Skylander.php" method="post">

      <div class="mb-3">
        <label for="Skylander_Name" class="form-label">Skylander name</label>
        <input type="text" class="form-control" id="Skylander_Name"
               name="Skylander_Name" required>
      </div>

      <div class="mb-3">
        <select class="form-select" aria-label="Default select example">
            <option selected>What game is your Skylander from? </option?>
            <option value="1">Skylanders Spyro's Adventure</option?>
            <option value="2">Skylanders Giants</option?>
            <option value="3">Skylanders Swap Force</option?>
            <option value="4">Skylanders Trap Team</option?>
            <option value="5">Skylanders Super Chargers</option?>
            <option value="6">Skylanders Imaginators</option?>
        </select>
        
      </div>

      <input type="submit" class="btn btn-primary" value="Add Skylander">
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>