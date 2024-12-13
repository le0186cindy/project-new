<?php
    $current_page = basename($_SERVER['PHP_SELF']);
    include 'scripts/cart.php';
?>
<html lang="en">
<?php
    $title = "Smiski Store - Cart";
    include 'components/head.php';
?>
<body>

<?php
    include 'components/cart-body.php';
?>

</body>

<?php
    include 'components/footer.php';
?>
</html>