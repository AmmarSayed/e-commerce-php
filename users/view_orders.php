<?php
session_start();
include("../functions/common_function.php");
include("../includes/connect.php");

$usr_id = isset($_SESSION['usr_id']) ? $_SESSION['usr_id'] : 0;

// Fetch pending orders
$sql = "SELECT * FROM orders WHERE usr_id = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $usr_id);
$stmt->execute();
$result = $stmt->get_result();
$orders = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $orders[] = $row;
    }
}

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

    <title>Pending Orders</title>
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
        </div>
    </nav>
    <!-- End Navbar-->


    <div class="container container-fluid">
        <h1 class="text-center">Pending Orders</h1>
        <table class="table table-bordered w-100">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Order Status</th>
                    <th>Order Total</th>
                    <th>Invoice Number</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (is_array($orders) && !empty($orders)) {
                    foreach ($orders as $order) {
                ?>
                        <tr>
                            <td><?php echo $order['order_id'] ?></td>
                            <td><?php echo $order['order_date'] ?></td>
                            <td><?php echo $order['order_status'] ?></td>
                            <td><?php echo $order['amount_due'] ?>$</td>
                            <td><?php echo $order['inv_number'] ?></td>
                            <td>
                                <?php
                                if ($order['order_status'] == 'pending') {
                                    echo '<span class="badge badge-warning"> pending </span>';
                                } else {
                                    echo '<span class="badge badge-success"> confirmed </span>';
                                }
                                ?>
                                </span>
                            </td>
                            <td class="p-0 d-flex justify-content-around">
                                <a href="single_order.php?order_id=<?php echo $order['order_id'] ?>" class="btn btn-primary">🔎</a>


                                <?php if ($order['order_status'] == 'pending') { ?>
                                    <form action="" method="GET">
                                        <input type="hidden" name="order_id" value="<?php echo $order['order_id'] ?>">
                                        <input type="hidden" name="inv_number" value="<?php echo $order['inv_number'] ?>">
                                        <input type="submit" name="confirm" value="✅" class="btn btn-success">
                                    <?php } ?>
                                    </form>
                                    <!-- delete invoice using form-->
                                    <form action="" method="GET">
                                        <input type="hidden" name="order_id" value="<?php echo $order['order_id'] ?>">
                                        <input type="hidden" name="inv_number" value="<?php echo $order['inv_number'] ?>">
                                        <?php if ($order['order_status'] == 'pending') { ?>
                                            <input type="submit" name="delete" value="✕" class="btn btn-danger">
                                        <?php } ?>
                                    </form>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="5" class="text-center">No pending orders found</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
</body>

</html>

<?php

// delete order
if (isset($_GET['delete'])) {
    $order_id = $_GET['order_id'];
    $inv_number = $_GET['inv_number'];

    // delete order
    $sql = "DELETE FROM orders WHERE order_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();

    // delete pending order
    $sql = "DELETE FROM pending_orders WHERE inv_number = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $inv_number);
    $stmt->execute();

    // redirect to view_orders.php
    echo "<script>window.location.href='view_orders.php'</script>";
}


// Confirm order
if (isset($_GET['confirm'])) {
    $order_id = $_GET['order_id'];
    $inv_number = $_GET['inv_number'];

    // update order status
    $sql = "UPDATE orders SET order_status = 'confirmed' WHERE order_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();

    // update pending order status
    $sql = "UPDATE pending_orders SET order_status = 'confirmed' WHERE inv_number = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $inv_number);
    $stmt->execute();

    // redirect to view_orders.php
    echo "<script>window.location.href='view_orders.php'</script>";
}


// Close prepared statement
$stmt->close();
