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
        <img src="../<?= $product["image"]; ?>" alt="product-image" class="update-image">
    <?php endif; ?>

    <div class="mb-3">
        <label for="image" class="form-label">Product Image</label>
        <input type="file" class="form-control" name="image">
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Product Title</label>
        <input type="text" name="title" class="form-control" value="<?= $title; ?>">
    </div>

    // TODO: finish other fields

</form>