<?php
    session_start();

    // Initialize the cart if it doesn't exist
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Handle add to cart action
    if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];

        // Check if product already exists in the cart
        $product_exists = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['product_id'] == $product_id) {
                $item['quantity'] += 1;
                $product_exists = true;
                break;
            }
        }

        // If the product doesn't exist, add it to the cart
        if (!$product_exists) {
            $_SESSION['cart'][] = [
                'product_id' => $product_id,
                'product_name' => $product_name,
                'product_price' => $product_price,
                'quantity' => 1
            ];
        }
    }

    // Handle remove from cart action
    if (isset($_POST['remove_from_cart'])) {
        $product_id = $_POST['product_id'];
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['product_id'] == $product_id) {
                unset($_SESSION['cart'][$key]);
                break;
            }
        }
    }
?>