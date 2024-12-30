<?php include("./includes/connect.php");
include("./functions/common_function.php");
include("./head.php");
?>

<link rel="stylesheet" href="./style.css">
<title>Ecommerce Website</title>
</head>

<body class="d-flex flex-column h-100">
    <div class="container-fluid p-0">
        <!-- Start Navbar-->
        <nav class=" navbar navbar-expand-lg navbar-light bg-light">
            <img class="logo" src="./images/ng.png" alt="logo">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto ">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
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
                        <a class="nav-link" href="#"><i class="fa-solid fa-cart-shopping"></i><sup>1</sup></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Total Price:100/-</a>
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
            <!-- start of row -->
            <div class="col-10 p-0">
                <!--Start all products Array -->
                <div class="row mx-auto">
                    <!-- fetch all products -->
                    <?php
                    get_products();
                    ?>
                </div>
                <!-- End all products Array-->
            </div>
            <!-- end of row -->

            <!-- Start Side Nav -->
            <div class="col-2 bg-secondary p-0">
                <!-- Start Brands Display -->
                <ul class="navbar-nav mr-auto me-auto text-center">
                    <!-- Start first item -->
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light">
                            <h4>Delivery Brands</h4>
                        </a>
                    </li>
                    <?php
                    getBrands();
                    ?>
                </ul>
                <!-- End Brands Display -->

                <!-- Start Category Display -->
                <ul class="navbar-nav mr-auto me-auto text-center">

                    <!-- Start first item -->
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-light">
                            <h4>Categories</h4>
                        </a>
                    </li>
                    <!-- End first item -->
                    <?php
                    getCategories();
                    ?>
                </ul>
                <!-- End Category Display -->
            </div>
            <!-- End Side Nav -->
        </div>
    </div>

    <?php include("./footer.php") ?>
</body>

</html>