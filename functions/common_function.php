<?php
// include the database
include("./includes/connect.php");

function getProducts()
{
    global $con;
    // fetching products
    $select_query = "SELECT * FROM products ORDER BY pr_title LIMIT 0,9";
    $result_query = mysqli_query($con, $select_query);
    while ($row = mysqli_fetch_assoc($result_query)) {
        $product_title = $row['pr_title'];
        $product_description = $row['pr_description'];
        $product_keywords = $row['pr_keywords'];
        $product_category = $row['cat_id'];
        $product_brand = $row['br_id'];
        $product_price = $row['pr_price'];
        $product_status = $row['status'];
        $product_image1 = $row['pr_img1'];
        $product_image2 = $row['pr_img2'];
        $product_image3 = $row['pr_img3'];
        echo
        "
     <!-- Start single product -->
     <div class='col-md-4 mb-2'>
         <!-- Card Start -->
         <div class='card'>
             <img src='./admin/product_images/$product_image1' class='card-img-top' alt='$product_title'>
             <div class='card-body'>
                 <h5 class='card-title'>$product_title</h5>
                 <p class='card-text'>$product_description</p>
                 <a href='#' class='btn btn-info'>Add to cart</a>
                 <a href='#' class='btn btn-secondary'>View more</a>
             </div>
         </div>
         <!-- Card end -->
     </div>
     <!-- End single product -->
     ";
    }
}


// display brands inside nav
function getBrands()
{
    global $con;

    $select_brands = "select * from `brands`";
    $result_brands = mysqli_query($con, $select_brands);

    while ($row_data = mysqli_fetch_assoc($result_brands)) {
        $brand_title = $row_data['br_title'];
        $brand_id = $row_data['br_id'];
        echo "
         <li class='nav-item'>
            <a href='index.php?brand=$brand_id' class='nav-link text-light'>
                <h4>$brand_title</h4>
            </a>
        </li>
        ";
    }
}

function getCategories()
{
    global $con;

    $select_categories = "select * from `categories`";
    $result_categories = mysqli_query($con, $select_categories);

    while ($row_data = mysqli_fetch_assoc($result_categories)) {
        $category_title = $row_data['cat_title'];
        $category_id = $row_data['cat_id'];
        echo "
            <li class='nav-item'>
                <a href='index.php?category=$category_id' class='nav-link text-light'>
                    <h4>$category_title</h4>
                </a>
            </li>
        ";
    }
}
