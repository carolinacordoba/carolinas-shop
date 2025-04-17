<?php
require_once('Models/Product.php');
require_once("components/Footer.php");
require_once("components/Nav.php");
require_once("components/Head.php");
require_once('Models/Database.php');

$dbContext = new Database();



$errorMessage = "";
$username = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {  // om det är felaktigt användarnamn eller lösenord så kastas ett undantag
        // och vi hamnar i catch
        $dbContext->getUsersDatabase()->getAuth()->login($username, $password);
        header('Location: /');
        exit;
    } catch (Exception $e) {
        $errorMessage = "Kunde inte logga in";
    }
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
            <h1>Welcome back, beautiful!</h1>
            <?php
            if ($errorMessage != "") {
                echo "<div class='alert alert-danger' role='alert'>" . $errorMessage . "</div>";
            }
            ?>
            <p>Log in to your Luxé Beauty account and continue your glow journey.</p>
            <form method="POST">
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="text" class="form-control" name="username" placeholder="you@example.com"
                        value="<?php echo $username ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="******" value="">
                </div>
                <input type="submit" class="btn btn-primary" value="Login">
                <a href="/user/register" class="btn btn-secondary">Create account</a>
                <a href="/user/forgot" class="btn btn-secondary">Forgot password</a>
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

<!-- 
<input type="text" name="title" value="<?php echo $product->title ?>">
        <input type="text" name="price" value="<?php echo $product->price ?>">
        <input type="text" name="stockLevel" value="<?php echo $product->stockLevel ?>">
        <input type="text" name="categoryName" value="<?php echo $product->categoryName ?>">
        <input type="submit" value="Uppdatera"> -->