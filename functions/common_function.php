<?php
// include the database
include("./includes/connect.php");

// handle fliters
function handle_filters()
{
    // get access to connection variable
    global $con;
    $select_query = '';
    // Check for filters
    if (isset($_GET['category'])) {
        $cat_id = $_GET['category'];
        $select_query = "SELECT * FROM products WHERE cat_id = $cat_id ORDER BY pr_title";
    } else if (isset($_GET['brand'])) {
        $br_id = $_GET['brand'];
        $select_query = "SELECT * FROM products WHERE br_id = $br_id ORDER BY pr_title";
    } else if (isset($_GET['keywords'])) {
        $keywords = $_GET['keywords'];
        $select_query = "SELECT * FROM products WHERE pr_keywords LIKE '%$keywords%' ORDER BY pr_title";
    } else if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        $select_query = "SELECT * FROM products WHERE pr_id = $product_id";
    } else {
        $select_query = "SELECT * FROM products ORDER BY pr_title LIMIT 0,9";
    }
    return mysqli_query($con, $select_query);
}

function get_products()
{
    $result_query = handle_filters();
    // check number of returned rows
    $rows_counter = mysqli_num_rows($result_query);
    if ($rows_counter == 0) {
        echo "<h2 class='text-center alert-success flex-grow-1'>No Available products</>";
    }

    while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['pr_id'];
        $product_title = $row['pr_title'];
        $product_description = $row['pr_description'];
        $product_image1 = $row['pr_img1'];
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
                    <a href='index.php?product_id=$product_id' class='btn btn-secondary'>View more</a>
                </div>
            </div>
            <!-- Card end -->
        </div>
        <!-- End single product -->
        ";
    }
}


function get_single_product()
{
    $result_query = handle_filters();

    // check number of returned rows
    $rows_counter = mysqli_num_rows($result_query);
    if ($rows_counter == 0) {
        echo "<h2 class='text-center alert-success flex-grow-1'>No Available products</>";
    }

    while ($row = mysqli_fetch_assoc($result_query)) {
        $product_title = $row['pr_title'];
        $product_description = $row['pr_description'];
        // $product_keywords = $row['pr_keywords'];
        $product_category = $row['cat_id'];
        $product_brand = $row['br_id'];
        $product_price = $row['pr_price'];
        // $product_status = $row['status'];
        $product_image1 = $row['pr_img1'];
        $product_image2 = $row['pr_img2'];
        $product_image3 = $row['pr_img3'];

        echo "
    <!-- Start single product -->
    <div class='col-md-4 mb-2'>
        <!-- Card Start -->
        <div class='card single-product'>
            <img src='./admin/product_images/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
                <h5 class='card-title'>$product_title</h5>
                <p class='card-text'>$product_description</p>
                <a href='#' class='btn btn-info btn-block'>Add to cart</a>
            </div>
        </div>
        <!-- Card end -->
    </div>
    <!-- End single product -->

    <!-- Start related images -->
    <div class='col-md-8'>
        <div class='row'>
            <div class='col-md-12'>
                <h4 class='text-center text-info mb-5'>Product Images</h4>
            </div>
            <div class='col-md-6'>
             <img src='./admin/product_images/$product_image2' class='card-img-top' alt='$product_title'>
            </div>
            <div class='col-md-6'>
             <img src='./admin/product_images/$product_image3' class='card-img-top' alt='$product_title'>
            </div>
        </div>
    </div>
    <!-- End related images -->
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
        <li class='list-group-item'>
            <a href='index.php?brand=$brand_id'> $brand_title </a>
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
            <li class='list-group-item'>
                <a href='index.php?brand=$category_id'> $category_title </a>
            </li>
        ";
    }
}
