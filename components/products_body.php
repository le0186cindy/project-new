<?php
    require_once 'scripts/db-products.php';
    require_once 'scripts/db-images.php';

    $category = isset($_GET['category']) ? $_GET['category'] : null;
    $minPrice = isset($_GET['minPrice']) ? $_GET['minPrice'] : null;
    $maxPrice = isset($_GET['maxPrice']) ? $_GET['maxPrice'] : null;

    $products = get_all_products($category, $minPrice, $maxPrice);
    $categories = get_categories();
?>

<div class="w-75 mx-auto">
    <div class="mx-auto">
        <h4>Products</h4>
        <div class="container-fluid mx-2">
            <div class="row">
                <div class="col-12">
                    <h5 class="text-center">Filter</h5>
                    <form id="filterForm" action="" method="get" class="d-flex justify-content-center flex-wrap gap-3">
                        <div class="filter-group d-flex align-items-center gap-2">
                            <label for="category" class="mb-0">Category</label>
                            <select id="category" name="category" class="form-control">
                                <option value="all">All</option>
                                <?php
                                foreach ($categories as $cat) {
                                ?>
                                    <option value="<?php echo $cat['category_id']?>" <?php if (!empty($category) && $cat['category_id'] === $category) { echo 'selected="selected"'; }?>><?php echo $cat['category_name']?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="filter-group d-flex align-items-center gap-3">
                            <label for="priceRange" class="mb-0">Price Range</label>
                            <input type="number" id="minPrice" name="minPrice" <?php if (!empty($minPrice)) { echo 'value="' . $minPrice . '"'; } ?> class="form-control" placeholder="Min"/>
                            <input type="number" id="maxPrice" name="maxPrice" <?php if (!empty($maxPrice)) { echo 'value="' . $maxPrice . '"'; } ?> class="form-control" placeholder="Max"/>
                        </div>
                        <button type="submit" id="applyFilters" class="btn text-white" style="background-color: #93C572;">Apply Filters</button>
                    </form>
                </div>
            </div>
        </div>
       <div class="container my-4">
            <div class="row justify-content-center g-3">
                <?php
                foreach ($products as $product) {
                    $imageURL = get_primary_image($product['product_id'])['image_url'];
                ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card" style="width: 100%;">
                            <img src="<?php echo $imageURL; ?>" class="card-img-top" alt="..." style="object-fit: cover; height: 200px;">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="product.php?product_id=<?php echo $product['product_id']; ?>" style="text-decoration:none">
                                        <?php echo $product['product_name']; ?>
                                    </a>
                                </h5>
                                <p class="card-text">$<?php echo $product['product_price']; ?></p>
                                <a href="#" class="btn text-white" style="background-color: #93C572;">Add to cart</a>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
