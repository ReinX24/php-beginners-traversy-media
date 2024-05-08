<?php

require_once "../../database.php";

$search = $_GET["search"] ?? "";

// If the $search is not empty
if ($search) {
    $query_search =
        "SELECT 
            *
        FROM
            products
        WHERE
            title
        LIKE
            :title
        ORDER BY
            create_date 
        DESC";

    $statement = $pdo->prepare($query_search);
    // % means that it searches as a substring
    $statement->bindValue(":title", "%$search%");
} else {
    $query_select_all = "SELECT * FROM products ORDER BY create_date DESC";
    $statement = $pdo->prepare($query_select_all);
}

$statement->execute();
$products = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include_once "../../views/partials/header.php"; ?>

<h1>Products CRUD</h1>

<p><a href="create.php" class="btn btn-success">Create Product</a></p>

<form>
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
                    <img src="../<?= $product["image"]; ?>" alt="product-image" class="thumb-image">
                </td>
                <td><?= $product["title"]; ?></td>
                <td><?= $product["price"]; ?></td>
                <td><?= $product["create_date"]; ?></td>

                <td>
                    <a href="update.php?id=<?= $product["id"]; ?>" class="btn btn-sm btn-outline-primary">Edit</a>

                    <!-- <form action="delete.php" method="POST" class="d-inline-block">
                        <input type="hidden" name="product-id" value="<?= $product["id"]; ?>">
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form> -->
                    <a href="delete.php?id=<?= $product["id"]; ?>" class="btn btn-sm btn-outline-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>

</html>