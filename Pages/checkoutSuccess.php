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

    <?php

    $googleItems = [];
    foreach ($cart->getItems() as $cartitem) {
        array_push($googleItems, [

            "quantity" => $cartitem->quantity,
            "price" => $cartitem->price,
            "item_id" => $cartitem->id,
            "item_name" => $cartitem->productName,
        ]);
    }

    ?>

    <script>
        gtag("event", "purchase", {
            transaction_id: Math.floor(Math.random() * 99999999),
            currency: "SEK",
            value: <?php echo $cart->getTotalPrice(); ?>,
            items: [
                <?php echo json_encode($googleItems); ?>
            ]
        });
    </script>

    <?php Footer(); ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

</body>

</html>