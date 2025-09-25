<?php

require_once('Models/UserDatabase.php');
require_once('Models/Cart.php');
require_once('Models/CartItem.php');

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
        $user = $_ENV["USERNAME"];
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
        $this->pdo->query("
        CREATE TABLE IF NOT EXISTS Products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(50),
            price INT,
            stockLevel INT,
            categoryName VARCHAR(50), 
            imageUrl VARCHAR(1000),
            popularityFactor INT,
            shortDescription VARCHAR(400),
            longDescription VARCHAR(1000)
        )
    ");

        $this->pdo->query("
        CREATE TABLE IF NOT EXISTS CartItem ( 
            id INT AUTO_INCREMENT PRIMARY KEY,
            productId INT,
            quantity INT,
            addedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            sessionId VARCHAR(50),
            userId INT NULL,
            FOREIGN KEY (productId) REFERENCES Products(id) ON DELETE CASCADE
        )
    ");
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
            " price = :price, longDescription = :longDescription, shortDescription = :shortDescription, stockLevel = :stockLevel, categoryName = :categoryName, imageUrl = :imageUrl, popularityFactor = :popularityFactor WHERE id = :id";
        $query = $this->pdo->prepare($s);
        $query->execute([
            "title" => $product->title,
            "longDescription" => $product->longDescription,
            "shortDescription" => $product->shortDescription,
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

    function insertProduct($title, $longDescription, $shortDescription, $stockLevel, $price, $categoryName, $imageUrl, $popularityFactor)
    {
        $sql = "INSERT INTO Products (title, longDescription, shortDescription, price, stockLevel, categoryName, imageUrl, popularityFactor) VALUES (:title, :longDescription, :shortDescription, :price, :stockLevel, :categoryName, :imageUrl, :popularityFactor)";
        $query = $this->pdo->prepare($sql);
        $query->execute([
            "title" => $title,
            "longDescription" => $longDescription,
            "shortDescription" => $shortDescription,
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

    function getPopularProducts()
    {
        $query = $this->pdo->query("SELECT * FROM Products ORDER BY popularityFactor DESC LIMIT 10"); // Products är TABELL 
        return $query->fetchAll(PDO::FETCH_CLASS, 'Product'); // Product är PHP Klass
    }

    //FUNTIONER FÖR CART
    function getCartItems($userId, $sessionId)
    {
        if ($userId != null) {
            $query = $this->pdo->prepare("UPDATE CartItem SET userId=:userId WHERE userId IS NULL AND  sessionId = :sessionId");
            $query->execute(['sessionId' => $sessionId, 'userId' => $userId]);
        }

        $query = $this->pdo->prepare("SELECT CartItem.Id as id, CartItem.productId, CartItem.quantity, Products.title as productName, Products.price as productPrice, Products.price * CartItem.quantity as rowPrice     FROM CartItem JOIN Products ON Products.id=CartItem.productId  WHERE userId=:userId or sessionId = :sessionId");
        $query->execute(['sessionId' => $sessionId, 'userId' => $userId]);


        return $query->fetchAll(PDO::FETCH_CLASS, 'CartItem');
    }

    function convertSessionToUser($session_id, $userId, $newSessionId)
    {
        $query = $this->pdo->prepare("UPDATE CartItem SET userId=:userId, sessionId=:newSessionId WHERE sessionId = :sessionId");
        $query->execute(['sessionId' => $session_id, 'userId' => $userId, 'newSessionId' => $newSessionId]);
    }

    function updateCartItem($userId, $sessionId, $productId, $quantity)
    {
        if ($quantity <= 0) {
            $query = $this->pdo->prepare("DELETE FROM CartItem WHERE (userId=:userId or sessionId=:sessionId) AND productId = :productId");
            $query->execute(['userId' => $userId, 'sessionId' => $sessionId, 'productId' => $productId]);
            return;
        }
        $query = $this->pdo->prepare("SELECT * FROM CartItem  WHERE (userId=:userId or sessionId=:sessionId) AND productId = :productId");
        $query->execute(['userId' => $userId, 'sessionId' => $sessionId, 'productId' => $productId]);
        if ($query->rowCount() == 0) {
            $query = $this->pdo->prepare("INSERT INTO CartItem (productId, quantity, sessionId, userId) VALUES (:productId, :quantity, :sessionId, :userId)");
            $query->execute(['userId' => $userId, 'sessionId' => $sessionId, 'productId' => $productId, 'quantity' => $quantity]);
        } else {
            $query = $this->pdo->prepare("UPDATE CartItem SET quantity = :quantity WHERE (userId=:userId or sessionId=:sessionId) AND productId = :productId");
            $query->execute(['userId' => $userId, 'sessionId' => $sessionId, 'productId' => $productId, 'quantity' => $quantity]);
        }
    }
}