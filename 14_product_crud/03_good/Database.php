<?php

namespace app;

use \PDO; // imports PDO from global namespace

class Database
{
    public PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(
            "mysql:host=localhost;port=3306;dbname=products_crud",
            "root",
            ""
        );

        // Show and throw if there are any errors
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
        return $products = $statement->fetchAll(PDO::FETCH_ASSOC); // associative array
    }
}
