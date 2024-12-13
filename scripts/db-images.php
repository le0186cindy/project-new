<?php
    // ALL FUNCTIONS RELATED TO IMAGES
    require_once("util-db.php");

    function get_all_images($productID = null) {
        $conn = get_db_connection();

        $query = "SELECT * FROM product_images WHERE 1=1";

        if (!empty($productID)) {
            $query .= " AND product_id = $productID";
        }

        try {
            $conn = get_db_connection();
            $result = mysqli_query($conn, $query);
            $conn->close();
            return $result;
        } catch (Exception $e) {
            $conn->close();
            throw $e;
        }
    }

    function get_primary_image($productID) {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            $result = mysqli_query($conn, "SELECT image_id, image_url FROM product_images WHERE product_id = $productID AND is_primary = 1");
            $conn->close();
            return $result->fetch_assoc();
        } catch (Exception $e) {
            $conn->close();
            throw $e;
        }
    }

    function add_image($imageLink, $productID) {
        $conn = get_db_connection();
        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("INSERT INTO product_images (image_url, product_id) VALUES (?, ?)");
            $stmt->bind_param("ss", $imageLink, $productID);
            $stmt->execute();
            $conn->close();
            return true;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
            return false;
        }
    }

    function delete_image($imageID) {
        $conn = get_db_connection();
        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("DELETE FROM product_images WHERE image_id = ?");
            $stmt->bind_param("s", $imageID);
            $stmt->execute();
            $conn->close();
            return true;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
            return false;
        }
    }

    function edit_image($imageID, $imageLink, $productID, $primary) {
        $conn = get_db_connection();
        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("UPDATE product_images SET image_url = ?, is_primary = ?, product_id = ? WHERE image_id = ?");
            $stmt->bind_param("ssss", $imageLink, $primary, $productID, $imageID);
            $stmt->execute();
            $conn->close();
            return true;
        } catch (Exception $e) {
            $conn->close();
            throw $e;
            return false;
        }
    }
?>