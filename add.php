<?php

require('verifierConnexion.php');

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Stagiaires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        h2 {
            background-color: aqua;
            text-align: center;
            border-radius: 5px;
            padding: 5px;
            font-weight: bold
        }
    </style>
</head>

<body class="p-4">

    <div class="container">
        <h2 class="mb-4">Nouveau Stagiaire :</h2>

        <form id="monForm" class="border p-4 rounded bg-light" action="index.php" method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom">
                <div class="text-danger" id="erreurNom" style="display:none;">Veuillez entrer le nom.</div>
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom">
                <div class="text-danger" id="erreurPrix" style="display:none;">Veuillez entrer le prénom.</div>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email">
                <div class="text-danger" id="erreurQuantite" style="display:none;">Veuillez entrer E-mail.</div>
            </div>

            <div class="mb-3">
                <label for="filiere" class="form-label">Filière</label>
                <input type="text" class="form-control" id="filiere" name="filiere">
                <div class="text-danger" id="erreurDescription" style="display:none;">Veuillez entrer la filière.</div>
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Image URL</label>
                <input type="text" class="form-control" id="photo" name="photo">
                <div class="text-danger" id="erreurImage" style="display:none;">Veuillez entrer l'URL de photo.</div>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary w-50">Ajouter le stagiaire</button>
            </div>
        </form>
    </div>