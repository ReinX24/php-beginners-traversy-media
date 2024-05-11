<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error) : ?>
            <div><?= $error; ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="POST" enctype=multipart/form-data>

    <?php if ($product["image"]) : ?>
        <img src="/<?= $product["image"]; ?>" class="update-image">
    <?php endif; ?>

    <div class="mb-3">
        <label for="product-image" class="form-label">
            <h4>Product Image</h4>
        </label>
        <input type="file" class="form-control" name="image">
    </div>

    <div class="mb-3">
        <label for="title" class="form-label">
            <h4>Product Title</h4>
        </label>
        <input type="text" class="form-control" name="title" value="<?= $product["title"]; ?>">
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">
            <h4>Product Description</h4>
        </label>
        <textarea class="form-control" name="description"><?= $product["description"]; ?></textarea>
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">
            <h4>Product Price</h4>
        </label>
        <input type="number" step="0.01" class="form-control" name="price" value="<?= $product["price"]; ?>">
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>

</form>