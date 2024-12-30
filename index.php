<link rel="stylesheet" href="./style.css">
<title>Ecommerce Website</title>
</head>

<?php
include("./functions/common_function.php");
include("./head.php");
?>

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
                        <a class="nav-link" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i>
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
                    <a class="nav-link" href="#">Welcome Guest</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Login</a>
                </li>

            </ul>
        </nav>

        <!-- third child -->
        <!-- <div class="alert alert-light">
            <h3 class="text-center">Hidden Store</h3>
            <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, excepturi.</p>
        </div> -->

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