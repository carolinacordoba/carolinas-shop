<?php
// ONCE = en gång även om det blir cirkelreferenser
#include_once("Models/Products.php") - OK även om filen inte finns
require_once("Models/Product.php");
require_once("components/Footer.php");
require_once("Models/Database.php");
require_once("components/Nav.php");
require_once("components/Head.php");

$dbContext = new Database();
?>

<!DOCTYPE html>
<html lang="en">

<?php Head() ?>

<body>
    <?php Nav(); ?>
    <!-- Header-->
    <header class="bg-dark py-5"
        style="background-image: url('assets/LUXE BEAUTY.webp'); background-size: cover; background-position: center; height:60vh; display: flex; justify-content: center; align-items: center;">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">LUXÉ BEAUTY</h1>
                <p class="lead fw-normal text-white-50 mb-0">Where luxury meets effortless beauty</p>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="py-4">
        <div class="container px-4 px-lg-5 text-center">
            <h2 class="fw-bolder mb-4">Handpicked Highlights</h2>
            <!-- Du lägger in produkterna här senare -->
            <div id="popularProductsCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $products = $dbContext->getPopularProducts();
                    $chunks = array_chunk($products, 4); // ÄNDRA HÄR till 4
                    
                    foreach ($chunks as $index => $chunk): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <div class="d-flex justify-content-center gap-3">
                                <?php foreach ($chunk as $prod): ?>
                                    <div class="card mx-2" style="width: 16rem;">
                                        <img class="card-img-top" src="<?= $prod->imageUrl ?>" alt="<?= $prod->title ?>">
                                        <div class="card-body text-center">
                                            <h5 class="card-title"><?= $prod->title ?></h5>
                                            <p class="fw-bold"><?= $prod->price ?> kr</p>
                                            <a href="/productdetails?id=<?= $prod->id ?>" class="btn btn-outline-dark">Shop</a>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Controls -->
                <a class="carousel-control-prev" href="#popularProductsCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </a>
                <a class="carousel-control-next" href="#popularProductsCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    </section>

    <section class="py-5" style="background-color: #F8F4F0; color: #333;">
        <div class="container text-center px-4 px-lg-5">
            <h2 class="mb-3" style="font-size: 1.75rem; font-weight: 600; color: #B76E79;">LUXÉ BEAUTY</h2>
            <div style="width: 60px; height: 3px; background-color: #B76E79; margin: 20px auto;"></div>
            <p class="mb-4"
                style="font-size: 1.125rem; max-width: 700px; margin: 0 auto; line-height: 1.8; color: #333;">
                At Luxé Beauty, we believe beauty should be effortless, empowering, and made for every unique
                individual.
                Our luxurious formulas in inclusive shades are designed to highlight your glow, not hide it. It's about
                celebrating YOU.
            </p>
            <a href="about.php" class="btn"
                style="padding: 10px 28px; border-radius: 50px; background-color: #B76E79; color: white; font-size: 0.95rem; transition: all 0.3s;">
                Learn More
            </a>
        </div>
    </section>

    <section class="py-5" style="background-color: #FFFF;">
        <div class="container px-4 px-lg-5">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="assets/GLAM.png" alt="Glam Makeup" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-6 text-center">
                    <h2 style="color: #333;">GLAM</h2>
                    <p style="color: #333; margin-bottom: 0;">Bold pigments, soft textures, and effortless glam.</p>
                    <p style="color: #333;">Our makeup is created for everyone who wants to stand out — or glow soft.
                    </p>
                    <a href="/products?catname=GLAM" class="btn mt-3"
                        style="background-color: #B76E79; color: #fff; border-radius: 50px; transition: all 0.3s;"
                        onmouseover="this.style.backgroundColor='#c8858d'"
                        onmouseout="this.style.backgroundColor='#B76E79'">EXPLORE GLAM</a>
                </div>
            </div>
        </div>
    </section>

    <!-- SKIN -->
    <section class="py-5" style="background-color: #FFFF;">
        <div class="container px-4 px-lg-5">
            <div class="row align-items-center flex-md-row-reverse">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="assets/SKIN.png" alt="Skincare" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-6 text-center">
                    <h2 style="color: #333;">SKIN</h2>
                    <p style="color: #333; margin-bottom: 0;">Glow starts with care.</p>
                    <p style="color: #333; line-height: 1.6;">Our skin collection is made to hydrate, soothe, and bring
                        out your natural
                        radiance. No filters needed.</p>

                    <a href="/products?catname=SKIN" class="btn mt-3"
                        style="background-color: #B76E79; color: #fff; border-radius: 50px; transition: all 0.3s;"
                        onmouseover="this.style.backgroundColor='#c8858d'"
                        onmouseout="this.style.backgroundColor='#B76E79'">EXPLORE SKIN</a>
                </div>
            </div>
        </div>
    </section>

    <!-- HAIR -->
    <section class="py-5" style="background-color: #FFFF;">
        <div class="container px-4 px-lg-5">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="assets/HAIR.png" alt="Hair Care" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-6 text-center">
                    <h2 style="color: #333;">HAIR</h2>
                    <p style="color: #333; margin-bottom: 0;">From deep care to styling essentials</p>
                    <p style="color: #333; line-height: 1.6;">Our hair collection blends deep care with luxe styling,
                        for silky softness, strength, and effortless elegance from root to tip.</p>
                    <a href="/products?catname=HAIR" class="btn mt-3"
                        style="background-color: #B76E79; color: #fff; border-radius: 50px; transition: all 0.3s;"
                        onmouseover="this.style.backgroundColor='#c8858d'"
                        onmouseout="this.style.backgroundColor='#B76E79'">EXPLORE HAIR</a>
                </div>
            </div>
        </div>
    </section>

    <!-- SCENT -->
    <section class="py-5" style="background-color: #FFFF;">
        <div class="container px-4 px-lg-5">
            <div class="row align-items-center flex-md-row-reverse">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="assets/SCENT.png" alt="Fragrances" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-6 text-center">
                    <h2 style="color: #333;">SCENT</h2>
                    <p style="color: #333; margin-bottom: 0;">Soft, warm, unforgettable.</p>
                    <p style="color: #333; line-height: 1.6;">Discover signature scents that blend elegance and
                        identity into every spray.</p>
                    <a href="/products?catname=SCENT" class="btn mt-3"
                        style="background-color: #B76E79; color: #fff; border-radius: 50px; transition: all 0.3s;"
                        onmouseover="this.style.backgroundColor='#c8858d'"
                        onmouseout="this.style.backgroundColor='#B76E79'">EXPLORE SCENT</a>
                </div>
            </div>
        </div>
    </section>



    <!-- Footer-->
    <?php Footer(); ?>
    <!-- Bootstrap core JS-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>