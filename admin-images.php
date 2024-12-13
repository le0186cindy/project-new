<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['admin_user'])) {
        header("Location: scripts/login-admin.php");
        exit();
    }
?>
<html lang="en">
<?php
    $title = "Admin Dashboard";
    include 'components/head.php';
?>

<body class="bg-secondary">
    <div class="h-auto mt-2">
        <div class="d-flex justify-content-center gap-3">
            <a class="btn btn-info" role="button" href="/admin.php">Home</a>
            <a class="btn btn-info" role="button" href="/admin-images.php">Images</a>
            <a class="btn btn-info" role="button" href="/admin-products.php">Products</a>
            <a class="btn btn-info" role="button" href="/admin-orders.php">Orders</a>
        </div>
    

    <?php 
        include 'components/admin/images.php';
    ?>
    </div>
</body>

<?php
    include 'components/footer.php';
?>
</html>