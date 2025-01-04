<?php
include("../includes/connect.php");
$number = 0;
$res_select = "";
// check if form submit button is clicked
if (isset($_GET['view_products'])) {
    // select data from db 
    /*
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
    */
    $select_query = "Select * from `products`";
    $res_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($res_select);
}
?>
<?php

if ($number > 0) {
?>
    <h2 class="text-center mb-3">View Products</h2>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">Product ID</th>
                <th scope="col">Product Title</th>
                <th scope="col">Product Image</th>
                <th scope="col">Product Price</th>
                <th scope="col">Product Description</th>
                <th scope="col">Product Keywords</th>
                <th scope="col">Product Brand</th>
                <th scope="col">Product Category</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($number > 0) {
                while ($row = mysqli_fetch_array($res_select)) {
                    $pr_id = $row['pr_id'];
                    $pr_title = $row['pr_title'];
                    $pr_img1 = $row['pr_img1'];
                    $pr_price = $row['pr_price'];
                    $pr_description = $row['pr_description'];
                    $pr_keywords = $row['pr_keywords'];
                    $br_id = $row['br_id'];
                    $cat_id = $row['cat_id'];
            ?>
                    <tr>
                        <th scope="row"><?php echo $pr_id; ?></th>
                        <td><?php echo $pr_title; ?></td>
                        <td><img src="./product_images/<?php echo $pr_img1; ?>" alt="" style="width: 50px; height: 50px;"></td>
                        <td><?php echo $pr_price; ?></td>
                        <td><?php echo $pr_description; ?></td>
                        <td><?php echo $pr_keywords; ?></td>
                        <td><?php echo $br_id; ?></td>
                        <td><?php echo $cat_id; ?></td>
                        <td><a href="edit_product.php?edit_id=<?php echo $pr_id; ?>">Edit</a></td>
                        <td><a href="index.php?view_products&delete_id=<?php echo $pr_id; ?>">Delete</a></td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
<?php
} else {
    echo "<h2 class='text-center'>No products found</h2>";
}
?>

<?php
// delete product but give warning first before deleting, if user click on delete button then delete product from db otherwize do nothing and show all products
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    echo "
    <script>
        if (confirm('Are you sure you want to delete this product?')) {
            window.location.href = 'index.php?view_products&confirm_delete_id=$delete_id';
        } else {
            window.location.href = 'index.php?view_products';
        }
    </script>
    ";
}

if (isset($_GET['confirm_delete_id'])) {
    $confirm_delete_id = $_GET['confirm_delete_id'];
    $delete_query = "DELETE FROM `products` WHERE pr_id = $confirm_delete_id";
    $result = mysqli_query($con, $delete_query);
    if ($result) {
        echo "<script>alert('Product deleted successfully');</script>";
        echo "<script>window.location.href = 'index.php?view_products';</script>";
    } else {
        echo "<script>alert('Error deleting product');</script>";
    }
}
