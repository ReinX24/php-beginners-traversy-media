<?php
$pdo = new PDO(
    "mysql:host=localhost;port=3306;dbname=products_crud",
    "root",
    ""
);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
    <h1>Create new Product</h1>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Product Image</label>
            <br>
            <input type="file">
        </div>
        <div class="mb-3">
            <label class="form-label">Product Title</label>
            <input type="text" class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Product Description</label>
            <textarea class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Product Price</label>
            <input type="number" step="0.01" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>