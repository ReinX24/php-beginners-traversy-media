<p><a href="/products" class="btn btn-secondary">Go Back to Products</a></p>

<h1>Delete Product</h1>

<p>Are you sure you want to delete <?= $product["title"]; ?>?</p>

<div class="d-flex gap-2">
    <form method="POST">
        <input type="hidden" name="id" value="<?= $_GET["id"]; ?>">
        <button type="submit" name="submit" value="confirm" class="btn btn-danger">Delete</button>
    </form>
</div>

</body>