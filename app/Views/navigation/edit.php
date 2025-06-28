<form action="/admin/navigation/update/<?= $link['id'] ?>" method="post">
    <input type="text" name="label" value="<?= $link['label'] ?>">
    <input type="text" name="url" value="<?= $link['url'] ?>">
    <button type="submit">Update</button>
</form>
