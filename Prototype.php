<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Website</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body>

  <?php include("Navbar.php"); ?>
  <?php include("db.php"); ?>
  <?php
    $sql = "SELECT * FROM videogames ORDER BY released_date";
    $results = mysqli_query($mysqli, $sql);
    if (!$results) { die("Query failed: " . mysqli_error($mysqli)); }
  ?>
  <div class="container">

    <h1>Hello, world!</h1>

    <?php if (mysqli_num_rows($results) == 0): ?>
      <div class="alert alert-warning">
        Query worked, but the videogames table has 0 rows, so there are no cards to show.
      </div>
    <?php endif; ?>

    <div class="row row-cols-2 row-cols-md-4 g-4">

      <?php while ($a_row = mysqli_fetch_assoc($results)): ?>

        <div class="col">
          <div class="card">
            <div class="card-body">

              <h5 class="card-title"><?= $a_row['game_name'] ?></h5>

              <h6 class="card-subtitle text-body-secondary">
                <?= $a_row['released_date'] ?>
              </h6>

            </div>
          </div>
        </div>

      <?php endwhile; ?>

    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>