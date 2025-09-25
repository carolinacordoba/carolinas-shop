<?php
require_once("Models/Product.php");
require_once("Models/Database.php");
require_once("Models/CartItem.php");
require_once("Models/Cart.php");
require_once("components/Footer.php");
require_once("components/Head.php");
require_once("components/Nav.php");

$dbContext = new Database();

$userId = null;
$session_id = null;

if ($dbContext->getUsersDatabase()->getAuth()->isLoggedIn()) {
    $userId = $dbContext->getUsersDatabase()->getAuth()->getUserId();
}
$session_id = session_id();

$cart = new Cart($dbContext, $session_id, $userId);

?>
<!DOCTYPE html>
<html lang="en">
<?php Head(); ?>

<body>
    <?php Nav($dbContext, $cart); ?>
    <section class="py-2">
        <div class="container px-4 px-lg-5 mt-5">

            <table class="table">
                <thead>
                    <th>Product</th>
                    <th>Pris</th>
                    <th>Antal</th>
                    <th>Radpris</th>
                    <th>Hantera</th>
                    </th>
                </thead>
                <tbody>
                    <?php foreach ($cart->getItems() as $cartItem) { ?>
                        <tr>
                            <td><?php echo $cartItem->productName; ?></td>
                            <td><?php echo $cartItem->productPrice; ?></td>
                            <td><a href="/deletefromcart?productId=<?php echo $cartItem->productId ?>&fromPage=<?php echo urlencode((empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") ?>"
                                    class="btn btn-dark">-</a> <?php echo $cartItem->quantity; ?> <a
                                    href="/addtocart?productId=<?php echo $cartItem->productId ?>&fromPage=<?php echo urlencode((empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") ?>"
                                    class="btn btn-primary">+</a> </td>
                            <td><?php echo $cartItem->rowPrice; ?></td>
                            <td> <a href="/deletefromcart?removeCount=<?php echo $cartItem->quantity ?>&productId=<?php echo $cartItem->productId ?>&fromPage=<?php echo urlencode((empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]") ?>"
                                    class="btn">DELETE ALL</a> </td>

                        <?php } ?>
                </tbody>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <td>Total: <?php echo $cart->getTotalPrice(); ?> kr</td>
            </table>
            <td>
                <div class="text-end">
                    <a href="/checkout" onclick="onCheckout()" class="btn btn-success">Checkout</a>
                </div>
            </td>
        </div>
    </section>
    <?php Footer(); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>