<?php
include('../includes/connect.php');
include('../functions/common_function.php');
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
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $query = "SELECT * FROM products WHERE pr_id = $edit_id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    $pr_title = $row['pr_title'];
    $pr_description = $row['pr_description'];
    $pr_keywords = $row['pr_keywords'];
    $cat_id = $row['cat_id'];
    $br_id = $row['br_id'];
    $pr_img1 = $row['pr_img1'];
    $pr_img2 = $row['pr_img2'];
    $pr_img3 = $row['pr_img3'];
    $pr_price = $row['pr_price'];
    $status = $row['status'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- bootstrap file -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel='stylesheet' href='../style.css'>
    <title>Edit Product </title>
</head>


<body>
    <div class="container">
        <h1>Edit Product</h1>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="pr_id" value="<?php echo $edit_id; ?>">

            <!-- start title field -->
            <div class="form-outline mb-4 mx-auto w-75">
                <label for="pr_title" class="form-label">Product Title:</label>
                <input type="text" name="pr_title" id="pr_title" class="form-control" value="<?php echo $pr_title; ?>" required>
            </div>
            <!-- end title field -->

            <!-- start description field -->
            <div class="form-outline mb-4 mx-auto w-75">
                <label for="pr_description" class="form-label">Product Description:</label>
                <textarea name="pr_description" id="pr_description" class="form-control" required><?php echo $pr_description; ?></textarea>
            </div>
            <!-- end description field -->

            <!-- start keywords field -->
            <div class="form-outline mb-4 mx-auto w-75">
                <label for="pr_keywords" class="form-label">Product Keywords:</label>
                <input type="text" name="pr_keywords" id="pr_keywords" class="form-control" value="<?php echo $pr_keywords; ?>" required>
            </div>
            <!-- end keywords field -->

            <!-- start categories field -->
            <div class="input-group mb-4 mx-auto w-75">
                <div class="input-group-prepend w-25">
                    <label for="cat_id" class="input-group-text w-100">Category</label>
                </div>
                <select name="cat_id" id="cat_id" class="custom-select" required>
                    <option value="">Select a category</option>
                    <?php

                    $select_query = "SELECT * FROM categories";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $cat_title = $row['cat_title'];
                        $cat_id_db = $row['cat_id'];
                        $selected = ($cat_id_db == $cat_id) ? 'selected' : '';
                        echo "<option value='$cat_id_db' $selected>$cat_title</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- end categories field -->

            <!-- start brands field -->
            <div class="input-group mb-4 mx-auto w-75">
                <div class="input-group-prepend w-25">
                    <label for="br_id" class="input-group-text w-100">Brand</label>
                </div>
                <select name="br_id" id="br_id" class="custom-select" required>
                    <option value="">Select a brand</option>
                    <?php

                    $select_query = "SELECT * FROM brands";
                    $result_query = mysqli_query($con, $select_query);
                    while ($row = mysqli_fetch_assoc($result_query)) {
                        $br_title = $row['br_title'];
                        $br_id_db = $row['br_id'];
                        $selected = ($br_id_db == $br_id) ? 'selected' : '';
                        echo "<option value='$br_id_db' $selected>$br_title</option>";
                    }
                    ?>
                </select>
            </div>
            <!-- end brands field -->

            <!-- start image1 field -->
            <div class="input-group mb-4 mx-auto w-75">
                <label for="pr_img1" aria-describedby="pr_img1">Image 1</label>
                <input type="file" name="pr_img1" id="pr_img1">
                <img src="product_images/<?php echo $pr_img1; ?>" width="100">
            </div>
            <!-- end image1 field -->

            <!-- start image2 field -->
            <div class="input-group mb-4 mx-auto w-75">
                <label for="pr_img2" aria-describedby="pr_img2">Image 2</label>
                <input type="file" name="pr_img2" id="pr_img2">
                <img src="product_images/<?php echo $pr_img2; ?>" width="100">
            </div>
            <!-- end image2 field -->

            <!-- start image3 field -->
            <div class="input-group mb-4 mx-auto w-75">
                <label for="pr_img3" aria-describedby="pr_img3">Image 3</label>
                <input type="file" name="pr_img3" id="pr_img3">
                <img src="product_images/<?php echo $pr_img3; ?>" width="100">
            </div>
            <!-- end image3 field -->

            <input type="hidden" name="existing_img1" value="<?php echo $pr_img1; ?>">
            <input type="hidden" name="existing_img2" value="<?php echo $pr_img2; ?>">
            <input type="hidden" name="existing_img3" value="<?php echo $pr_img3; ?>">


            <!-- start price field -->
            <div class="form-outline mb-4 mx-auto w-75">
                <label for="pr_price" class="form-label">Product Price:</label>
                <input type="text" name="pr_price" id="pr_price" class="form-control" value="<?php echo $pr_price; ?>" required>
            </div>
            <!-- end price field -->

            <!-- start status field -->
            <div class="form-outline mb-4 mx-auto w-75">
                <label for="status" class="form-label">Status:</label>
                <input type="text" name="status" id="status" class="form-control" value="<?php echo $status; ?>" required>
            </div>
            <!-- end status field -->
            <!-- start submit and cancel buttons -->
            <div class="form-outline mb-4 mx-auto w-75 d-flex ">
                <input type="submit" name="update_product" id="update_product" class="btn btn-info mb-3 w-50 px-3" value="Update Product">
                <a href="index.php?view_products" class="btn btn-danger mb-3 w-50 px-3">Cancel</a>
            </div>
            <!-- end submit and cancel buttons -->
        </form>
    </div>
</body>

<?php
include('../footer.php');
?>

</html>

<?php
// update the product
if (isset($_POST['update_product'])) {
    $pr_id = $_POST['pr_id'];
    $pr_title = $_POST['pr_title'];
    $pr_description = $_POST['pr_description'];
    $pr_keywords = $_POST['pr_keywords'];
    $cat_id = $_POST['cat_id'];
    $br_id = $_POST['br_id'];
    $pr_price = $_POST['pr_price'];
    $status = $_POST['status'];

    $pr_img1 = $_FILES['pr_img1']['name'];
    $pr_img2 = $_FILES['pr_img2']['name'];
    $pr_img3 = $_FILES['pr_img3']['name'];

    $pr_img1_tmp = $_FILES['pr_img1']['tmp_name'];
    $pr_img2_tmp = $_FILES['pr_img2']['tmp_name'];
    $pr_img3_tmp = $_FILES['pr_img3']['tmp_name'];

    if ($pr_img1) {
        move_uploaded_file($pr_img1_tmp, "product_images/$pr_img1");
    } else {
        $pr_img1 = $_POST['existing_img1'];
    }

    if ($pr_img2) {
        move_uploaded_file($pr_img2_tmp, "product_images/$pr_img2");
    } else {
        $pr_img2 = $_POST['existing_img2'];
    }

    if ($pr_img3) {
        move_uploaded_file($pr_img3_tmp, "product_images/$pr_img3");
    } else {
        $pr_img3 = $_POST['existing_img3'];
    }

    $update_query = "UPDATE products SET pr_title='$pr_title', pr_description='$pr_description', pr_keywords='$pr_keywords', cat_id='$cat_id', br_id='$br_id', pr_img1='$pr_img1', pr_img2='$pr_img2', pr_img3='$pr_img3', pr_price='$pr_price', status='$status' WHERE pr_id=$pr_id";

    if (mysqli_query($con, $update_query)) {
        echo "<script>alert('Product updated successfully.')</script>";
        echo "<script>window.open('index.php?view_products', '_self')</script>";
    } else {
        echo "Error updating product: " . mysqli_error($con);
    }
}
