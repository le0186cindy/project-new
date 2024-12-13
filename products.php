<?php
    $current_page = basename($_SERVER['PHP_SELF']);
?>
<html lang="en">
<?php
    $title = "Smiski Products";
    include 'components/head.php';
?>
<body>

<?php
    include 'components/navbar.php';
    include 'components/products_body.php'
?>

</body>

<?php
    include 'components/footer.php';
?>
</html>