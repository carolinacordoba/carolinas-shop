<?php
require_once('Models/Product.php');
require_once("components/Footer.php");
require_once('Models/Database.php');
require_once("components/Nav.php");
require_once("components/Head.php");
require_once("Models/Cart.php");

$dbContext = new Database();



$userId = null;
$session_id = null;

if ($dbContext->getUsersDatabase()->getAuth()->isLoggedIn()) {
    $userId = $dbContext->getUsersDatabase()->getAuth()->getUserId();
}
//$cart = $dbContext->getCartByUser($userId);
$session_id = session_id();

$cart = new Cart($dbContext, $session_id, $userId);



?>

<!DOCTYPE html>
<html lang="en">

<?php Head(); ?>
<?php Nav($dbContext, $cart); ?>

<body>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <h1>Thank you</h1>
            <p>Tack för ditt köp!</p>
        </div>
    </section>



    <?php Footer(); ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

</body>

</html>