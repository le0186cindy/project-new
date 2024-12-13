<div class="mx-5 d-flex justify-content-center mt-5">
    <div class="w-75">
        <div class="container-fluid">
            <div class="row">
            <div class="col-5 glide">
                <div class="glide__track" data-glide-el="track">
                    <ul class="glide__slides">
                        <li class="glide__slide">
                            <img src="<?php echo get_primary_image($product['product_id'])['image_url'];?>" alt="Primary Image" id="main-image" class="w-100 hover-effect">
                        </li>
                        <?php
                            foreach (get_all_images($product['product_id']) as $image) {
                        ?>
                        <li class="glide__slide">
                            <img src="<?php echo $image['image_url'];?>" class="w-100 hover-effect">
                        </li>
                        <?php
                            }
                        ?>
                    </ul>
                </div>

                <div class="mt-3 d-flex justify-content-center gap-3">
                    <?php
                        foreach (get_all_images($product['product_id']) as $index => $image) {
                    ?>
                    <div class="sub-slide" style="cursor: pointer;">
                        <img src="<?php echo $image['image_url'];?>" class="sub-image" onclick="changeMainImage('<?php echo $image['image_url'];?>', <?php echo $index + 1; ?>)">
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
                <div class="col">
                    <h5><?php echo $product['product_name']?></h5>
                    <p>Description: <?php echo $product['product_description']?></p>
                    <label for="quantity" class="form-label">Quantity</label>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon1">-</button>
                        <input type="number"style="width: 5rem;" id="quantity" class="form-control flex-grow-0" placeholder="1" max="50">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">+</button>
                    </div>
                    <p class="my-2">Price: $<?php echo $product['product_price']?></p>
                    <button class="btn text-white" style="background-color: #93C572;">Add to Cart</button>
                </div>
            </div>
        </div>
        <div class="my-3">
            <h5>Product Details</h5>
            <hr>
            <p><?php echo $product['product_description_detailed']; ?></p>
        </div>
    </div>
</div>
<script>
    // Initialize Glide.js with autoplay and smooth transitions
    const glide = new Glide('.glide', {
        type: 'carousel',   // Carousel style
        animationDuration: 1000,  // Smooth transition duration
        perView: 1,
    }).mount();

    // Change the main image based on clicked sub-image
    function changeMainImage(imageSrc, index) {
        const mainImage = document.getElementById('main-image');
        mainImage.src = imageSrc;
        
        console.log(index);
        glide.go(index); 
    }
    
    const decrementButton = document.getElementById("button-addon1");
    const incrementButton = document.getElementById("button-addon2");
    const quantityInput = document.getElementById("quantity");

    decrementButton.addEventListener("click", function() {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {  // Prevent going below 1
            quantityInput.value = currentValue - 1;
        }
    });

    incrementButton.addEventListener("click", function() {
        let currentValue = parseInt(quantityInput.value);
        if (currentValue < 50) {  // Prevent going above max value of 50
            quantityInput.value = currentValue + 1;
        }
    });
</script>
