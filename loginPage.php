<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            height: 100vh;
            background-color: #f8f9fa;
        }

        .login-card {
            min-width: 300px;
            background: #fff;
            box-shadow: 0 4px 10px rgba(10, 72, 126, 0.1);
            border-radius: 10px;
        }

        .img img {
            width: 300px;
        }

        .title {
            margin-bottom: 40px;
        }

        h6 {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['users']) == true) {
        header('location: dashboard.php');
    }
    ?>

    <div class="container d-flex flex-column justify-content-center align-items-center h-100">

        <div class="row w-100">
            <div class="col-md-6 text-center img mb-4 mb-md-0 w-100">
                <img src="login.webp" alt="Login Image">
            </div>
        </div>

        <div class="row align-items-center justify-content-center w-100">
            <div class="col-md-6">
                <div class="login-card p-4">

                    <form id="monForm" action="loginUsers.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">E-mail</label>
                            <input type="text" class="form-control" placeholder="Votre E-mail ..." id="email" name="email">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Mot de Passe</label>
                            <input type="password" class="form-control " id="password" name="password">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                    </form>

                    <?php
                    if (isset($_GET['badInformation']) == true && $_GET['badInformation'] == true) {
                        echo '<br><div"><h6 class="text-danger ">E-mail ou Mots de passe incorrect</h6></div>';
                    } ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>