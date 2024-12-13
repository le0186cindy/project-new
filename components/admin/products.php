<?php
    require_once 'scripts/db-products.php';

    if (isset($_POST['actionType'])) {
        if ($_POST['actionType'] == 'add') {
            if (add_product($_POST['pName'], $_POST['pDescription'], $_POST['pDetailedDescription'], $_POST['pPrice'], $_POST['pCategory'])) {
                echo '<div class="alert alert-success alert-dismissible mx-5" role="alert">Successfully added a product.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible mx-5" role="alert">Error.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
        } else if ($_POST['actionType'] == 'delete') {
            if (delete_product($_POST['modalProductID'])) {
                echo '<div class="alert alert-success alert-dismissible mx-5" role="alert">Successfully deleted a product.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible mx-5" role="alert">Error.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
        } else if ($_POST['actionType'] == 'edit') {
            if (edit_product($_POST['modalProductID'], $_POST['modalProductName'], $_POST['modalProductDescription1'], $_POST['modalProductDescription2'], $_POST['modalProductPrice'], $_POST['modalProductCategory'])) {
                echo '<div class="alert alert-success alert-dismissible mx-5" role="alert">Edited a product.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible mx-5" role="alert">Error.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
        }
    }

    if (isset($_POST['categoryActionType'])) {
        if ($_POST['categoryActionType'] == 'add') {
            if (add_category($_POST['categoryName'])) {
                echo '<div class="alert alert-success alert-dismissible mx-5" role="alert">Successfully added a category.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible mx-5" role="alert">Error.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
        } else if ($_POST['categoryActionType'] == 'delete') {
            if (delete_category($_POST['categoryID'])) {
                echo '<div class="alert alert-success alert-dismissible mx-5" role="alert">Deleted a category.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible mx-5" role="alert">Error.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
        }
    }

    $products = get_all_products();
    $categories = get_categories();

    $productData = [];
    foreach ($products as $product) {
        $productData[$product['product_id']] = $product;
    }
?>

<div class="bg-light p-2 m-2">
    <h2>Manage products</h2>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h4>Add a product</h4>
                <form method="post" action="">
                    <div class="form-group">
                        <label for="pName">Product Name</label>
                        <input id="pName" class="form-control" name="pName" type="text">
                    </div>
                    <div class="form-group">
                        <label for="pDescription">Product Description</label>
                        <textarea id="pDescription" class="form-control" name="pDescription" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pDetailedDescription">Product Detailed Description</label>
                        <textarea id="pDetailedDescription" class="form-control" name="pDetailedDescription" rows="5"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="pPrice">Product's Price</label>
                        <input id="pPrice" name="pPrice" type="number" step=".01" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pCategory">Product's Category</label>
                        <select id="pCategory" name="pCategory" class="form-control">
                            <?php
                            foreach($categories as $category) {
                                echo "<option value='{$category['category_id']}'>{$category['category_name']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="actionType" value="add">
                    <button type="submit" class="btn btn-primary mt-2">Submit</button>
                </form>
            </div>
            <div class="col">
                <div class="mb-3">
                    <h4>Edit or delete a product</h4>
                    <select class="form-select" id="productSelect">
                        <option value="">Choose a product</option>
                        <?php
                        foreach($products as $product) {
                            echo "<option value='{$product['product_id']}'>{$product['product_name']}</option>";
                        }
                        ?>
                    </select>

                    <!-- button for modal -->
                     <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#productModal" id="viewProductButton" disabled>
                        Choose Product
                    </button>
                    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="productModalLabel">Product Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="">
                                        <div class="mb-3">
                                            <label for="modalProductID">Product ID</label>
                                            <input type="text" class="form-control" id="modalProductID" name="modalProductID" readonly>
                                            <div class="form-text">You cannot change this</div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="modalProductName">Product Name</label>
                                            <input type="text" class="form-control" id="modalProductName">
                                        </div>
                                        <div class="mb-3">
                                            <label for="modalProductDescription1">Product Description</label>
                                            <textarea class="form-control" id="modalProductDescription1" style="height:fit-content;"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="modalProductDescription2">Product Description (Detailed)</label>
                                            <textarea class="form-control" id="modalProductDescription2" style="height:fit-content;"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="modalProductPrice">Price</label>
                                            <input type="number" class="form-control" step=".01" id="modalProductPrice">
                                        </div>
                                        <div class="mb-3">
                                            <label for="modalProductCategory">Category</label>
                                            <select class="form-control" id="modalProductCategory">
                                            <?php
                                            foreach($categories as $category) {
                                                echo "<option value='{$category['category_id']}'>{$category['category_name']}</option>";
                                            }
                                            ?>
                                            </select>
                                        </div>
                                        <button class="btn btn-primary" name="actionType" value="edit" type="submit">Edit</button>
                                        <button class="btn btn-danger" name="actionType" value="delete" type="submit" onclick="confirm('Are you sure?');">Delete</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <h4>Add a category</h4>
                    <form method="post">
                        <div class="form-group mb-3">
                            <label for="categoryName">Category Name</label>
                            <input class="form-control" type="text" id="categoryName" name="categoryName">
                        </div>
                        <button class="btn btn-primary" type="submit" name="categoryActionType" value="add">Add</button>
                    </form>
                </div>
                <div class="mb-3">
                    <h4>Delete a category</h4>
                    <form method="post">
                        <div class="form-group mb-3">
                            <select class="form-control" id="categoryID" name="categoryID">
                                <?php
                                foreach($categories as $category) {
                                    echo "<option value='{$category['category_id']}'>{$category['category_name']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <button class="btn btn-danger" type="submit" name="categoryActionType" value="delete">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const products = <?php echo json_encode($productData); ?>;
    const categories = <?php echo json_encode($categories); ?>;
</script>

<!-- script for modal -->
<script>
    const productSelect = document.getElementById('productSelect');
    const viewProductButton = document.getElementById('viewProductButton');

    // forms
    const modalProductName = document.getElementById('modalProductName');
    const modalProductDescription1 = document.getElementById('modalProductDescription1');
    const modalProductDescription2 = document.getElementById('modalProductDescription2');
    const modalProductPrice = document.getElementById('modalProductPrice');
    const modalProductCategory = document.getElementById('modalProductCategory');

    const productModal = new bootstrap.Modal(document.getElementById('productModal'));


    productSelect.addEventListener('change', function() {
        const productID = this.value;
        console.log(products[productID]);
        const categoryName = categories[products[productID].category_id] || 'Unknown';

        if (productID && products[productID]) {
            document.getElementById('modalProductID').value = products[productID].product_id;
            modalProductName.value = products[productID].product_name;
            modalProductDescription1.value = products[productID].product_description;
            modalProductDescription2.value = products[productID].product_description_detailed;
            modalProductPrice.value = products[productID].product_price;
            modalProductCategory.value = products[productID].category_id;
            viewProductButton.disabled = false;
        }
    })
</script>