<?php
require_once('Models/Product.php');
require_once("components/Footer.php");
require_once("components/Nav.php");
require_once("components/Head.php");
require_once('Models/Database.php');

$dbContext = new Database();

?>

<!DOCTYPE html>
<html lang="en">

<?php Head() ?>

<body>
    <?php Nav(); ?>

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <h1>Welcome to the Luxé World ✨</h1>
            <h4>Your account has been created – and your glow journey officially begins.</h4>
            <p>We’re so excited to have you with us. As a Luxé Beauty member, you’ll be the first to know about
                exclusive launches, special offers, and beauty tips tailored just for you.</p>
            <div class="button-group">
                <a href="/" class="btn btn-primary">Start Shopping</a>
                <a href="/user/login" class="btn btn-primary">Log in</a>
            </div>
        </div>
    </section>

    <?php Footer(); ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

</body>

</html>

<!-- 
<input type="text" name="title" value="<?php echo $product->title ?>">
        <input type="text" name="price" value="<?php echo $product->price ?>">
        <input type="text" name="stockLevel" value="<?php echo $product->stockLevel ?>">
        <input type="text" name="categoryName" value="<?php echo $product->categoryName ?>">
        <input type="submit" value="Uppdatera"> -->