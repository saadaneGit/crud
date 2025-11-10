<?php

require('verifierConnexion.php');
require 'conexion.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $pdo->prepare("INSERT INTO stagiaires (nom, prenom, email, filiere, photo)  VALUES (:a, :b, :c, :d, :e)");
    $stmt->bindParam(':a', $_POST['nom']);
    $stmt->bindParam(':b', $_POST['prenom']);
    $stmt->bindParam(':c', $_POST['email']);
    $stmt->bindParam(':d', $_POST['filiere']);
    $stmt->bindParam(':e', $_POST['photo']);
    $stmt->execute();
}

$stmt = $pdo->prepare("SELECT * FROM stagiaires ORDER BY id DESC");
$stmt->execute();


// partie de recherche et trier  les stagiaires selon le nom , prénom ou bien la filière 

$search   = isset($_GET['search']) ? ($_GET['search']) : '';
$selected = isset($_GET['selected']) ? ($_GET['selected']) : '';

$ordre = ['id', 'nom', 'prenom', 'filiere'];

$orderChamp = in_array($selected, $ordre) ? $selected : 'id';  // le champ sélectionné si non le champ nom par défault

if ($search != '') {
    // syntaxe pour la recherche et tri des stagiares
    $sql = "SELECT * FROM stagiaires 
                WHERE id LIKE :search  OR nom LIKE :search OR prenom LIKE :search OR filiere LIKE :search ORDER BY $orderChamp ASC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['search' => "%$search%"]);
} else {
    $sql = "SELECT * FROM stagiaires ORDER BY $orderChamp ASC";
    $stmt = $pdo->query($sql);
}





$stagiaires = $stmt->fetchAll(PDO::FETCH_ASSOC); // tableau des objets (enregistrements : stagiares) trouvés

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des Stagiares</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        h2 {
            background-color: aqua;
            text-align: center;
            border-radius: 5px;
            padding: 5px;
            font-weight: bold
        }

        .h2 {
            text-decoration: none;
        }

        div {
            text-align: center;
            align-items: center;
        }

        button,
        .totalStagiaires {
            background-color: greenyellow;
            border: none;
            border-radius: 5px;
            padding: 5px;
            font-weight: bold;
        }

        button:hover {
            cursor: pointer;
            transform: scale(1.05);
            transition: transform 0.3s;
        }


        .modifier,
        .supp {
            font-weight: normal;
            padding: 8px;
        }

        .nouveau {
            background-color: deeppink;
            color: #f0f0f0;
        }

        .modifier {
            background-color: #ffc107;
        }

        .supp {
            background-color: #dc3545;
            color: #f0f0f0;
            margin-top: 5px;
        }

        th,
        td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #ffc107;
        }

        img {
            width: 80px;
        }

        div.container {
            padding: 20px;
        }

        .search {
            border: none;
            background-color: #F6F0EE;
            border-radius: 6px;
            margin-left: 10px;
            height: 35px;
        }

        .bi-search {
            color: #7d7877ff;
        }

        .bi-file-earmark-plus {
            color: #ffffffff;
        }

        div.searchBox {
            background-color: #F6F0EE;
            border-radius: 6px;
            padding-left: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="index.php" class="h2">
            <h2> Liste des Stagiares</h2>
        </a>
        <div class="row">
            <div class="col d-flex justify-content-end ">
                <div class="w-100 totalStagiaires">
                    <div>
                        Total de Stagiaire : <?= count($stagiaires) ?>
                    </div>
                </div>
            </div>
            <div class="col d-flex justify-content-strat ">
                <a href="add.php" class="w-100"> <button class="nouveau w-100 "><i class="bi bi-file-earmark-plus"></i> Nouveau Stagiare</button></a>
            </div>
            <div class="col d-flex justify-content-center ">
                <form action="">
                    <div class="searchBox">
                        <i class="bi bi-search"></i><input type="text" placeholder="  search ... " class="search" name="search">
                    </div>
                </form>

            </div>
            <div class="col d-flex justify-content-end ">
                <div class="me-2">
                    <a href="logOut.php"><img src="logout.png" alt="" height="40px"></a>
                </div>
                <form action="">
                    <select name="selected" class="form-select" aria-label="Default select example" onchange="this.form.submit()">
                        <option selected>Trier par</option>
                        <option value="id">Id</option>
                        <option value="nom">Nom</option>
                        <option value="prenom">Prénom</option>
                        <option value="filiere">Filière</option>
                        <option value="tel">télephone</option>
                    </select>
                </form>
            </div>

        </div>


        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>E-mail</th>
                    <th>Filière</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($stagiaires as $p): ?>
                    <tr class='align-middle'>
                        <td><?= $p['id'] ?></td>
                        <td><?= htmlspecialchars($p['nom']) ?></td>
                        <td><?= htmlspecialchars($p['prenom']) ?></td>
                        <td><?= htmlspecialchars($p['email']) ?></td>
                        <td><?= nl2br(htmlspecialchars($p['filiere'])) ?></td>
                        <td>
                            <img src="<?= htmlspecialchars($p['photo']) ?>" alt="">
                        </td>
                        <td>
                            <a href="edit.php?id=<?= $p['id'] ?>"><button class="modifier">Modifier</button></a> |
                            <a href="delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Supprimer ce stagiaire ?')"><button class="supp">Supprimer</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>