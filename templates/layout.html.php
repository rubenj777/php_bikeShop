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
        <a href="/phpExam" class="navbar-brand ms-5" id="logo">Vélo 2000</a>
        <div>
            <a href="?type=velo&action=new" class="me-5 btn btn-success">Créer un vélo</a>
        </div>
    </nav>



    <div class="alert alert-warning alert-dismissible fade <?php if ($_GET['info'] == 'errDel') {
                                                                echo "show";
                                                            } ?>" role="alert">
        <p>Suppression impossible</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="alert alert-warning alert-dismissible fade <?php if ($_GET['info'] == 'noId') {
                                                                echo "show";
                                                            } ?>" role="alert">
        <p>Cet id n'existe pas</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <div class="container">

        <?= $pageContent ?>
    </div>




    <footer class="text-center bg-dark mb-0 mt-5 p-3">
        <p class="m-0">Vélo 2000</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>