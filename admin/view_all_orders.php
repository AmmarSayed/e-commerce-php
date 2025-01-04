<!-- view all orders with all users -->

<?php
include("../includes/connect.php");

/*
oders table :

order_id
usr_id
amount_due
inv_number
total_products
order_date
order_status


pending orders table :

usr_id
inv_number
pr_id
pr_qty
order_status


products table :
pr_id
pr_title
pr_description
pr_keywords
cat_id
br_id
pr_img1
pr_img2
pr_img3
pr_price
date
status

users table :
usr_id
usr_name
usr_password
usr_email
usr_img
usr_address
usr_contact
usr_ip


 */
?>

<link rel="stylesheet" href="../style.css">
<!-- generate the page -->
<h2 class="text-center">All Orders</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Amount Due</th>
            <th>Invoice Number</th>
            <th>Total Products</th>
            <th>Order Date</th>
            <th>Order Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = "SELECT * FROM orders";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {

        ?>
                <tr>
                    <td> <?php echo $row['order_id'] ?></td>
                    <td> <?php echo $row['usr_id'] ?></td>
                    <td> <?php echo $row['amount_due'] ?></td>
                    <td> <?php echo $row['inv_number'] ?></td>
                    <td> <?php echo $row['total_products'] ?></td>
                    <td> <?php echo $row['order_date'] ?></td>
                    <td> <?php echo $row['order_status'] ?></td>
                    <td> <a href="index.php?view_all_orders&id=<?php echo $row['order_id'] ?>">View</a></td>
                </tr>
            <?php
            }
        } else {
            ?> <tr>
                <td colspan='7'> No orders found.</td>
            </tr>
        <?php

        }
        ?>

    </tbody>
</table>



<?php

// view single order details
if (isset($_GET['id'])) {
    $order_id = $_GET['id'];

    $sql = "SELECT * FROM orders WHERE order_id='$order_id'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <div id="orderModal" class="modal">
            <div class="modal-content">
                <span class="btn btn-primary" id="close-modal">&times;</span>
                <h2 class="mt-5 text-center">Order Details</h2>
                <h3 class="text-center">Inv: <?php echo $row['inv_number'] ?></h3>
                <h3 class="text-center">Order Total: <?php echo $row['amount_due'] ?>$</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Quantity</th>
                            <th>Price</th>
                            <th>Sub-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM pending_orders WHERE inv_number='$row[inv_number]'";
                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                                // get product details from db
                                $product_id = $row['pr_id'];
                                $sql_product = "SELECT * FROM products WHERE pr_id='$product_id'";
                                $result_product = $con->query($sql_product);
                                $result_product = $result_product->fetch_assoc();
                        ?>
                                <tr>
                                    <td> <?php echo $result_product['pr_title'] ?></td>
                                    <td> <?php echo $row['pr_qty'] ?></td>
                                    <td> <?php echo $result_product['pr_price'] ?></td>
                                    <td> <?php echo $result_product['pr_price'] * $row['pr_qty'] ?></td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?> <tr>
                                <td colspan='7'> No items found.</td>
                            </tr>
                        <?php

                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>

<?php
    }
}
?>



<script>
    const modal = document.getElementById("orderModal");
    const closeModalSpan = document.getElementById("close-modal");
    // get a with data-modal attribute

    window.onload = function() {
        modal.style.display = "block";
    }

    //toggle modal
    closeModalSpan.onclick = function() {
        modal.style.display = "none";
    }
</script>