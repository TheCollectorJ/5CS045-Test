<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Skylanders Price List</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body>

  <?php include("Navbar.php"); ?>
  <?php include("db.php"); ?>

  <?php
    $sql = "SELECT * FROM Skylanders ORDER BY Skylander_ID";
    $results = mysqli_query($mysqli, $sql);
    if (!$results) { die("Query failed: " . mysqli_error($mysqli)); }
  ?>

  <div class="container mt-4">

    <?php if (mysqli_num_rows($results) == 0): ?>
      <div class="alert alert-warning">
        Query worked, but the Skylanders table has 0 rows, so there are no cards to show.
      </div>
    <?php endif; ?>

    <div class="row row-cols-2 row-cols-md-4 g-4">

      <?php while ($a_row = mysqli_fetch_assoc($results)): ?>

        <div class="col">
          <div class="card h-100">
            <div class="card-body">

              <h5 class="card-title">
                <?= htmlspecialchars($a_row['Skylander_Name']) ?>
              </h5>

              <h6 class="card-subtitle mb-3 text-body-secondary">
                <?= htmlspecialchars($a_row['Game_Name']) ?>
              </h6>

              <a class="btn btn-primary btn-sm"
                 href="Details.php?id=<?= (int) $a_row['Skylander_ID'] ?>">Details</a>

            </div>
          </div>
        </div>

      <?php endwhile; ?>

    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>