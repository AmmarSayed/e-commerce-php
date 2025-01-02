<?php
// Database connection
include("../includes/connect.php");
include("../functions/common_function.php");

// Get order ID from URL
$order_id = isset($_GET['order_id']) ? intval($_GET['order_id']) : 0;
if ($order_id == 0) {
    echo "<p>Invalid order ID.</p>";
    exit;
} // Fetch order details
$stmt = $con->prepare("SELECT * FROM orders WHERE order_id = ?");
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();
$result_items = null;
?>

<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="../style.css">

    <title>Single Order</title>
</head>

<body class=" d-flex flex-column h-100">
    <!-- Start Navbar-->
    <nav class=" navbar navbar-expand-lg navbar-light border bg-light">
        <img class="logo" src="../images/ng.png" alt="logo">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto ">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="./register.php">
                        <?php

                        if (isset($_SESSION['usr_name'])) {
                            echo "";
                        } else {
                            echo "Register";
                        }
                        ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="../cart.php"><i class="fa-solid fa-cart-shopping"></i>
                        <?php
                        get_cart_items_count()
                        ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Total Price: <?php print_r(get_cart_total() . "$")  ?></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search with keyword" aria-label="Search" name="keywords">
                <input type="submit" value="Search" class="btn btn-outline-dark">
            </form>
        </div>
    </nav>
    <!-- End Navbar-->


    <div class="container container-fluid">
        <div class="container">
            <?php
            if ($result->num_rows > 0) {
                // Output order details
                $order = $result->fetch_assoc();
                echo "<h1>Order #" . $order['order_id'] . "</h1>";
                echo "<p>Customer ID: " . $order['usr_id'] . "</p>";
                echo "<p>Order Date: " . $order['order_date'] . "</p>";
                echo "<p>Total Amount: $" . $order['amount_due'] . "</p>";
            ?>

            <?php
                $inv_number = $order['inv_number'];
                $sql_items = "SELECT * FROM `pending_orders` 
                JOIN products ON pending_orders.pr_id = products.pr_id 
                WHERE inv_number = ?";
                $stmt_items = $con->prepare($sql_items);
                $stmt_items->bind_param("i", $inv_number);
                $stmt_items->execute();
                $result_items = $stmt_items->get_result();
            }

            if ($stmt_items->error) {
                echo "<p>Error fetching order items: " . $stmt_items->error . "</p>";
            } else if ($result_items->num_rows > 0) {
                if ($result_items->num_rows > 0) {
                    echo "<h2>Order Items</h2>";
                    echo "<ul>";
                    while ($item = $result_items->fetch_assoc()) {
                        echo "<li>" . $item['pr_title'] . " - Quantity: " . $item['pr_qty'] . " - Price: $" . $item['pr_price'] . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No items found for this order.</p>";
                }
            } else {
                echo "<p>Order not found.</p>";
            }
            ?>
        </div>

    </div>

</body>
<?php
include("../footer.php");
?>

</html>
<?php
$con->close();

?>