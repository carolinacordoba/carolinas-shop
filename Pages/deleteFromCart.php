<?php

require_once("Models/Database.php");
require_once("Models/Cart.php");

$dbConnection = new Database();

$productId = $_GET['productId'] ?? "";
$fromPage = $_GET['fromPage'] ?? "";
$removeCount = $_GET['removeCount'] ?? 1;

$userId = null;
$session_id = null;

if ($dbConnection->getUsersDatabase()->getAuth()->isLoggedIn()) {
    $userId = $dbConnection->getUsersDatabase()->getAuth()->getUserId();
}
$session_id = session_id();

$cart = new Cart($dbConnection, $session_id, $userId);
$cart->removeItem($productId, $removeCount);

header("Location: $fromPage");