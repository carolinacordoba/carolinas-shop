<?php
// ONCE = en gång även om det blir cirkelreferenser
#include_once("Models/Products.php") - OK även om filen inte finns
require_once("Models/Product.php");
require_once("components/Footer.php");
require_once("components/Nav.php");
require_once("components/Head.php");
require_once("Models/Database.php");

$dbContext = new Database();

$catName = $_GET["catname"] ?? "";

$header = $catName;
if ($catName == "") {
    $header = "All products";
}
?>

<!DOCTYPE html>
<html lang="en">
<?php Head() ?>

<body>
    <!-- Navigation-->
    <?php Nav(); ?>
    <!-- Header-->
    <header class="bg-dark py-5"
        style="background-image: url('assets/LUXE BEAUTY.webp'); background-size: cover; background-position: center;">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder"> <?php echo $header; ?></h1>
                <p class="lead fw-normal text-white-50 mb-0">Where luxury meets effortless beauty</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                foreach ($dbContext->getCategoryProducts($catName) as $prod) {
                    ?>
                    <div class="col mb-5">
                        <a href="/productdetails?id=<?php echo $prod->id; ?>"
                            style="text-decoration: none; color: inherit;">
                            <div class="card h-100">
                                <?php if ($prod->price < 10) { ?>
                                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                                        Sale</div>
                                <?php } ?>
                                <!-- Product image-->
                                <img class="card-img-top" src="<?php echo $prod->imageUrl; ?>" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?php echo $prod->title; ?></h5>
                                        <div class="d-flex justify-content-center small text-warning mb-2">
                                            <?php
                                            // Antal stjärnor som ska visas
                                            $popularityFactor = $prod->popularityFactor;

                                            // Loop för att skapa stjärnorna baserat på popularityFactor
                                            for ($i = 1; $i <= 5; $i++) {
                                                // Om $i är mindre än eller lika med popularityFactor, visa en fylld stjärna
                                                echo ($i <= $popularityFactor)
                                                    ? '<i class="bi bi-star-fill"></i>'  // Fylld stjärna
                                                    : '<i class="bi bi-star"></i>';      // Tom stjärna
                                            }
                                            ?>
                                        </div>

                                        <!-- Product price-->
                                        <?php echo $prod->price; ?> kr
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to
                                            cart</a></div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>




    <!-- Footer-->
    <?php Footer(); ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>