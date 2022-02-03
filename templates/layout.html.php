<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vélo 2000 - <?= $pageTitle ?></title>
    <link rel="stylesheet" href="https://bootswatch.com/5/lux/bootstrap.min.css">
    <link rel="stylesheet" href="templates/style.css">
</head>

<body>

    <nav class="navbar nav-expand-lg navbar-light bg-dark mb-5 justify-content-between">
        <div>
            <a href="/cyclisterie" class="navbar-brand ms-5 mb-0" id="logo">Vélo 2000</a>
            <a href="?type=velo&action=new" class="me-5 btn btn-success">Créer un vélo</a>
        </div>

        <div class="d-flex align-items-center">
            <?php if(!$_SESSION) { ?>
            <a href="?type=user&action=signUp" class="me-5 btn btn-success">Inscription</a>
            <a href="?type=user&action=signIn" class="me-5 btn btn-success">Connexion</a>
            <?php } else { ?>
                <p class="me-5 mb-0 text-light">Bonjour, <?= $_SESSION['user']['displayName'] ?></p>
            <a href="?type=user&action=signOut" class="me-5 btn btn-success">Déconnexion</a>
            <?php } ?>
        </div>
    </nav>

    <div class="container">
        <?= $pageContent ?>
    </div>




    <footer class="text-center bg-dark mb-0 mt-5 p-3">
        <p class="m-0">Vélo 2000</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>