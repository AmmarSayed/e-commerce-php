<?php
session_start();
include("../functions/common_function.php");

// Database connection
include("../includes/connect.php"); // Assuming this file contains $conn or

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Assuming user ID is passed via GET request
$usr_id = isset($_SESSION['usr_id']) ? $_SESSION['usr_id'] : 0;
$usr_name = isset($_SESSION['usr_name']) ? $_SESSION['usr_name'] : 0;

// Fetch user data
$sql = "SELECT * FROM users WHERE usr_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $usr_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    $usr_name = $user['usr_name'];
    $usr_email = $user['usr_email'];
    $usr_img = $user['usr_img'];
    $usr_address = $user['usr_address'];
    $usr_contact = $user['usr_contact'];
    $usr_ip = $user['usr_ip'];
} else {
    echo "User not found.";
    exit;
}


//get pending orders to alert the user
$sql = "SELECT * FROM orders WHERE usr_id = ? AND order_status = 'pending'";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $usr_id);
$stmt->execute();
$result = $stmt->get_result();
$orders = $result->fetch_assoc();


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

    <title>User Profile</title>
</head>

<body>
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

    <div class="container container-fluid my-5">
        <h2 class="text-center">User Profile</h2>

        <div class="row align-items-center justify-content-center">
            <div class="col-md-8 col-xl-6">
                <div class="card single-product">
                    <img src="./users_images/<?php echo $usr_img; ?>" class="card-img-top" alt="user image">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?php echo $usr_name; ?>
                        </h5>
                        <p class="card-text">Email: <?php echo $usr_email; ?></p>
                        <p class="card-text">Address: <?php echo $usr_address; ?></p>
                        <p class="card-text">Contact: <?php echo $usr_contact; ?></p>
                        <p class="card-text">IP Address: <?php echo $usr_ip; ?></p>

                        <?php
                        if ($orders) {
                            echo '<div class="alert alert-warning" role="alert">
                            You have pending orders! </div>';
                        } else {
                            echo '<div class="alert alert-success" role="alert">
                            You have no pending orders! </div>';
                        }
                        ?>

                        <a href="./edit_profile.php" class="btn btn-primary">Edit Profile</a>
                        <a href="./view_orders.php" class="btn btn-warning">View Orders</a>
                        <a href="./delete_account.php" class="btn btn-danger">Delete Account</a>
                        <a href="./logout.php" class="btn btn-secondary">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>


<?php


// Close prepared statement
$stmt->close();
$con->close();


?>