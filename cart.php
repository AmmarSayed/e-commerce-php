<link rel="stylesheet" href="./style.css">
<title>Cart Details</title>
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
        <div class="container">
            <div class="row">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Product Title</th>
                            <th>Image</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Remove</th>
                            <th>Operations</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>Apple</td>
                            <td><img src="./images/10.png" alt=""></td>
                            <td><input type="number" name="" id="" value="1"></td>
                            <td>9000</td>
                            <td><input type="checkbox" name="" id=""></td>
                            <td>
                                <p>update</p>
                                <p>remove</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- subtotal -->
                <div class="d-flex mb-3">
                    <h4 class="px-3">Sub-total: <strong>2000</strong></h4>
                    <a href="index.php"><button class="btn btn-secondary">continue shopping</button></a>
                    <a href="#"><button class="mx-3 btn btn-primary">checkout</button></a>
                </div>
            </div>
        </div>

    </div>

    <?php include("./footer.php") ?>
</body>

</html>