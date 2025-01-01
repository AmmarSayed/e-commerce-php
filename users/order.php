<?php
session_start();

include("../includes/connect.php");
global $con;

// get the user IP address
$ip_address = 16;

// get the user IP address
$ip_address = $ip_address ? $ip_address : $_SERVER['REMOTE_ADDR'];

// usr_id
$user_id = isset($_SESSION['usr_id']) ? $_SESSION['usr_id'] : 0;

$total = 0;
$qty = 0;

$select_cart_items = "SELECT * FROM cart WHERE ip_address='$ip_address'";
$result_cart = mysqli_query($con, $select_cart_items);
$inv_number = mt_rand();

$status = "pending";

// calculate the total price and quantity of the items from the cart
while ($row_cart = mysqli_fetch_array($result_cart)) {
    $product_id = $row_cart['pr_id'];
    $product_qty = $row_cart['qty'];

    $get_product = "SELECT * FROM products WHERE pr_id='$product_id'";
    $result_product = mysqli_query($con, $get_product);
    $row_product = mysqli_fetch_array($result_product);
    $product_price = $row_product['pr_price'];
    $total += $product_price * $product_qty;
    $qty += $product_qty;

    // insert the order details into the pending_orders table
    $insert_pending_order = "INSERT INTO pending_orders (usr_id, inv_number, pr_id, pr_qty, order_status) VALUES ('$user_id', '$inv_number', '$product_id', '$product_qty', '$status')";
    mysqli_query($con, $insert_pending_order);
}

// insert the order into the orders table
$insert_order = "INSERT INTO orders (usr_id, amount_due, inv_number, total_products, order_date, order_status) VALUES ('$user_id', '$total', '$inv_number', '$qty', NOW(), '$status')";
mysqli_query($con, $insert_order);

// empty the cart
$empty_cart = "DELETE FROM cart WHERE ip_address='$ip_address'";
mysqli_query($con, $empty_cart);

// redirect to the profile page
echo "<script>alert('Order has been placed successfully!')</script>";
header("Location: ../users/profile.php");
