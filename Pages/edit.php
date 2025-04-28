<?php
require_once('Models/Product.php');
require_once("components/Footer.php");
require_once("components/Nav.php");
require_once("components/Head.php");
require_once("Models/Database.php");
require_once("Utils/Validator.php");


$id = $_GET["id"];
$dbContext = new Database();
$product = $dbContext->getProduct($id);
$v = new Validator($_POST);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Här kommer vi när man har tryckt  på SUBMIT
    $product->title = $_POST['title'];
    $product->stockLevel = $_POST['stockLevel'];
    $product->price = $_POST['price'];
    $product->categoryName = $_POST['categoryName'];
    $product->imageUrl = $_POST['imageUrl'];
    $dbContext->updateProduct($product);
    echo "<h1>The products has been updated</h1>";

    $v->field('title')->required()->alpha_num([' '])->min_len(3)->max_len(50);
    $v->field('stockLevel')->required()->numeric()->min_val(0);
    $v->field('price')->required()->numeric()->min_val(0);
    $v->field('categoryName')->required()->alpha_num([''])->min_len(3)->max_len(50);
    $v->field('popularityFactor')->required()->numeric()->min_val(0);

    if ($v->is_valid()) {

        // SKICKA MAILET!!!
        // $mail = new PHPMailer\PHPMailer\PHPMailer(true);
        // $mail->isSMTP();
        // $mail->Host = 'smtp.ethereal.email';
        // $mail->SMTPAuth = true;
        // $mail->Username = 'mariah.hegmann52@ethereal.email';
        // $mail->Password = 'F91kB6CXj2jwwwCuzf';
        // $mail->SMTPSecure = 'tls';
        // $mail->Port = 587;

        // $mail->From = "carolin@postergalleriet.com";
        // $mail->FromName = "Postergalleriet"; //To address and name 
        // $mail->addAddress("bill.gates@microsoft.com"); //Address to which recipient will reply 
        // $mail->addReplyTo("noreply@ysuperdupershop.com", "No-Reply"); //CC and BCC 
        // $mail->isHTML(true);
        // $mail->Subject = "Orderbekräftelse-postergalleriet";
        // $mail->Body = "<h2>Hej</h2>, Vilket kul nyhetsbrev <b>fdsfds</b>";
        // $mail->send();
        // OK - spara i databas
        $dbContext->updateProduct($product);
        header("Location: /admin/products");
        exit;
    }

} else {
    // Det är INTE ett formulär som har postats - utan man har klickat in på länk tex edit.php?id=12
}

?>

<!DOCTYPE html>
<html lang="en">

<?php Head() ?>

<body>
    <?php Nav(); ?>

    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">

            <?php

            ?>

            <form method="POST">
                <div class="form-group">
                    <label for="title">Product Name</label>
                    <input type="text"
                        class="form-control  <?php echo $v->get_error_message('title') != "" ? "is-invalid" : "" ?>"
                        name=" title" value="<?php echo $product->title ?>">
                    <!-- Valideringemeddelandet ska ligga här -->
                    <span class="invalid-feedback"><?php echo $v->get_error_message('title'); ?></span>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number"
                        class="form-control  <?php echo $v->get_error_message('price') != "" ? "is-invalid" : "" ?>"
                        name="price" value="<?php echo $product->price ?>">
                    <span class="invalid-feedback"><?php echo $v->get_error_message('price'); ?></span>
                </div>
                <div class="form-group">
                    <label for="stockLevel">Stock</label>
                    <input type="number"
                        class="form-control  <?php echo $v->get_error_message('stockLevel') != "" ? "is-invalid" : "" ?>"
                        name="stockLevel" value="<?php echo $product->stockLevel ?>">
                    <span class="invalid-feedback"><?php echo $v->get_error_message('stockLevel'); ?></span>
                </div>
                <div class="form-group">
                    <label for="categoryName">Category</label>
                    <input type="text"
                        class="form-control  <?php echo $v->get_error_message('categoryName') != "" ? "is-invalid" : "" ?>"
                        name="categoryName" value="<?php echo $product->categoryName ?>">
                    <span class="invalid-feedback"><?php echo $v->get_error_message('categoryName'); ?></span>
                </div>
                <div class="form-group">
                    <label for="imageUrl">Image</label>
                    <input type="text"
                        class="form-control  <?php echo $v->get_error_message('imageUrl') != "" ? "is-invalid" : "" ?>"
                        name="imageUrl" value="<?php echo $product->imageUrl ?>">
                    <span class="invalid-feedback"><?php echo $v->get_error_message('imageUrl'); ?></span>
                </div>
                <div class="form-group">
                    <label for="popularityFactor">Popularity factor</label>
                    <input type="number"
                        class="form-control  <?php echo $v->get_error_message('popularityFactor') != "" ? "is-invalid" : "" ?>"
                        name="popularityFactor" value="<?php echo $product->popularityFactor ?>">
                    <span class="invalid-feedback"><?php echo $v->get_error_message('popularityFactor'); ?></span>
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