<?php

declare(strict_types=1);

namespace app;

use \PDO;
use app\Models\Product;

class Database
{
    public PDO $pdo;
    public static Database $db;

    public function __construct()
    {
        $this->pdo = new PDO(
            "mysql:host=localhost;port=3306;dbname=products_crud",
            "root",
            ""
        );

        // Enable errors for PDO object
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // The instance is saved in the static property
        self::$db = $this;
    }

    public function getProducts(String $search = ""): array
    {
        // Searching for a specific product
        if ($search) {
            $search_query =
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

            $statement = $this->pdo->prepare($search_query);
            $statement->bindValue(":title", "%$search%");
        } else {
            $select_all_query =
                "SELECT
                    *
                FROM
                    products
                ORDER BY
                    create_date
                DESC";

            $statement = $this->pdo->prepare($select_all_query);
        }

        // Execute the query in the database
        $statement->execute();
        // Return the records as an associative array
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductById(int $id): array
    {
        $product_query =
            "SELECT
                *
            FROM
                products
            WHERE
                id = :id";

        $statement = $this->pdo->prepare($product_query);

        $statement->bindValue(":id", $id);

        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function createProduct(Product $product)
    {
        $create_product_query =
            "INSERT INTO
                products (title, image, description, price, create_date)
            VALUE
                (:title, :image, :description, :price, :date)";

        $statement = $this->pdo->prepare($create_product_query);

        $statement->bindValue(":title", $product->title);
        $statement->bindValue(":image", $product->imagePath);
        $statement->bindValue(":description", $product->description);
        $statement->bindValue(":price", $product->price);
        $statement->bindValue(":date", date("Y-m-d H:i:s"));

        $statement->execute();

        header("Location: index.php");
    }

    public function updateProduct(Product $product)
    {
        $update_product_query =
            "UPDATE
                products
            SET
                title = :title,
                image = :image,
                description = :description,
                price = :price
            WHERE
                id = :id";

        $statement = $this->pdo->prepare($update_product_query);

        $statement->execute();
    }

    public function deleteProduct(int $id)
    {
        // TODO: finish deleteProduct function
        $delete_product_query = "";
    }
}
