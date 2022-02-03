<a href="?type=velo&action=index" class="me-5 btn btn-success">Retour</a>

<div class="mt-3 mb-5 p-3 card">
    <h2><?= $velo->getName() ?></h2>
    <img src="images/<?= $velo->getImage() ?>" alt="">
    <p><?= $velo->getDescription() ?></p>
    <p><?= $velo->getPrice() ?>€</p>
    <p>auteur : <?= $velo->getUser()->getDisplayName() ?></p>
    <div class="d-flex">
        <a class="btn btn-info w-25 me-2" href="?type=velo&action=edit&id=<?= $velo->getId() ?>">Modifier le vélo</a>
        <form action="?type=velo&action=delete" method="post">
            <button type="submit" name="id" value="<?= $velo->getId() ?>" class="btn btn-danger">Supprimer le vélo</button>
        </form>
    </div>
</div>


<!-- ici le formulaire et l'affichage des avis -->
<?php if($_SESSION) { ?>

<?php if (!$velo->getAvis()) { ?>
    <p>Soyez le premier à donner votre avis sur le <?= $velo->getName() ?> </p>
<?php } ?>

<form class="" action="?type=avis&action=new" method="post">

    <div class="form-group mb-2">
        <textarea type="text" name="content" id="" placeholder="Votre avis"></textarea>
    </div>
    <div class="form-group mb-2">
        <button type="submit" name="veloId" value="<?= $velo->getId() ?>" class="btn btn-success">Poster</button>
    </div>
</form>
<?php } else { ?>
    <p>Connectez-vous pour donner votre avis sur le <?= $velo->getName() ?> !</p>
    <?php } ?>

<?php foreach ($velo->getAvis() as $avis) { ?>
    <div class="row p-2 mt-2 mb-2 card">
        <h5><?= $avis->getUser()->getDisplayName() ?></h5>
        <p><?= $avis->getContent() ?></p>
        <div class="d-flex">
            <a class="btn btn-info w-25 me-2" href="?type=avis&action=edit&id=<?= $avis->getId() ?>">Modifier l'avis</a>
            <form action="?type=avis&action=delete" method="post">
                <button type="submit" name="id" value="<?= $avis->getId() ?>" class="btn btn-warning">Supprimer l'avis</button>
            </form>
        </div>
    </div>
<?php } ?>