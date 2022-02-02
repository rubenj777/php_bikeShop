<form action="?type=velo&action=new" method="post" class="d-flex flex-column w-25" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="name" class="mb-2" value="">
    <input type="number" name="price" placeholder="price" class="mb-2" value="">
    <textarea name="description" id="" cols="30" rows="10" value="" placeholder="description" class=" mb-2"></textarea>
    <input type="file" name="imageVelo" id="" class="mb-2">
    <button type="submit" class="btn btn-success" value="<?= $velo->id ?>">Enregistrer</button>
</form>