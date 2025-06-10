<?php

require_once('Models/Database.php');

function Nav()
{
    $dbContext = new Database();

    $userId = null;
    $session_id = null;

    if ($dbContext->getUsersDatabase()->getAuth()->isLoggedIn()) {
        $userId = $dbContext->getUsersDatabase()->getAuth()->getUserId();
    }
    $session_id = session_id();
    $cart = new Cart($dbContext, $session_id, $userId);
    $q = $_GET["q"] ?? "";
    ?>

    <!-- HUVUDNAVIGATION -->
    <nav class="navbar navbar-expand-lg bg-white py-3" style="border-bottom: 0.5px solid #ddd;">
        <div class="container px-4 px-lg-5 d-flex justify-content-between align-items-center">
            <!-- Search Function on the Left -->
            <div class="nav-search">
                <form action="/search" method="GET" class="d-flex align-items-center ms-3">
                    <input type="text" name="q" value="<?= $q ?>" placeholder="Search" class="search-control" />
                    <button type="submit" style="background: none; border: none; margin-left: 8px; color: #333;">
                        <i class="bi bi-search" style="font-size: 18px;"></i>
                    </button>
                </form>
            </div>

            <!-- Brand (Logo) in the Center -->
            <a class="navbar-brand mx-auto" href="/">LUXÉ BEAUTY</a>

            <!-- Login & Cart on the Right -->
            <div class="nav-right">
                <?php if ($dbContext->getUsersDatabase()->getAuth()->isLoggedIn()) { ?>
                    <i class="bi bi-person-heart"></i> <?php echo $dbContext->getUsersDatabase()->getAuth()->getUsername() ?>
                <?php } ?>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if ($dbContext->getUsersDatabase()->getAuth()->isLoggedIn()) { ?>
                        <li class="nav-item"><a class="nav-link" href="/user/logout">Logout</a></li>
                    <?php } else { ?>
                        <li class="nav-item"><a class="nav-link" href="/user/login"><i class="bi bi-person-fill"></i> Sign
                                In</a></li>
                    <?php } ?>
                </ul>

                <!-- <form class="d-flex"> -->
                <!-- <button class="btn btn-outline-dark" type="submit"> -->
                <a href="/cart">
                    <i class="bi bi-bag-heart-fill"></i>
                    <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo ($cart->getItemsCount()); ?></span>
                </a>
                <!-- <span class="badge bg-dark text-white ms-1 rounded-pill">0</span> -->
                <!-- </button>
            </form> -->
            </div>
        </div>
    </nav>


    <!-- KATEGORI-NAVIGATION -->
    <nav class="category-navbar">
        <div class="category-container">
            <a href="/products" class="category-link fw-bold">All Products</a>
            <?php foreach ($dbContext->getAllCategories() as $cat): ?>
                <a href="/products?catname=<?= urlencode($cat) ?>" class="category-link"><?= htmlspecialchars($cat) ?></a>
            <?php endforeach; ?>
        </div>
    </nav>

    <?php
}
?>