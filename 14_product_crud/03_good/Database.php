<?php

namespace app;

use \PDO; // imports PDO from global namespace
use app\models\Product;

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

        // Show and throw if there are any errors
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // The instance is saved in the static property
        self::$db = $this;
    }

    public function getProducts($search = "")
    {
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
            $statement = $this->pdo->prepare($query); // preparing for execution
            $statement->bindValue(":title", "%$search%"); // % is used to search in the db
        } else {
            $query = "SELECT * FROM products ORDER BY create_date DESC";
            $statement = $this->pdo->prepare($query); // preparing for execution
        }

        $statement->execute(); // gets query from database
        return $statement->fetchAll(PDO::FETCH_ASSOC); // associative array
    }

    public function createProduct(Product $product)
    {
        $create_query =
            "INSERT INTO 
                products (title, image, description, price, create_date)
            VALUE 
                (:title, :image, :description, :price, :date)";

        $statement = $this->pdo->prepare($create_query);

        $statement->bindValue(":title", $product->title);
        $statement->bindValue(":image", $product->imageFile);
        $statement->bindValue(":description", $product->description);
        $statement->bindValue(":price", $product->price);
        $statement->bindValue(":date", date("Y-m-d H:i:s"));

        $statement->execute();

        // Redirect the user to the index page
        header("Location: index.php");
    }
}
