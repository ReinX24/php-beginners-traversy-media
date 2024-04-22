<?php
$pdo = new PDO(
    "mysql:host=localhost;port=3306;dbname=products_crud",
    "root",
    ""
);

// Show and throw if there are any errors
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$query = "SELECT * FROM products ORDER BY create_date DESC";

$statement = $pdo->prepare($query); // preparing for execution
$statement->execute(); // gets query from database
$products = $statement->fetchAll(PDO::FETCH_ASSOC); // associative array
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="app.css">


    <title>Products CRUD</title>
</head>

<body>
    <h1>Products CRUD</h1>

    <p>
        <a href="create.php" class="btn btn-success">Create Product</a>
    </p>

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
                    <td></td>
                    <td><?= $product["title"]; ?></td>
                    <td><?= $product["price"]; ?></td>
                    <td><?= $product["create_date"]; ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-outline-primary">Edit</button>
                        <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>