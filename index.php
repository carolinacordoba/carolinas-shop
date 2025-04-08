<?php

require_once("Utils/router.php");
require_once("vendor/autoload.php");

$dotenv = Dotenv\Dotenv::createImmutable("."); // . is  current folder for the PAGE
$dotenv->load();

$router = new Router();

$router->addRoute('/', function () {
    require_once(__DIR__ . '/Pages/home.php');
});
$router->addRoute('/category', function () {
    require_once(__DIR__ . '/Pages/category.php');
});
$router->addRoute('/admin/products', function () {
    require_once(__DIR__ . '/Pages/admin.php');
});
$router->addRoute('/admin/edit', function () {
    require_once(__DIR__ . '/Pages/edit.php');
});
$router->addRoute('/admin/new', function () {
    require_once(__DIR__ . '/Pages/new.php');
});
$router->addRoute('/admin/delete', function () {
    require_once(__DIR__ . '/Pages/delete.php');
});

$router->dispatch();
?>