<?php

require('verifierConnexion.php');
require_once "conexion.php";


if (!isset($_GET['id'])) {
    die("Aucun stagiaire sélectionné pour la modification.");
}

$id = $_GET['id'];

// Récupérer les infos du stagiaire
$stmt = $pdo->prepare("SELECT * FROM stagiaires WHERE id = ?");
$stmt->execute([$id]);
$stagiaire = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$stagiaire) {
    die("Stagiaire introuvable !");
}

// Si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $filiere = $_POST['filiere'];
    $photo = $_POST['photo'];

    $update = $pdo->prepare("UPDATE stagiaires SET nom=?, prenom=?, email=?, filiere=?, photo=? WHERE id=?");
    $update->execute([$nom, $prenom, $email, $filiere, $photo, $id]);

    // Redirection vers l'accueil après modification
    header("Location: index.php?message=Stagiaire modifié avec succès");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Stagiaire</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        h2 {
            background-color: aqua;
            text-align: center;
            border-radius: 5px;
            padding: 5px;
            font-weight: bold;
        }
    </style>
</head>

<body class="p-4">
    <div class="container">
        <h2 class="mb-4">Modifier Stagiaire :</h2>

        <form class="border p-4 rounded bg-light" method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($stagiaire['nom']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($stagiaire['prenom']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($stagiaire['email']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="filiere" class="form-label">Filière</label>
                <input type="text" class="form-control" id="filiere" name="filiere" value="<?= htmlspecialchars($stagiaire['filiere']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Image URL</label>
                <input type="text" class="form-control" id="photo" name="photo" value="<?= htmlspecialchars($stagiaire['photo']) ?>" required>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-success w-50">Mettre à jour</button>
            </div>
        </form>
    </div>
</body>

</html>