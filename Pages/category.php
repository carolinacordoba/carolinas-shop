<?php
// ONCE = en gång även om det blir cirkelreferenser
#include_once("Models/Products.php") - OK även om filen inte finns
require_once("Models/Product.php");
require_once("components/Footer.php");
require_once("components/Nav.php");
require_once("Models/Database.php");

$dbContext = new Database();

$catName = $_GET["catname"] ?? "";

$header = $catName;
if($catName == ""){
    $header = "All products";
}
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
        <!-- Navigation-->
        <?php Nav(); ?>
        <!-- Header-->
        <header class="bg-dark py-5" style="background-image: url('assets/LUXE BEAUTY.webp'); background-size: cover; background-position: center;">
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
                foreach($dbContext->getCategoryProducts($catName) as $prod){
                ?>                    
                    <div class="col mb-5">
                            <div class="card h-100">
                                <?php if($prod->price < 10) {  ?>
                                    <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                                <?php } ?>        
                                <!-- Product image-->
                                <img class="card-img-top" src="<?php echo $prod->imageUrl; ?>" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?php echo $prod->title; ?></h5>
                                        <!-- Product price-->
                                        <?php echo $prod->price; ?> kr
                                    </div>
                                </div>
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="#">Add to cart</a></div>
                                </div>
                            </div>
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
