<!-- Checking if there are any errors. -->
<?php if (!empty($errors)) : ?>
    <div class="alert alert-danger">
        <?php foreach ($errors as $error) : ?>
            <div><?= $error; ?></div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<!-- Form for our product information, multipart/form-data is for photos. -->
<!-- This form will be used for creating and updating product records. -->
<form method="POST" enctype="multipart/form-data">

    <!-- Checks if the products has a stored image -->
    <?php if ($product["image"]) : ?>
        <img src="../<?= $product["image"]; ?>" class="update-image">
    <?php endif; ?>

    <div class="mb-3">
        <label for="image" class="form-label">Product Image</label>
        <input type="file" class="form-control" name="image">
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Product Title</label>
        <input type="text" name="title" class="form-control" value="<?= $title; ?>">
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Product Description</label>
        <textarea name="description" class="form-control"><?= $description; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Product Price</label>
        <input type="number" step="0.01" name="price" class="form-control" value="<?= $price; ?>">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>