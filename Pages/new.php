<?php
require_once('Models/Product.php');
require_once("components/Footer.php");
require_once("components/Nav.php");
require_once("components/Head.php");
require_once('Models/Database.php');
require_once("Utils/Validator.php"); // För validering 


// Hämta den produkt med detta ID
$dbContext = new Database();

$v = new Validator($_POST); // VALIDERINGEN

$title = "";
$stockLevel = "";
$price = "";
$categoryName = "";
$imageUrl = "";
$popularityFactor = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Här kommer vi när man har tryckt  på SUBMIT
    // IMORGON TISDAG SÅ UPDATE PRODUCT SET title = $_POST['title'] WHERE id = $id
    $title = $_POST['title'];
    $stockLevel = $_POST['stockLevel'];
    $price = $_POST['price'];
    $categoryName = $_POST['categoryName'];
    $imageUrl = $_POST['imageUrl'];
    $popularityFactor = $_POST['popularityFactor'];
    $productSavedMessage = "Produkten har sparats i databasen";

    // Här ska det valideras - SERVERSIDE validering
    $v->field('title')->required()->alpha_num([' '])->min_len(3)->max_len(50);
    $v->field('stockLevel')->required()->numeric()->min_val(0);
    $v->field('price')->required()->numeric()->min_val(0);
    $v->field('categoryName')->required()->alpha_num([''])->min_len(3)->max_len(50);
    $v->field('popularityFactor')->required()->numeric()->min_val(0);

    // om ok så spara i databas
    if ($v->is_valid()) {

        // OK - spara i databas
        $dbContext->insertProduct($title, $stockLevel, $price, $categoryName, $imageUrl, $popularityFactor);
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

            <form method="POST">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text"
                        class="form-control  <?php echo $v->get_error_message('title') != "" ? "is-invalid" : "" ?>"
                        name=" title" value="<?php echo $title ?>">
                    <span class="invalid-feedback"><?php echo $v->get_error_message('title'); ?></span>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number"
                        class="form-control  <?php echo $v->get_error_message('price') != "" ? "is-invalid" : "" ?>"
                        name="price" value="<?php echo $price ?>">
                    <span class="invalid-feedback"><?php echo $v->get_error_message('price'); ?></span>
                </div>
                <div class="form-group">
                    <label for="stockLevel">Stock</label>
                    <input type="number"
                        class="form-control  <?php echo $v->get_error_message('title') != "" ? "is-invalid" : "" ?>"
                        name="stockLevel" value="<?php echo $stockLevel ?>">
                    <span class="invalid-feedback"><?php echo $v->get_error_message('stockLevel'); ?></span>
                </div>
                <div class="form-group">
                    <label for="categoryName">Category name</label>
                    <input type="text"
                        class="form-control  <?php echo $v->get_error_message('categoryName') != "" ? "is-invalid" : "" ?>"
                        <?php echo $v->get_error_message('categoryName') != "" ? "is-invalid" : "" ?>"
                        name="categoryName" value="<?php echo $categoryName ?>">
                    <span class="invalid-feedback"><?php echo $v->get_error_message('categoryName'); ?></span>
                </div>
                <div class="form-group">
                    <label for="imageUrl">Image url</label>
                    <input type="text"
                        class="form-control  <?php echo $v->get_error_message('imageUrl') != "" ? "is-invalid" : "" ?>"
                        name="imageUrl" value="<?php echo $imageUrl ?>">
                    <span class="invalid-feedback"><?php echo $v->get_error_message('imageUrl'); ?></span>
                </div>
                <div class="form-group">
                    <label for="popularityFactor">Popularity factor</label>
                    <input type="number"
                        class="form-control  <?php echo $v->get_error_message('popularityFactor') != "" ? "is-invalid" : "" ?>"
                        name="popularityFactor" value="<?php echo $popularityFactor ?>">
                    <span class="invalid-feedback"><?php echo $v->get_error_message('popularityFactor'); ?></span>
                </div>
                <div class="my-2">
                    <input type="submit" class="btn btn-dark my-6" value="Save product">
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