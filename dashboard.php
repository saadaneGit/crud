<?php

require('verifierConnexion.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            background-color: #f8f9fa;
        }
    </style>

    <title>dashboard</title>
</head>

<body>
    <div class="container d-flex flex-column justify-content-center align-items-center h-100">
        <div class="row w-100">
            <div class="col-md-6 text-center img mb-4 mb-md-0 w-100 text-primary">
                <div class="fs-3 fw-bold">
                    <?php
                    echo "bienvenue {$_SESSION['users']['name']}";
                    ?>
                </div>
                <div class="col d-flex justify-content-strat mt-4">
                    <a href="index.php" class="w-100"> <button class="btn btn-primary w-50 "> Liste des Stagiares</button></a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>