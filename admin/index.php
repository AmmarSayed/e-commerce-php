<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel='stylesheet' href='../style.css'>
    <title>Admin </title>
</head>

<body class=" d-flex flex-column h-100">
    <div class="container-fluid p-0">
        <!-- Start Navbar-->
        <nav class=" navbar navbar-expand-lg navbar-dark bg-secondary ">
            <div class="container-fluid">
                <img class="logo" src="../images/ng.png" alt="logo">

                <nav class=" navbar navbar-expand-lg  ">
                    <ul class="navbar-nav ">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Welcome Guest</a>
                        </li>

                    </ul>
                </nav>

            </div>
        </nav>
        <!-- End Navbar-->

        <!-- Start Second Child -->
        <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>
        <!-- End Second Child -->

        <!-- Start Third Child -->
        <div class="row m-0">
            <div class="col-md-12 bg-light p-3 border d-flex align-items-center ">

                <!-- start first Child -->
                <div class="p-3">
                    <a href="#"><img class="admin-img" src="../images/pinaple-juice.png" alt=""></a>
                    <p class="text-light text-center ">Admin Name</p>
                </div>
                <!-- end first Child -->

                <!-- start second Child -->
                <div class="text-center d-flex flex-wrap justify-content-around w-100">
                    <button class="btn btn-primary mb-3"><a href="insert_product.php" class="nav-link text-light ">Insert product</a></button>
                    <button class="btn btn-primary mb-3"><a href="index.php?view_products" class="nav-link text-light ">View products</a></button>
                    <button class="btn btn-primary mb-3"><a href="index.php?insert_category" class="nav-link text-light ">Insert Category</a></button>
                    <button class="btn btn-primary mb-3"><a href="index.php?insert_brand" class="nav-link text-light ">Insert Brand</a></button>
                    <button class="btn btn-primary mb-3"><a href="index.php?view_all_orders" class="nav-link text-light ">All orders</a></button>
                    <button class="btn btn-primary mb-3"><a href="index.php?view_all_payments" class="nav-link text-light ">All payments</a></button>
                    <button class="btn btn-primary mb-3"><a href="" class="nav-link text-light ">List users</a></button>
                    <button class="btn btn-primary mb-3"><a href="" class="nav-link text-light ">Logout</a></button>
                </div>
                <!-- end second Child -->

            </div>
        </div>
        <!-- End Third Child -->
    </div>

    <!-- Start Table of Content-->
    <div class="container my-3">
        <?php
        if (isset($_GET["insert_category"])) include("insert_category.php");
        if (isset($_GET["insert_brand"])) include("insert_brand.php");
        if (isset($_GET["view_products"])) include("view_products.php");

        if (isset($_GET["view_all_orders"])) include("view_all_orders.php");
        ?>
    </div>
    <!-- End Table of Content-->


</body>

<?php
include("../footer.php")
?>


</html>