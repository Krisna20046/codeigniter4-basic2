<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Products</h1>
<a href="/products/create" class="btn btn-primary">Add New Product</a>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $counter = 1; // Inisialisasi counter
        foreach ($products as $product): ?>
            <tr>
                <td><?= $counter++ ?></td> <!-- Tampilkan dan tingkatkan counter -->
                <td><?= $product['name'] ?></td>
                <td><?= $product['description'] ?></td>
                <td>Rp <?= $product['price'] ?></td>
                <td>
                    <?php if ($product['image']): ?>
                        <img src="<?= base_url('uploads/' . $product['image']) ?>" width="100">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="/products/edit/<?= $product['id'] ?>" class="btn btn-warning">Edit</a>
                    <form action="/products/delete/<?= $product['id'] ?>" method="post" style="display:inline-block;">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>
