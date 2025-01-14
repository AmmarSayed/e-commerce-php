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
    <title>Cart Details</title>
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

        <?php
        handle_delete_cart_item();
        handle_empty_cart();
        update_cart_quantity();
        ?>
        <div class="container">
            <div class="row">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>Product Title</th>
                            <th>Image</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Sub-total</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- php code to display dynamic data -->
                        <?php
                        get_cart_items();
                        ?>
                    </tbody>
                </table>
                <!-- subtotal -->
                <div class="row col-12 align-items-center mb-3">
                    <div class="d-flex  align-items-center">
                        <h4 class="px-3 m-0">Sub-total: <strong><?php echo get_cart_total() . "$" ?></strong></h4>
                        <a href="index.php"><button class="btn btn-success">Continue Shopping</button></a>
                        <a href="./users/checkout.php"><button class="mx-3 btn btn-primary">Checkout</button></a>
                    </div>

                    <!-- empty cart -->
                    <a href='cart.php?empty_cart' class="ml-auto">
                        <button class='btn btn-danger'>
                            <i class='fa fa-trash'></i> Clear Cart</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php include("./footer.php") ?>
</body>

</html>