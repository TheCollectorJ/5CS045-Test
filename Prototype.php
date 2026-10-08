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

  <div class="container">

    <h1>Hello, world!</h1>

    <div class="row row-cols-2 row-cols-md-4 g-4">

      <?php for ($x = 0; $x <= 12; $x++): ?>

        <div class="col">
          <div class="card">
            <div class="card-body">

              <h5 class="card-title">Card title</h5>

              <h6 class="card-subtitle mb-2 text-body-secondary">
                Card subtitle
              </h6>

              <p class="card-text">
                Some quick example text to build on the card title
                and make up the bulk of the card's content.
              </p>

              <a href="#" class="card-link">Card link</a>
              <a href="#" class="card-link">Another link</a>

            </div>
          </div>
        </div>

      <?php endfor; ?>

    </div>

    <?php
      print("text");
    ?>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>