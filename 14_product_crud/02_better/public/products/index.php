<?php

/** @var $pdo \PDO */
require_once "../../database.php";

$search = $_GET["search"] ?? "";

if ($search) {
    $query =
        "SELECT * FROM 
            products 
        WHERE 
            title 
        LIKE 
            :title 
        ORDER BY 
            create_date DESC";
    $statement = $pdo->prepare($query); // preparing for execution
    $statement->bindValue(":title", "%$search%");
} else {
    $query = "SELECT * FROM products ORDER BY create_date DESC";
    $statement = $pdo->prepare($query); // preparing for execution
}

$statement->execute(); // gets query from database
$products = $statement->fetchAll(PDO::FETCH_ASSOC); // associative array

?>

<?php include_once "../../views/partials/header.php"; ?>

<h1>Products CRUD</h1>

<p>
    <a href="create.php" class="btn btn-success">Create Product</a>
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
                    <img src="/<?= $product["image"]; ?>" class="thumb-image">
                </td>
                <td><?= $product["title"]; ?></td>
                <td><?= $product["price"]; ?></td>
                <td><?= $product["create_date"]; ?></td>
                <td>
                    <a href="update.php?id=<?= $product["id"]; ?>" type="button" class="btn btn-sm btn-outline-primary">Edit</a>

                    <form action="delete.php" method="POST" class="d-inline-block">
                        <input type="hidden" name="id" value="<?= $product["id"]; ?>">
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</body>

</html>