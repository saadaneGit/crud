<?php

require 'conexion.php'; // inclut ton fichier de connexion

// Vérifie si un ID est passé dans l'URL
if (isset($_GET['id'])) {
    $id = (int) $_GET['id']; // sécurité : conversion en entier

    // Prépare la requête de suppression
    $stmt = $pdo->prepare("DELETE FROM stagiaires WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    // Exécute la suppression
    if ($stmt->execute()) {
        // Retour à la page principale (liste)
        header("Location: index.php?message=stagiaire_supprime");
        exit;
    } else {
        echo "❌ Erreur lors de la suppression du stagiaire.";
    }
} else {
    echo "⚠️ Aucun ID de stagiaire spécifié.";
}
