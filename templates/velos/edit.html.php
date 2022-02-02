<form action="?type=velo&action=edit" method="post" class="d-flex flex-column w-25">

    <input type="text" name="name" value="<?= $velo->getName() ?>" class="mb-2">
    <input type="text" name="image" value="<?= $velo->getImage() ?>" class="mb-2">
    <input type="text" name="price" value="<?= $velo->getPrice() ?>" class="mb-2">
    <textarea name="description" value="" id="" cols="30" rows="10"><?= $velo->getDescription() ?></textarea>

    <button type="submit" class="btn btn-success" name="id" value="<?= $velo->getId() ?>">Enregistrer</button>

</form>