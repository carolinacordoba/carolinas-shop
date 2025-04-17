<?php
require_once('Models/Product.php');
require_once("components/Footer.php");
require_once("components/Nav.php");
require_once("components/Head.php");
require_once('Models/Database.php');

$dbContext = new Database();
// Hämta den produkt med detta ID


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Här kommer vi när man har tryckt  på SUBMIT
    // IMORGON TISDAG SÅ UPDATE PRODUCT SET title = $_POST['title'] WHERE id = $id
    $title = $_POST['title'];
    $stockLevel = $_POST['stockLevel'];
    $price = $_POST['price'];
    $categoryName = $_POST['categoryName'];
    $popularityFactor = $_POST['popularityFactor'];
    $dbContext->insertProduct($title, $stockLevel, $price, $categoryName, $popularityFactor);
    header("Location: /admin/products");
    exit;
} else {
    // Det är INTE ett formulär som har postats - utan man har klickat in på länk tex edit.php?id=12
}

//Kunna lagra i databas


?>

<!DOCTYPE html>
<html lang="en">

<?php Head() ?>

<body>
    <?php Nav(); ?>

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">



            <form method="POST">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" value="">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" name="price" value="">
                </div>
                <div class="form-group">
                    <label for="stockLevel">Stock</label>
                    <input type="text" class="form-control" name="stockLevel" value="">
                </div>
                <div class="form-group">
                    <label for="categpryName">Category name:</label>
                    <input type="text" class="form-control" name="categoryName" value="">
                </div>
                <div class="form-group">
                    <label for="popularityFactor">Popularity factor</label>
                    <input type="number" class="form-control" name="popularityFactor" value="0">
                </div>

                <input type="submit" class="btn btn-primary" value="Skapa">
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