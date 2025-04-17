<?php
require_once('Models/Product.php');
require_once("components/Footer.php");
require_once("components/Nav.php");
require_once("components/Head.php");
require_once("Models/Database.php");

$id = $_GET["id"];
$confirmed = $_GET["confirmed"] ?? false;
$dbContext = new Database();
$product = $dbContext->getProduct($id);

if ($confirmed == true) {
    $dbContext->deleteProduct($id);
    header("Location: /admin.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<?php Head() ?>

<body>
    <?php Nav(); ?>

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <h1><?php echo $product->title; ?> </h1>
            <h2>Are you sure that you want to delete?</h2>
            <a href="/admin/delete?id=<?php echo $id; ?>&confirmed=true" class="btn btn-danger">Ja</a>
            <a href="/admin/products" class="btn btn-primary">Nej</a>
        </div>
    </section>



    <?php Footer(); ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

</body>

</html>