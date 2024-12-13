<?php
    // ALL FUNCTIONS RELATED TO PRODUCTS
    require("db-info.php");
    
    function get_all_products($category = null, $minPrice = null, $maxPrice = null) {
        $conn = get_db_connection();

        $query = "SELECT * FROM products WHERE 1=1";

        if (!empty($category) && $category != 'all') {
            $query .= " AND category_id = $category";
        }
        if (!empty($minPrice)) {
            $query .= " AND product_price >= $minPrice";
        }
    
        if (!empty($maxPrice)) {
            $query .= " AND product_price <= $maxPrice";
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

    function get_product($productID) {
        $conn = get_db_connection();
        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
            $stmt->bind_param("s", $productID);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            $conn->close();
            return $result;
        } catch (Exception $e) {
            $conn->close();
            throw $e;
        }
    }

    function add_product($productName, $productDescription1, $productDescription2, $productPrice, $productCategory) {
        $conn = get_db_connection();
        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, product_description_detailed, product_price, category_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $productName, $productDescription1, $productDescription2, $productPrice, $productCategory);
            $stmt->execute();
            $conn->close();
            return true;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
            return false;
        }
    }

    function delete_product($productID) {
        $conn = get_db_connection();
        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
            $stmt->bind_param("s", $productID);
            $stmt->execute();
            $conn->close();
            return true;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
            return false;
        }
    }

    function edit_product($productID, $productName, $productDescription1, $productDescription2, $productPrice, $productCategory) {
        $conn = get_db_connection();
        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("UPDATE products SET product_name = ?, product_description = ?, product_description_detailed = ?, product_price = ?, category_id = ? WHERE product_id = ?");
            $stmt->bind_param("ssssss", $productName, $productDescription1, $productDescription2, $productPrice, $productCategory, $productID);
            $stmt->execute();
            $conn->close();
            return true;
        } catch (Exception $e) {
            $conn->close();
            throw $e;
            return false;
        }
    }

    function get_categories() {
        $conn = get_db_connection();

        try {
            $conn = get_db_connection();
            $result = mysqli_query($conn, "SELECT * FROM categories");
            return $result;
        } catch (Exception $e) {
            $conn->close();
            throw $e;
        }
    }

    function add_category($categoryName) {
        $conn = get_db_connection();
        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("INSERT INTO categories (category_name) VALUES (?)");
            $stmt->bind_param("s", $categoryName);
            $stmt->execute();
            $conn->close();
            return true;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
            return false;
        }
    }

    function delete_category($categoryID) {
        $conn = get_db_connection();
        try {
            $conn = get_db_connection();
            $stmt = $conn->prepare("DELETE FROM categories WHERE category_id = ?");
            $stmt->bind_param("s", $categoryID);
            $stmt->execute();
            $conn->close();
            return true;
        } catch (Exception $e) {
            $conn -> close();
            throw $e;
            return false;
        }
    }
    
?>
