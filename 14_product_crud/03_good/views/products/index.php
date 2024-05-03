<h1>Product List</h1>

<p>
    <a href="/products/create" class="btn btn-success">Create Product</a>
</p>

<form action="">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Search for products" name="search" value="<?= $search; ?>">
        <button class="input-group-text" type="submit">Search</button>
    </div>
</form>


<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Title</th>
            <th scope="col">Price</th>
            <th scope="col">Create Date</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $i => $product) : ?>
            <tr>
                <th scope="row"><?= $i + 1; ?></th>
                <td>
                    <?php if ($product["image"]) : ?>
                        <img src="/<?= $product["image"]; ?>" class="thumb-image">
                    <?php endif; ?>
                </td>
                <td><?= $product["title"]; ?></td>
                <td><?= $product["price"]; ?></td>
                <td><?= $product["create_date"]; ?></td>
                <td>
                    <a href="/products/update?id=<?= $product["id"]; ?>" type="button" class="btn btn-sm btn-outline-primary">Edit</a>

                    <form action="/products/delete" method="POST" class="d-inline-block">
                        <input type="hidden" name="id" value="<?= $product["id"]; ?>">
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>