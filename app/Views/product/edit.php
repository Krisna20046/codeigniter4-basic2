<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Edit Product</h1>
<form action="/products/update/<?= $product['id'] ?>" method="post" enctype="multipart/form-data">

    <input type="hidden" name="old_image" value="<?= $product['image'] ?>">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="<?= $product['name'] ?>">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control"><?= $product['description'] ?></textarea>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" name="price" id="price" class="form-control" value="<?= $product['price'] ?>">
    </div>
    <div class="form-group">
        <label for="image">Image</label>
        <input type="file" name="image" id="image" class="form-control">
        <?php if ($product['image']): ?>
            <img src="<?= base_url('uploads/' . $product['image']) ?>" width="100">
        <?php endif; ?>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
<?= $this->endSection() ?>
