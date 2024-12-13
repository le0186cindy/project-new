<html lang="en">
<?php
    if (!isset($_SESSION['admin_user'])) {
        header("Location: scripts/login-admin.php");
        exit();
    }
    $title = "Admin Dashboard";
    include 'components/head.php';
?>

<body class="bg-secondary">
    <div class="h-100 mt-2">
        <div class="d-flex justify-content-center gap-3">
            <a class="btn btn-info" role="button" href="/admin.php">Home</a>
            <a class="btn btn-info" role="button" href="/admin-images.php">Images</a>
            <a class="btn btn-info" role="button" href="/admin-products.php">Products</a>
            <a class="btn btn-info" role="button" href="/admin-orders.php">Orders</a>
        </div>
        <div>
            To-do: Add charts and stuff
        </div>
    </div>
</body>

<?php
    include 'components/footer.php';
?>
</html>