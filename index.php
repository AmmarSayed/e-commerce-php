<?php
session_start();
include("./functions/common_function.php");
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


    <link rel="stylesheet" href="./style.css">

    <title>Ecommerce Website</title>
</head>

<body class="d-flex flex-column h-100">

    <div class="container-fluid p-0">
        <!-- Start Navbar-->
        <nav class=" navbar navbar-expand-lg navbar-light border bg-light">
            <img class="logo" src="./images/ng.png" alt="logo">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto ">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="./users/register.php">
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
                        <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i>
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

        <!-- second child -->
        <nav class="my-3 alert-secondary">
            <ul class="nav justify-content-end me-auto">

                <li class="nav-item">
                    <a class="nav-link" href="./users/profile.php">Welcome
                        <?php
                        if (isset($_SESSION['usr_name'])) {
                            echo $_SESSION['usr_name'];
                        } else {
                            echo "Guest";
                        }
                        ?>
                    </a>
                </li>
                <li class="nav-item">

                    <?php
                    if (isset($_SESSION['usr_name'])) {
                        echo "<a class='nav-link' href='users/logout.php'>Logout</a>";
                    } else {
                        echo "<a class='nav-link' href='users/login.php'>Login</a>";
                    }
                    ?>
                </li>

            </ul>
        </nav>

        <!-- third child -->
        <!-- 
        <div class="alert alert-light">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, excepturi.</p>
        </div> 
        -->

        <!-- fourth child -->
        <div class="container-fluid mx-auto row p-0">
            <?php
            handle_add_to_cart();
            ?>
            <!-- start of row -->
            <div class="col-10 p-0">
                <!--Start all products Array -->
                <div class="row mx-auto">

                    <!-- fetch all products -->
                    <?php
                    if (isset($_GET['product_id'])) get_single_product();
                    else get_products();
                    ?>
                </div>
                <!-- End all products Array-->
            </div>
            <!-- end of row -->

            <!-- Start Side Nav -->
            <div class="col-2 p-0">

                <!-- Start Brands Display -->
                <div class="accordion" id="accordionExample">
                    <div class="list">
                        <div class="" id="headingOne">
                            <h2 class="mb-0">
                                <div class="bg-primary text-light text-center" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    <p class="p-2 m-0">Brands</p>
                                </div>
                            </h2>
                        </div>
                        <div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="">
                                <ul class="list-group">
                                    <?php
                                    getBrands();
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Brands Display -->

                    <!-- Start Category Display -->
                    <div class="accordion" id="accordionExample">
                        <div class=" list">
                            <div class="" id="headingOne">
                                <h2 class="mb-0">
                                    <div class=" bg-primary text-light text-center" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                                        <p class="p-2 m-0">Categories</p>
                                    </div>
                                </h2>
                            </div>
                            <div id="collapse2" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                <div class="">
                                    <ul class="list-group">
                                        <?php
                                        getCategories();
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- End Category Display -->
                    </div>
                </div>
                <!-- End Side Nav -->
            </div>
        </div>

        <?php include("./footer.php") ?>
</body>

</html>