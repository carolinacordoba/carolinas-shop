<?php
require_once('Models/Product.php');
require_once("components/Footer.php");
require_once("components/Nav.php");
require_once("Models/Database.php");

$id = $_GET["id"];
$dbContext = new Database();
$product = $dbContext->getProduct($id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Här kommer vi när man har tryckt  på SUBMIT
    $product->title = $_POST['title'];
    $product->stockLevel = $_POST['stockLevel'];
    $product->price = $_POST['price'];
    $product->categoryName = $_POST['categoryName'];
    $product->imageUrl = $_POST['imageUrl'];
    echo "<h1>Produkten har uppdaterats</h1>";
} else {
    // Det är INTE ett formulär som har postats - utan man har klickat in på länk tex edit.php?id=12
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>LUXÉ BEAUTY | Modify</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/css/styles.css" rel="stylesheet" />
</head>

<body>
    <?php Nav(); ?>

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">

            <?php

            ?>

            <form method="POST">
                <div class="form-group">
                    <label for="title">Product Name</label>
                    <input type="text" class="form-control" name="title" value="<?php echo $product->title ?>">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" name="price" value="<?php echo $product->price ?>">
                </div>
                <div class="form-group">
                    <label for="stockLevel">Stock</label>
                    <input type="text" class="form-control" name="stockLevel"
                        value="<?php echo $product->stockLevel ?>">
                </div>
                <div class="form-group">
                    <label for="categoryName">Category</label>
                    <input type="text" class="form-control" name="categoryName"
                        value="<?php echo $product->categoryName ?>">
                </div>
                <div class="form-group">
                    <label for="imageUrl">Image</label>
                    <input type="text" class="form-control" name="imageUrl" value="<?php echo $product->imageUrl ?>">
                </div>
                <input type="submit" class="btn btn-primary" value="Update">
            </form>
        </div>
    </section>



    <?php Footer(); ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

</body>

</html>