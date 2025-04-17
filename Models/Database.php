<?php

require_once('Models/UserDatabase.php');

class Database
{
    public $pdo;

    private $usersDatabase;
    function getUsersDatabase()
    {
        return $this->usersDatabase;
    }

    function __construct()
    {
        $host = $_ENV["HOST"];
        $db = $_ENV["DB"];
        $user = $_ENV["USER"];
        $pass = $_ENV["PASSWORD"];
        $port = $_ENV["PORT"];

        $dsn = "mysql:host=$host:$port;dbname=$db";
        $this->pdo = new PDO($dsn, $user, $pass);
        $this->initDatabase();
        $this->usersDatabase = new UserDatabase($this->pdo);
        $this->usersDatabase->setupUsers();
        $this->usersDatabase->seedUsers();
    }

    function initDatabase()
    {
        $this->pdo->query("CREATE TABLE IF NOT EXISTS Products (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(50),
                price INT,
                stockLevel INT,
                categoryName VARCHAR(50), 
                popularityFactor INT
            )");
    }

    function getProduct($id)
    {
        $query = $this->pdo->prepare("SELECT * FROM Products WHERE id = :id");
        $query->execute(["id" => $id]);
        $query->setFetchMode(PDO::FETCH_CLASS, "Product");
        return $query->fetch();
    }

    function updateProduct($product)
    {
        $s = "UPDATE Products SET title = :title," .
            " price = :price, stockLevel = :stockLevel, categoryName = :categoryName, imageUrl = :imageUrl WHERE id = :id";
        $query = $this->pdo->prepare($s);
        $query->execute([
            "title" => $product->title,
            "price" => $product->price,
            "stockLevel" => $product->stockLevel,
            "categoryName" => $product->categoryName,
            "id" => $product->id,
            "imageUrl" => $product->imageUrl,
            "popularityFactor" => $product->popularityFactor
        ]);
    }

    function deleteProduct($id)
    {
        $query = $this->pdo->prepare("DELETE FROM Products WHERE id = :id");
        $query->execute(["id" => $id]);
    }

    function insertProduct($title, $stockLevel, $price, $categoryName, $imageUrl, $popularityFactor)
    {
        $sql = "INSERT INTO Products (title, price, stockLevel, categoryName, imageUrl, popularityFactor) VALUES (:title, :price, :stockLevel, :categoryName, :imageUrl, :popularityFactor)";
        $query = $this->pdo->prepare($sql);
        $query->execute([
            "title" => $title,
            "price" => $price,
            "stockLevel" => $stockLevel,
            "categoryName" => $categoryName,
            "imageUrl" => $imageUrl,
            "popularityFactor" => $popularityFactor

        ]);
    }

    function getAllProducts($sortCol = "id", $sortOrder = "asc")
    {
        if (!in_array($sortCol, ["id", "title", "price", "stockLevel"])) {
            $sortCol = "id";
        }
        if (!in_array($sortOrder, ["asc", "desc"])) {
            $sortOrder = "asc";
        }

        $query = $this->pdo->query("SELECT * FROM Products ORDER BY $sortCol $sortOrder"); // Products är TABELL 
        return $query->fetchAll(PDO::FETCH_CLASS, "Product"); // Product är PHP Klass
    }

    function getCategoryProducts($catName)
    {
        if ($catName == "") {
            $query = $this->pdo->query("SELECT * FROM Products");
            return $query->fetchAll(PDO::FETCH_CLASS, "Product");
        }
        $query = $this->pdo->prepare("SELECT * FROM Products WHERE categoryName = :categoryName");
        $query->execute(["categoryName" => $catName]);
        return $query->fetchAll(PDO::FETCH_CLASS, "Product");
    }

    function getAllCategories()
    {
        // SELECT DISTINCT categoryName FROM Products
        $data = $this->pdo->query("SELECT DISTINCT categoryName FROM Products")->fetchAll(PDO::FETCH_COLUMN);
        return $data;
    }

    function searchProducts($q, $sortCol, $sortOrder)
    {
        if (!in_array($sortCol, ["title", "price"])) {
            $sortCol = "title";
        }
        if (!in_array($sortOrder, ["asc", "desc"])) {
            $sortOrder = "asc";
        }

        $query = $this->pdo->prepare("SELECT * FROM Products WHERE title LIKE :q or categoryName like :q ORDER BY $sortCol $sortOrder");
        $query->execute(['q' => "%$q%"]);
        return $query->fetchAll(PDO::FETCH_CLASS, 'Product');
    }
}