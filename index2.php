<?php
require_once "conexion.php";

// 🧾 Ajouter un stagiaire
if (isset($_POST['action']) && $_POST['action'] === 'ajouter') {
    $stmt = $pdo->prepare("INSERT INTO stagiaires (nom, prenom, email, filiere, photo) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['filiere'], $_POST['photo']]);
    $message = "✅ Stagiaire ajouté avec succès !";
}

// 🧾 Modifier un stagiaire
if (isset($_POST['action']) && $_POST['action'] === 'modifier') {
    $stmt = $pdo->prepare("UPDATE stagiaires SET nom=?, prenom=?, email=?, filiere=?, photo=? WHERE id=?");
    $stmt->execute([$_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['filiere'], $_POST['photo'], $_POST['id']]);
    $message = " Informations mises à jour avec succès !";
}

// 🧾 Supprimer un stagiaire
if (isset($_GET['supprimer'])) {
    $id = $_GET['supprimer'];
    $stmt = $pdo->prepare("DELETE FROM stagiaires WHERE id=?");
    $stmt->execute([$id]);
    $message = "🗑️ Stagiaire supprimé avec succès !";
}

// 📜 Récupérer les stagiaires
$stagiaires = $pdo->query("SELECT * FROM stagiaires")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Stagiaires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
        <h2 class="mb-4">Gestion des Stagiaires</h2>

        <?php if (!empty($message)) : ?>
            <div class="alert alert-info text-center" id="alertMessage"><?= $message ?></div>
        <?php endif; ?>







        <div class="text-end mb-3">
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAjout">+ Nouveau Stagiaire</button>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Filière</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stagiaires as $stg): ?>
                    <tr>
                        <td><?= $stg['id'] ?></td>
                        <td><?= htmlspecialchars($stg['nom']) ?></td>
                        <td><?= htmlspecialchars($stg['prenom']) ?></td>
                        <td><?= htmlspecialchars($stg['email']) ?></td>
                        <td><?= htmlspecialchars($stg['filiere']) ?></td>
                        <td><img src="<?= htmlspecialchars($stg['photo']) ?>" width="50"></td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalModifier"
                                data-id="<?= $stg['id'] ?>"
                                data-nom="<?= htmlspecialchars($stg['nom']) ?>"
                                data-prenom="<?= htmlspecialchars($stg['prenom']) ?>"
                                data-email="<?= htmlspecialchars($stg['email']) ?>"
                                data-filiere="<?= htmlspecialchars($stg['filiere']) ?>"
                                data-photo="<?= htmlspecialchars($stg['photo']) ?>">
                                Modifier
                            </button>
                            <a href="?supprimer=<?= $stg['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- 🧩 Modal Ajout -->
    <div class="modal fade" id="modalAjout" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" onsubmit="return confirm('Confirmer l’ajout du stagiaire ?')">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un Stagiaire</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="action" value="ajouter">
                        <div class="mb-3"><label>Nom</label><input type="text" name="nom" class="form-control" required></div>
                        <div class="mb-3"><label>Prénom</label><input type="text" name="prenom" class="form-control" required></div>
                        <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
                        <div class="mb-3"><label>Filière</label><input type="text" name="filiere" class="form-control" required></div>
                        <div class="mb-3"><label>Photo (URL)</label><input type="text" name="photo" class="form-control"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 🧩 Modal Modifier -->
    <div class="modal fade" id="modalModifier" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" onsubmit="return confirm('Confirmer la mise à jour ?')">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier Stagiaire</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="action" value="modifier">
                        <input type="hidden" name="id" id="modif-id">
                        <div class="mb-3"><label>Nom</label><input type="text" name="nom" id="modif-nom" class="form-control" required></div>
                        <div class="mb-3"><label>Prénom</label><input type="text" name="prenom" id="modif-prenom" class="form-control" required></div>
                        <div class="mb-3"><label>Email</label><input type="email" name="email" id="modif-email" class="form-control" required></div>
                        <div class="mb-3"><label>Filière</label><input type="text" name="filiere" id="modif-filiere" class="form-control" required></div>
                        <div class="mb-3"><label>Photo (URL)</label><input type="text" name="photo" id="modif-photo" class="form-control"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // 🧠 Remplir automatiquement la modal de modification
        document.addEventListener('DOMContentLoaded', () => {
            const modalModifier = document.getElementById('modalModifier');
            modalModifier.addEventListener('show.bs.modal', event => {
                const button = event.relatedTarget;
                document.getElementById('modif-id').value = button.getAttribute('data-id');
                document.getElementById('modif-nom').value = button.getAttribute('data-nom');
                document.getElementById('modif-prenom').value = button.getAttribute('data-prenom');
                document.getElementById('modif-email').value = button.getAttribute('data-email');
                document.getElementById('modif-filiere').value = button.getAttribute('data-filiere');
                document.getElementById('modif-photo').value = button.getAttribute('data-photo');
            });
        });


        document.addEventListener("DOMContentLoaded", function() {
            const alertMessage = document.getElementById("alertMessage");
            if (alertMessage) {
                setTimeout(() => {
                    alertMessage.setAttribute("hidden", true);
                }, 3000);
            }
        });
    </script>


</body>

</html>