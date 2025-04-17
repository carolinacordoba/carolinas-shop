<?php
require_once("Models/Product.php");
require_once("Models/Database.php");
require_once("components/Nav.php");
require_once("components/Footer.php");
require_once("components/Head.php");

$dbContext = new Database();

// Hämta produktens ID från URL
$id = $_GET['id'] ?? null;
$product = $dbContext->getProduct($id);

if (!$product) {
    echo "Produkt hittades inte.";
    exit;
}

$showDetails = isset($_GET['showDetails']) && $_GET['showDetails'] == 'true';

?>

<!DOCTYPE html>
<html lang="en">
<?php Head(); ?>

<body>
    <?php Nav(); ?>

    <div class="container py-5">
        <div class="row">
            <!-- LEFT: Product Images -->
            <div class="col-md-6">
                <img src="<?= $product->imageUrl ?>" alt="<?= $product->title ?>" class="img-fluid mb-3 rounded"
                    style="border: 1px solid #eee;" />
                <!-- Thumbnails (om du har fler bilder i framtiden) -->
                <!-- <div class="d-flex gap-2">
                    <img src="..." width="80" class="img-thumbnail" />
                </div> -->
            </div>

            <!-- RIGHT: Product Info -->
            <div class="col-md-6">
                <h2 class="mb-3" style="font-weight: bold;"><?= $product->title ?></h2>

                <!-- Stars -->
                <div class="mb-2 text-warning">
                    <?php
                    $stars = $product->popularityFactor;
                    for ($i = 1; $i <= 5; $i++) {
                        echo $i <= $stars ? '<i class="bi bi-star-fill"></i>' : '<i class="bi bi-star"></i>';
                    }
                    ?>
                </div>

                <h4 class="mb-3"><?= $product->price ?> kr</h4>

                <p class="text-muted"><?= $product->shortDescription ?? "En fantastisk produkt du inte vill missa." ?>
                </p>

                <!-- Quantity & Add to Cart -->
                <form action="add_to_cart.php" method="POST">
                    <div class="d-flex align-items-center mb-3">

                        <!-- Add to Cart button -->
                        <input type="hidden" name="product_id" value="<?= $product->id ?>">
                        <button type="submit" class="btn btn-dark px-4 py-2"
                            style="background-color: #B76E79; border: none;">
                            Add to cart
                        </button>
                    </div>
                </form>

                <!-- Description Section -->
                <div class="product-details mt-4">
                    <a href="?id=<?= $id ?>&showDetails=<?= $showDetails ? 'false' : 'true' ?>" class="details-toggle"
                        style="cursor: pointer; font-size: 1.25rem; color: #333; text-decoration: none; display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-top: 0.5px solid #333; border-bottom: 0.5px solid #333;">
                        <span>DETAILS</span>
                        <i class="bi <?= $showDetails ? 'bi-dash-circle' : 'bi-plus-circle' ?>"></i>
                    </a>

                    <!-- Visa beskrivningen om showDetails är true -->
                    <?php if ($showDetails): ?>
                        <div class="details-content mt-3"
                            style="padding-left: 20px; padding-right: 20px; line-height: 1.8;">
                            <p><?= nl2br($product->longDescription) ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>

    <?php Footer(); ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>