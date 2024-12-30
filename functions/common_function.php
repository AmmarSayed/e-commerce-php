<?php
//////////////////////
// Imports
/////////////////////

// include the database
include("./includes/connect.php");

//////////////////////
// Global area
/////////////////////
$user_id = 4;
$ip_address = $_SERVER['REMOTE_ADDR'];

//////////////////////
// Functions
/////////////////////
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
    } elseif (isset($_GET['brand'])) {
        $br_id = $_GET['brand'];
        $select_query = "SELECT * FROM products WHERE br_id = $br_id ORDER BY pr_title";
    } elseif (isset($_GET['keywords'])) {
        $keywords = $_GET['keywords'];
        $select_query = "SELECT * FROM products WHERE pr_keywords LIKE '%$keywords%' ORDER BY pr_title";
    } elseif (isset($_GET['product_id'])) {
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
        echo "<h2 class='py-3 text-center alert-success flex-grow-1'>No Available products</h2>";
    }

    while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['pr_id'];
        $product_title = $row['pr_title'];
        $product_description = $row['pr_description'];
        $product_price = $row['pr_price'];
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
                    <p class='card-text'>Price: $product_price$</p>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info'>Add to cart</a>
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
        echo "<h2 class='py-3 text-center alert-success flex-grow-1'>No Available products</h2>";
    }

    while ($row = mysqli_fetch_assoc($result_query)) {
        $product_id = $row['pr_id'];
        $product_title = $row['pr_title'];
        $product_description = $row['pr_description'];
        // $product_keywords = $row['pr_keywords'];
        // $product_category = $row['cat_id'];
        // $product_brand = $row['br_id'];
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
                    <p class='card-text'>Price: $product_price$</p>
                    <a href='index.php?add_to_cart=$product_id' class='btn btn-info btn-block'>Add to cart</a>
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
                <div class='col-md-6 '>
                <img src='./admin/product_images/$product_image2' class='card-img-top border' alt='$product_title'>
                </div>
                <div class='col-md-6'>
                <img src='./admin/product_images/$product_image3' class='card-img-top border' alt='$product_title'>
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
                <a href='index.php?category=$category_id'> $category_title </a>
            </li>
        ";
    }
}

function handle_add_to_cart()
{
    global $con;

    ///////////////////
    // To be changed
    ///////////////////
    global $user_id;
    global $ip_address;
    ///////////////////
    ///////////////////

    if (isset($_GET['add_to_cart'])) {

        $product_id = $_GET['add_to_cart'];

        $select_query = "SELECT * FROM cart WHERE user_id = $user_id AND pr_id=$product_id";
        $result_query = mysqli_query($con, $select_query);
        $rows_counter = mysqli_num_rows($result_query);
        // $rows_counter = $result_query->num_rows

        if ($rows_counter > 0) {
            // Redirect to same tap
            header("Location: index.php?success=0");
            exit();
        } else {
            // insert data to cart
            $insert_query = "INSERT INTO `cart` (user_id,pr_id,qty,ip_address)
            VALUES ($user_id,$product_id,1,'$ip_address');";
            $query_result = mysqli_query($con, $insert_query);
            header("Location: index.php?success=1");
            exit();
        }
    }

    // Display success message if redirected for 3 seconds and disappear after 3 seconds
    if (isset($_GET['success'])) {
        $success = $_GET['success'];
        if ($success == 1) {
            echo "<div class='alert flex-grow-1 alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> Product added to cart successfully.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
        } else {
            echo "<div class='alert flex-grow-1 alert-danger alert-dismissible fade show' role='alert'>
            <strong>Failed!</strong> Product already in cart.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
          </div>";
        }
        // Remove alert message after 3 seconds
        echo "<script> 
        setTimeout(() => {
            document.querySelector('.alert').style.display = 'none';
        }, 3000);
        </script>";
    }
}

function get_cart_items_count()
{
    global $con;
    ///////////////////
    // To be changed
    ///////////////////
    global $user_id;
    global $ip_address;
    ///////////////////
    ///////////////////

    $select_query = "SELECT * FROM cart WHERE user_id = $user_id AND ip_address='$ip_address'";
    $result_query = mysqli_query($con, $select_query);
    $rows_count = $result_query->num_rows;

    if ($rows_count > 0) echo "<sup>$rows_count</sup>";
}


function get_product_price($pr_id)
{
    global $con;
    $select_query = "SELECT * FROM products WHERE pr_id = $pr_id";
    $result_query = mysqli_query($con, $select_query);
    $row = mysqli_fetch_array($result_query);
    return $row['pr_price'];
}

function get_cart_total()
{
    global $con;
    ///////////////////
    // To be changed
    ///////////////////
    global $user_id;
    global $ip_address;
    ///////////////////
    ///////////////////

    $total = 0;
    $select_query = "SELECT * FROM cart WHERE user_id = $user_id AND ip_address='$ip_address'";
    $result_query = mysqli_query($con, $select_query) or die(mysqli_error($con));
    while ($row = mysqli_fetch_array($result_query)) {
        $product_id = $row['pr_id'];
        $product_qty = $row['qty'];
        $product_price = get_product_price($product_id);
        $total += $product_qty * $product_price;
    }
    return $total;
}
