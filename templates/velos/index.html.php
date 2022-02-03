<?php foreach ($velos as $velo) { ?>

    <div class="mt-3 mb-3 p-3 card">
        <h2><?= $velo->getName() ?></h2>
        <img src="images/<?= $velo->getImage() ?>" alt="">
        <p><?= $velo->getDescription() ?></p>
        <p><?= $velo->getPrice() ?>€</p>
        <p>auteur : <?= $velo->getUser()->getDisplayName() ?></p>
        <a class="btn btn-info w-25" href="?type=velo&action=show&id=<?= $velo->getId() ?>">Voir le vélo</a>
    </div>

<?php } ?>