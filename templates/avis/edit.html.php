<h2>Modifier l'avis</h2>
<form action="?type=avis&action=edit" method="post" class="d-flex flex-column w-25">

    <input type="text" name="author" value="<?= $avis->getAuthor() ?>" class="mb-2">
    <textarea name="content" value="" id="" cols="30" rows="10"><?= $avis->getContent() ?></textarea>

    <button type="submit" class="btn btn-success" name="id" value="<?= $avis->getId() ?>">Enregistrer</button>

</form>