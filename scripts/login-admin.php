<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['admin_user'])) {
        header("Location: ../admin.php");
        exit();
    }

    require_once("db-info.php");
    $title = "Admin Login";
    include '../components/head.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $admin_user = $_POST['admin_user'];
        $admin_password = $_POST['admin_password'];

        // Database here
        $conn = get_db_connection();
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("SELECT * FROM admin");
        $stmt->execute();
        $stmt->bind_result($userID, $passwordHash);
        $stmt->fetch();
        
        if ($userID && password_verify($admin_password, $passwordHash)) {
            $_SESSION['admin_user'] = $userID;

            echo "<script type='text/javascript'>window.location.href = '../admin.php</script>";
            exit();
        }
        $conn->close();
    } else {
        $error = "Invalid username, password";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>
<body style="background-color: #FFFDD1;">
    <div class="d-flex justify-content-center align-items-center h-100">
        <div class="w-50 p-2 border">
            <h3 class="text-center mb-4">Admin Login</h3>
            <form method="post" action="">
                <div class="mb-3">
                    <label for="admin_user" class="form-label">User</label>
                    <input type="text" class="form-control" name="admin_user" id="admin_user" placeholder="Enter user">
                </div>
                <div class="mb-3">
                    <label for="admin_password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="admin_password" id="admin_password" placeholder="Enter password">
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-50">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>