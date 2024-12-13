<?php
    require_once 'scripts/db-products.php';
    require_once 'scripts/db-images.php';

    if (isset($_POST['actionType'])) {
        if ($_POST['actionType'] == 'add') {
            if (add_image($_POST['imageURL'], $_POST['imageProduct'])) {
                echo '<div class="alert alert-success alert-dismissible mx-5" role="alert">Added an image.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible mx-5" role="alert">Error.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
        } else if ($_POST['actionType'] == 'delete') {
            if (delete_image($_POST['imageID'])) {
                echo '<div class="alert alert-success alert-dismissible mx-5" role="alert">Deleted an image.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible mx-5" role="alert">Error.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
        } else if ($_POST['actionType'] == 'edit') {
            if (edit_image($_POST['imageID'], $_POST['imageURL'], $_POST['imageProduct'], $_POST['imagePrimary'])) {
                echo '<div class="alert alert-success alert-dismissible mx-5" role="alert">Edited an image.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            } else {
                echo '<div class="alert alert-danger alert-dismissible mx-5" role="alert">Error.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            }
        }
    }

    $products = get_all_products();
    $images = get_all_images();
?>
<div class="bg-light p-2 m-2">
    <h2>Manage Images for Products</h2>

    <div class="container-fluid">
        <div class="row">
            <h4>Add Image</h4>
            <form method="post">
                <label for="imageURL">Image Link</label>
                <input class="form-control" id="imageURL" name="imageURL" type="text" required>
                <label for="imageProduct">Product</label>
                <select class="form-control" id="imageProduct" name="imageProduct" required>
                    <?php
                    foreach($products as $product) {
                        echo "<option value='{$product['product_id']}'>{$product['product_name']}</option>";
                    }
                    ?>
                </select>
                <button class="btn btn-primary mt-3" type="submit" name="actionType" value="add">Add Image</button>
            </form>
        </div>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image Preview</th>
                    <th scope="col">Product</th>
                    <th scope="col">Link</th>
                    <td scope="col">Primary</td>
                    <th scope="col">Edit/Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($images as $image) {
                    ?>
                        <form method="post">
                        <tr>
                            <th scope="row"><?php echo $image['image_id']?></th>
                            <td><img class="object-fit-contain" style="max-width: 10vw;, max-height: 10vh;" src="<?php echo $image['image_url']?>"></td>
                            <td>
                                <select class="form-control" id="imageProduct" name="imageProduct">
                                <?php
                                foreach($products as $product) {
                                    if ($product['product_id'] === $image['product_id']) {
                                        echo "<option value='{$product['product_id']}' selected='selected'>{$product['product_name']}</option>";
                                    } else {
                                        echo "<option value='{$product['product_id']}'>{$product['product_name']}</option>";
                                    }
                                }
                                ?>
                                </select>
                            </td>
                            <td><input class="form-control" id="imageURL" name="imageURL" value="<?php echo $image['image_url']?>"></td>
                            <td>
                                <select class="form-control" id="imagePrimary" name="imagePrimary">
                                    <option value="0" <?php if ($image['is_primary'] == 0) { echo "selected='selected'"; } ?>>No</option>
                                    <option value="1" <?php if ($image['is_primary'] == 1) { echo "selected='selected'"; } ?>>Yes</option>
                                </select>
                            </td>
                            <input hidden name="imageID" value="<?php echo $image['image_id'];?>">
                            <td><button type="submit" class="btn btn-primary" name="actionType" value="edit">Edit</button><button type="submit" class="btn btn-danger" name="actionType" value="delete">Delete</button></td>
                        </tr>
                        </form>
                    <?php
                    }
                    ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>