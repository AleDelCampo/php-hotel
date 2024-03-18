<!-- Ho cambiato appositamente i nomi delle descrizioni degli Hotel-->
<?php

$hotels = [
    [
        'name' => 'Hotel Belvedere',
        'description' => 'Con funivia da montagna a mare',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel completo di ogni comfort e tecnologia',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Splendido hotel in riva al mare',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Goditi la vista migliore di Europa',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Al centro di Parigi, ma col clima di Milano',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],
];

// Filtra gli hotel per parcheggio
if (isset ($_GET['parkingHotels']) && $_GET['parkingHotels']) {

    $hotels = array_filter($hotels, function ($hotel) {
        return $hotel['parking'] == true;
    });
}

// Filtra gli hotel per voto
if (isset ($_GET['vote']) && is_numeric($_GET['vote'])) {

    $filteredVote = intval($_GET['vote']);

    $hotels = array_filter($hotels, function ($hotel) use ($filteredVote) {
        return $hotel['vote'] == $filteredVote;
    });
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-Hotels</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg-secondary">

    <?php include 'slider.php'; ?>

    <div id="ciao" class="container">

        <h1 class="mb-4 fw-bold text-black">Hotels List:</h1>

        <table class="mb-4 bg-primary-subtle">
            <thead>
                <tr class="bg-warning">
                    <?php

                    foreach ($hotels[0] as $key => $value) {

                        echo "<th class='p-2 text-center border-2 border-black'>$key</th>";
                    }

                    ?>
                </tr>
            </thead>
            <tbody>
                <?php

                foreach ($hotels as $currentHotel) {
                    echo "<tr>";

                    foreach ($currentHotel as $key => $value) {

                        if ($key == 'parking') {
                            echo "<td class='p-2 text-center border-2 border-black text-danger fw-bold'>" . ($value ? 'Yes' : 'No') . "</td>";
                        } else {
                            echo "<td class='p-2 text-center border-2 border-black fw-bold'>$value</td>";
                        }
                    }

                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>

        <form>

            <div class="form-check mb-4">

                <input type="checkbox" class="form-check-input bg-warning border-black" id="parkingHotels" name="parkingHotels" <?php if (isset ($_GET['parkingHotels']))
                    echo "checked"; ?>>
                <label class="form-check-label" for="parkingHotels">Cerchi Hotel con parcheggio??</label>

            </div>

            <div class="form-group mt-2">

                <label for="vote" class="mb-2">Livello Hotel:</label>

                <select class="form-control mb-1" id="vote" name="vote">
                    <option value="">Tutti</option>

                    <?php
                    for ($i = 1; $i <= 5; $i++) {
                        echo "<option value='$i'" . (isset ($_GET['vote']) && $_GET['vote'] == $i ? 'selected' : '') . ">$i</option>";
                    }
                    ?>
                </select>

            </div>

            <button type="submit" class="btn btn-warning border-black">Submit</button>

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>