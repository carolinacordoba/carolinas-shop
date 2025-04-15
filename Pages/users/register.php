<?php
require_once('Models/Product.php');
require_once("components/Footer.php");
require_once("components/Nav.php");
require_once('Models/Database.php');

$dbContext = new Database();



$errorMessage = "";
$username = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $userId = $dbContext->getUsersDatabase()->getAuth()->register($username, $password, $username);
        header('Location: /user/registerThanks');
        exit;
    } catch (\Delight\Auth\InvalidEmailException $e) {
        $errorMessage = "That doesn’t look quite right – double-check your email.";
    } catch (\Delight\Auth\InvalidPasswordException $e) {
        $errorMessage = "Your password needs a little more sparkle – try at least 8 characters.";
    } catch (\Delight\Auth\UserAlreadyExistsException $e) {
        $errorMessage = "You're already part of the Luxé family. Try logging in instead.";
    } catch (\Exception $e) {
        $errorMessage = "Still glowing – just not logged in. Let’s fix that!";
    }
}

//Kunna lagra i databas


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>LUXÉ BEAUTY</title>
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
            <h1>Join the Luxé World!</h1>
            <p>Create your account to enter the Luxé world</p>
            <?php
            if ($errorMessage != "") {
                echo "<div class='alert alert-danger' role='alert'>" . $errorMessage . "</div>";
            }
            ?>
            <form method="POST">
                <div class="form-group">
                    <label for="username">Email</label>
                    <input type="text" class="form-control" name="username" placeholder="you@example.com"
                        value="<?php echo $username ?>">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Choose a strong one"
                        value="">
                </div>
                <div class="form-group">
                    <label for="password">Confirm password</label>
                    <input type="password" class="form-control" name="password2" placeholder="Just to be sure..."
                        value="">
                </div>
                <div>
                    <input type="submit" class="btn btn-primary" value="Create Account">
                    <p>Already a member? <a href="/user/login">Log in here!</a></p>
                </div>
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