
<?php
include("db.php");

$games = [
    "Skylanders Spyro's Adventure",
    "Skylanders Giants",
    "Skylanders Swap Force",
    "Skylanders Trap Team",
    "Skylanders SuperChargers",
    "Skylanders Imaginators",
];

$elements = [
    "Air", "Dark", "Earth", "Fire", "Life",
    "Light", "Magic", "Tech", "Undead", "Water"
];

$error = '';

$v = [
    'Skylander_ID'    => '',
    'Skylander_Name'  => '',
    'Game_Name'       => '',
    'Element'         => '',
    'Series_Var'      => '',
    'Ingame_Var'      => '',
    'Skylander_Price' => '',
];

// Load every Skylander, sorted by ID (lowest first).
$skylanders = [];

$result = $mysqli->query(
    "SELECT Skylander_ID, Skylander_Name
     FROM Skylanders
     ORDER BY Skylander_ID ASC"
);

while ($row = $result->fetch_assoc()) {
    $skylanders[] = $row;
}

// Handle form submission.
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $v['Skylander_ID'] = trim($_POST['Skylander_ID'] ?? '');
    $v['Skylander_Name'] = trim($_POST['Skylander_Name'] ?? '');
    $v['Game_Name'] = trim($_POST['Game_Name'] ?? '');
    $v['Element'] = trim($_POST['Element'] ?? '');
    $v['Series_Var'] = trim($_POST['Series_Var'] ?? '');
    $v['Ingame_Var'] = trim($_POST['Ingame_Var'] ?? '');
    $v['Skylander_Price'] = trim($_POST['Skylander_Price'] ?? '');

    $validPrice = $v['Skylander_Price'] !== ''
        && is_numeric($v['Skylander_Price'])
        && is_finite((float)$v['Skylander_Price'])
        && (float)$v['Skylander_Price'] >= 0;

    if (
        !ctype_digit($v['Skylander_ID']) ||
        (int)$v['Skylander_ID'] < 1 ||
        $v['Skylander_Name'] === '' ||
        !in_array($v['Game_Name'], $games, true) ||
        !in_array($v['Element'], $elements, true) ||
        $v['Series_Var'] === '' ||
        !ctype_digit($v['Series_Var']) ||
        (int)$v['Series_Var'] > 127 ||
        !$validPrice
    ) {
        $error = "Please enter valid details in all required fields.";
    } else {
        try {
            $id = (int)$v['Skylander_ID'];

            // Check that the selected Skylander exists.
            $stmt = $mysqli->prepare(
                "SELECT Skylander_ID
                 FROM Skylanders
                 WHERE Skylander_ID = ?"
            );

            $stmt->bind_param("i", $id);
            $stmt->execute();

            $exists = $stmt->get_result()->fetch_assoc();

            if (!$exists) {
                $error = "The selected Skylander no longer exists.";
            } else {
                $series = (int)$v['Series_Var'];
                $price = (float)$v['Skylander_Price'];

                $sql = "UPDATE Skylanders
                        SET Skylander_Name = ?,
                            Game_Name = ?,
                            Element = ?,
                            Series_Var = ?,
                            Ingame_Var = ?,
                            Skylander_Price = ?
                        WHERE Skylander_ID = ?";

                $stmt = $mysqli->prepare($sql);

                // Correct: seven type characters for seven variables.
                $stmt->bind_param(
                    "sssisdi",
                    $v['Skylander_Name'],
                    $v['Game_Name'],
                    $v['Element'],
                    $series,
                    $v['Ingame_Var'],
                    $price,
                    $id
                );

                $stmt->execute();

                header("Location: Details.php?id=" . $id);
                exit();
            }

        } catch (mysqli_sql_exception $e) {
            error_log($e->getMessage());
            $error = "A database error occurred while saving changes.";
        }
    }
}

// Load existing Skylander when opened using an Edit link.
elseif (isset($_GET['id'])) {

    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if ($id !== false && $id > 0) {

        $stmt = $mysqli->prepare(
            "SELECT *
             FROM Skylanders
             WHERE Skylander_ID = ?"
        );

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $row = $stmt->get_result()->fetch_assoc();

        if ($row) {
            $v['Skylander_ID'] = (string)$row['Skylander_ID'];
            $v['Skylander_Name'] = $row['Skylander_Name'];
            $v['Game_Name'] = $row['Game_Name'];
            $v['Element'] = $row['Element'];
            $v['Series_Var'] = (string)$row['Series_Var'];
            $v['Ingame_Var'] = $row['Ingame_Var'] ?? '';
            $v['Skylander_Price'] = number_format(
                (float)$row['Skylander_Price'],
                2,
                '.',
                ''
            );
        } else {
            $error = "No Skylander found with that ID.";
        }

    } else {
        $error = "Invalid Skylander ID.";
    }
}

// Preserve existing saved values even if they are not in the lists.
if (
    $v['Game_Name'] !== '' &&
    !in_array($v['Game_Name'], $games, true)
) {
    array_unshift($games, $v['Game_Name']);
}

if (
    $v['Element'] !== '' &&
    !in_array($v['Element'], $elements, true)
) {
    array_unshift($elements, $v['Element']);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Edit a Skylander</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<?php include("Navbar.php"); ?>

<div class="container mt-4 mb-5">

    <h1>Edit a Skylander</h1>

    <?php if ($error !== ''): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="Edit_Skylander.php" method="post">

        <!-- Skylander dropdown -->
        <div class="mb-3">

            <label for="Skylander_ID" class="form-label">
                Select Skylander
            </label>

            <select
                class="form-select"
                id="Skylander_ID"
                name="Skylander_ID"
                required
            >
                <option value="">Choose a Skylander</option>

                <?php foreach ($skylanders as $skylander): ?>
                    <option
                        value="<?= (int)$skylander['Skylander_ID'] ?>"
                        <?= (string)$skylander['Skylander_ID'] === $v['Skylander_ID']
                            ? 'selected'
                            : '' ?>
                    >
                        <?= htmlspecialchars($skylander['Skylander_Name']) ?>
                        (ID: <?= (int)$skylander['Skylander_ID'] ?>)
                    </option>
                <?php endforeach; ?>

            </select>

            <div class="form-text">
                Select the Skylander you want to edit.
            </div>

        </div>

        <!-- Skylander name -->
        <div class="mb-3">

            <label for="Skylander_Name" class="form-label">
                Skylander name
            </label>

            <input
                type="text"
                class="form-control"
                id="Skylander_Name"
                name="Skylander_Name"
                required
                value="<?= htmlspecialchars($v['Skylander_Name']) ?>"
            >

        </div>

        <!-- Game dropdown -->
        <div class="mb-3">

            <label for="Game_Name" class="form-label">Game</label>

            <select
                class="form-select"
                id="Game_Name"
                name="Game_Name"
                required
            >
                <option value="">Choose a game</option>

                <?php foreach ($games as $g): ?>
                    <option
                        value="<?= htmlspecialchars($g) ?>"
                        <?= $g === $v['Game_Name'] ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($g) ?>
                    </option>
                <?php endforeach; ?>

            </select>

        </div>

        <!-- Element dropdown -->
        <div class="mb-3">

            <label for="Element" class="form-label">Element</label>

            <select
                class="form-select"
                id="Element"
                name="Element"
                required
            >
                <option value="">Choose an element</option>

                <?php foreach ($elements as $el): ?>
                    <option
                        value="<?= htmlspecialchars($el) ?>"
                        <?= $el === $v['Element'] ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($el) ?>
                    </option>
                <?php endforeach; ?>

            </select>

        </div>

        <!-- Series -->
        <div class="mb-3">

            <label for="Series_Var" class="form-label">Series</label>

            <input
                type="number"
                class="form-control"
                id="Series_Var"
                name="Series_Var"
                min="0"
                max="127"
                step="1"
                required
                value="<?= htmlspecialchars($v['Series_Var']) ?>"
            >

        </div>

        <!-- In-game variant -->
        <div class="mb-3">

            <label for="Ingame_Var" class="form-label">
                In-game variant (optional)
            </label>

            <input
                type="text"
                class="form-control"
                id="Ingame_Var"
                name="Ingame_Var"
                value="<?= htmlspecialchars($v['Ingame_Var']) ?>"
            >

        </div>

        <!-- Price -->
        <div class="mb-3">

            <label for="Skylander_Price" class="form-label">
                Price (£)
            </label>

            <input
                type="number"
                class="form-control"
                id="Skylander_Price"
                name="Skylander_Price"
                min="0"
                step="0.01"
                required
                value="<?= htmlspecialchars($v['Skylander_Price']) ?>"
            >

        </div>

        <button type="submit" class="btn btn-primary">
            Save Changes
        </button>

    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
