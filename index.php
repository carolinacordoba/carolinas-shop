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
$router->addRoute('/user/login', function () {
    require_once(__DIR__ . '/Pages/users/login.php');
});
$router->addRoute('/user/logout', function () {
    require_once(__DIR__ . '/Pages/users/logout.php');
});

$router->addRoute('/user/register', function () {
    require_once(__DIR__ . '/Pages/users/register.php');
});

$router->addRoute('/user/registerThanks', function () {
    require_once(__DIR__ . '/Pages/users/registerThanks.php');
});

$router->addRoute('/search', function () {
    require_once(__DIR__ . '/Pages/search.php');
});

$router->dispatch();
?>