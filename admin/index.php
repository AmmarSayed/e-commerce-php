<?php
include("../head.php")
?>

<head>
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
            <div class="col-md-12 bg-secondary p-3 d-flex align-items-center ">

                <!-- start first Child -->
                <div class="p-3">
                    <a href="#"><img class="admin-img" src="../images/pinaple-juice.png" alt=""></a>
                    <p class="text-light text-center ">Admin Name</p>
                </div>
                <!-- end first Child -->

                <!-- start second Child -->
                <div class="text-center d-flex flex-wrap justify-content-around w-100">
                    <button class="mb-3"><a href="insert_product.php" class="nav-link text-light bg-info my-1">Insert product</a></button>
                    <button class="mb-3"><a href="" class="nav-link text-light bg-info my-1">View products</a></button>
                    <button class="mb-3"><a href="index.php?insert_category" class="nav-link text-light bg-info my-1">Insert Category</a></button>
                    <button class="mb-3"><a href="" class="nav-link text-light bg-info my-1">View Categories</a></button>
                    <button class="mb-3"><a href="index.php?insert_brand" class="nav-link text-light bg-info my-1">Insert Brand</a></button>
                    <button class="mb-3"><a href="" class="nav-link text-light bg-info my-1">View Brands</a></button>
                    <button class="mb-3"><a href="" class="nav-link text-light bg-info my-1">All orders</a></button>
                    <button class="mb-3"><a href="" class="nav-link text-light bg-info my-1">All payments</a></button>
                    <button class="mb-3"><a href="" class="nav-link text-light bg-info my-1">List users</a></button>
                    <button class="mb-3"><a href="" class="nav-link text-light bg-info my-1">Logout</a></button>
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
        ?>
    </div>
    <!-- End Table of Content-->

    <?php
    include("../footer.php")
    ?>
</body>

</html>