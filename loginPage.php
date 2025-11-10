<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <style>
        body {
            height: 100vh;
            background-image: url("image/bgnew.webp");
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
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

        .socialMedia {
            text-align: center;

        }
        .logo{
            height : 60px;
            margin-bottom : 50px;
        }
        .login-card {
            background-color : #f7f7f7e0;
            color : #9f0fd2;
        }

        .btn{
            background-color : #9f0fd2;
            color : #ffffffff;
        }

        .error{
            color : #9f0fd2;
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



        <div class="row align-items-center justify-content-center w-100">
            <div class="col-md-6">
                <div class="login-card p-4">
                    <div class="d-flex justify-content-center w-100">
                        <img src="image/logoViolet.png" alt="" class="logo">
                    </div>
                    <form id="monForm" action="loginUsers.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">E-mail</label>
                            <input type="text" class="form-control" placeholder="Votre E-mail ..." id="email" name="email">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Mot de Passe</label>
                            <input type="password" class="form-control " id="password" name="password">
                        </div>

                        <button type="submit" class="btn w-100">Se connecter</button>
                    </form>
                    <div class="socialMedia mt-4">
                        <i class="bi bi-instagram"></i><span class="ms-1 ">techlogo</span>
                        <i class="bi bi-facebook"></i><span class="ms-1 ">techlogo</span>
                    </div>

                    <?php
                    if (isset($_GET['badInformation']) == true && $_GET['badInformation'] == true) {
                        echo '<br><div"><h6 class="error">E-mail ou Mots de passe incorrect</h6></div>';
                    } ?>
                </div>

            </div>
        </div>
    </div>

</body>

</html>