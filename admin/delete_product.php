<?php
include('../includes/connect.php');

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch product details
    $query = "SELECT * FROM products WHERE pr_id = $product_id";
    $result = mysqli_query($con, $query);
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        echo "Product not found.";
        exit;
    }

    if (isset($_POST['confirm_delete'])) {
        // Delete product
        $delete_query = "DELETE FROM products WHERE id = $product_id";
        if (mysqli_query($conn, $delete_query)) {
            echo "Product deleted successfully.";
        } else {
            echo "Error deleting product: " . mysqli_error($conn);
        }
        exit;
    }
} else {
    echo "No product ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Product</title>
</head>

<body>
    <h1>Delete Product</h1>
    <p>Are you sure you want to delete the product: <?php echo $product['pr_title']; ?>?</p>
    <form method="post">
        <input type="hidden" name="confirm_delete" value="1">
        <button type="submit">Yes, Delete</button>
        <a href="products.php">Cancel</a>
    </form>
</body>

</html>