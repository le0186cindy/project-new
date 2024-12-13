<?php
    $current_page = basename($_SERVER['PHP_SELF']);
?>
<html lang="en">
<?php
    $title = "About Us";
    include 'components/head.php';
?>
<body>

<?php
    include 'components/navbar.php';
    include 'components/about_main.php';
?>

</body>

<?php
    include 'components/footer.php';
?>
</html>