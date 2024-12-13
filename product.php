<html lang="en">
<?php
    $current_page = basename('products.php');
    require_once 'scripts/db-products.php';
    require_once 'scripts/db-images.php';
    $title = "Smiski Products";
    include 'components/head.php';
    include 'components/navbar.php';
?>
<body>
<?php
    if (isset($_GET['product_id'])) {
        $product = get_product($_GET['product_id']);
        if ($product) {
            include 'components/product_body.php';
        } else {
            include 'components/product_body_invalid.php';
        }
    } else {
        include 'components/product_body_invalid.php';
    }
?>
</body>
<?php
    include 'components/footer.php';
?>
</html>