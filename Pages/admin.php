<?php
require_once("Models/Product.php");
require_once("components/Footer.php");
require_once("components/Nav.php");
require_once("components/Head.php");
require_once("Models/Database.php");

$dbContext = new Database();

$sortCol = $_GET['sortCol'] ?? "";
$sortOrder = $_GET['sortOrder'] ?? "";

?>

<!DOCTYPE html>
<html lang="en">

<?php Head() ?>

<body>
    <!-- Navigation-->
    <?php Nav(); ?>

    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <a href="/admin/new" class="btn btn-primary">Add new product</a>
            <table class="table">
                <thead>
                    <th>Product Name
                        <a href="admin.php?sortCol=title&sortOrder=asc">
                            <i class="bi bi-arrow-down-circle"></i></a>
                        <a href="admin.php?sortCol=title&sortOrder=desc">
                            <i class="bi bi-arrow-up-circle"></i></a>
                    </th>
                    <th>Category
                        <a href="admin.php?sortCol=categoryName&sortOrder=asc">
                            <i class="bi bi-arrow-down-circle"></i></a>
                        <a href="admin.php?sortCol=categoryName&sortOrder=desc">
                            <i class="bi bi-arrow-up-circle"></i></a>
                    </th>
                    <th>Price
                        <a href="admin.php?sortCol=price&sortOrder=asc">
                            <i class="bi bi-arrow-down-circle"></i></a>
                        <a href="admin.php?sortCol=price&sortOrder=desc">
                            <i class="bi bi-arrow-up-circle"></i></a>
                    </th>
                    <th>Stock level
                        <a href="admin.php?sortCol=stockLevel&sortOrder=asc">
                            <i class="bi bi-arrow-down-circle"></i></a>
                        <a href="admin.php?sortCol=stockLevel&sortOrder=desc">
                            <i class="bi bi-arrow-up-circle"></i></a>
                    </th>
                    <th>Modify</th>
                </thead>
                <tbody>
                    <?php foreach ($dbContext->getAllProducts($sortCol, $sortOrder) as $prod) { ?>
                        <tr>
                            <td><?php echo $prod->title; ?></td>
                            <td><?php echo $prod->categoryName; ?></td>
                            <td><?php echo $prod->price; ?></td>
                            <td><?php echo $prod->stockLevel; ?></td>
                            <td><a href="/admin/edit?id=<?php echo $prod->id; ?>" class="btn btn-primary">Edit</a>
                                <a href="/admin/delete?id=<?php echo $prod->id; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
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