<?php
include("../includes/connect.php");

// Directory to store images
$upload_dir = "./product_images/";

if (isset($_POST['insert_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_description'];
    $product_keywords = $_POST['product_keywords'];
    $product_category = $_POST['product_category'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_status = 'true';

    // Accessing the images and generating unique names
    $extension1 = pathinfo($_FILES['product_image1']['name'], PATHINFO_EXTENSION);
    $extension2 = pathinfo($_FILES['product_image2']['name'], PATHINFO_EXTENSION);
    $extension3 = pathinfo($_FILES['product_image3']['name'], PATHINFO_EXTENSION);

    $product_image1 = uniqid() . '.' . $extension1;
    $product_image2 = uniqid() . '.' . $extension2;
    $product_image3 = uniqid() . '.' . $extension3;

    // Accessing images tmp names
    $tmp_product_image1 = $_FILES['product_image1']['tmp_name'];
    $tmp_product_image2 = $_FILES['product_image2']['tmp_name'];
    $tmp_product_image3 = $_FILES['product_image3']['tmp_name'];

    // Move uploaded files to the target directory with unique names
    $move1 = move_uploaded_file($tmp_product_image1, $upload_dir . $product_image1);
    $move2 = move_uploaded_file($tmp_product_image2, $upload_dir . $product_image2);
    $move3 = move_uploaded_file($tmp_product_image3, $upload_dir . $product_image3);

    // Check if all files were moved successfully
    if (!$move1 or !$move2 or !$move3) {  // Redirect to prevent duplicate submissions
        header("Location: " . $_SERVER['PHP_SELF'] . "?success=0");
        exit();
    }
    // Insert product details into the database
    $insert_product = "INSERT INTO `products` 
            (pr_title, pr_description, pr_keywords, cat_id, br_id, pr_img1, pr_img2, pr_img3, pr_price, date, status) 
            VALUES ('$product_title', '$product_description', '$product_keywords', '$product_category', '$product_brand', 
                    '$product_image1', '$product_image2', '$product_image3', $product_price, NOW(), '$product_status')";

    // commit the insertion
    $result_query = mysqli_query($con, $insert_product);

    // check if success
    if ($result_query) {
        // Redirect to prevent duplicate submissions
        header("Location: " . $_SERVER['PHP_SELF'] . "?success=1");
        exit();
    }
}

// Display success message if redirected
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<script>alert('Product inserted successfully!')</script>";
}
if (isset($_GET['success']) && $_GET['success'] == 0) {
    echo "<script>alert('Error moving one or more files, please fill in all data.')</script>";
}

include("../head.php");
?>


<link rel='stylesheet' href='../style.css'>
<title>Insert Products-Admin Dashboard</title>
</head>

<body class="d-flex flex-column h-100 bg-light">
    <div class="container mx-auto mt-3">
        <div class="row mb-3">
            <button class="btn btn-primary text-white"><a href="index.php">
                    <p class="text-white m-0">Back to home page</p>
                </a></button>
            <h1 class="text-center  ml-5 "> Insert Product </h1>
        </div>
        <!-- Start Form -->
        <!-- the attribute  formenctype="multipart/form-data" to allow image uploads to the server-->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- start title field -->
            <div class="form-outline mb-4 mx-auto w-75">
                <label for="product_title" class="form-label">
                    Product title
                </label>
                <input type="text" name="product_title" id="product_title" class="form-control" placeholder="Enter product title" autocomplete="off" autofocus required>
            </div>
            <!-- end title field -->

            <!-- start description field -->
            <div class="form-outline mb-4 mx-auto w-75">
                <label for="product_description" class="form-label">
                    Product description
                </label>
                <input type="text-area" name="product_description" id="product_description" class="form-control" placeholder="Enter product description" autocomplete="off" required>
            </div>
            <!-- end description field -->

            <!-- start keywords field -->
            <div class="form-outline mb-4 mx-auto w-75">
                <label for="product_keywords" class="form-label">
                    Product keywords
                </label>
                <input type="text" name="product_keywords" id="product_keywords" class="form-control" placeholder="Enter product keywords" autocomplete="off" required>
            </div>
            <!-- end keywords field -->

            <!-- start categories field -->
            <div class="input-group mb-4 mx-auto w-75">
                <div class="input-group-prepend w-25">
                    <label for="product_category" class="input-group-text w-100">Categories</label>
                </div>

                <select name="product_category" id="product_category" class="custom-select">
                    <option value="">Select a category</option>
                    <?php
                    $select_query = "Select * from`categories`;";
                    $result_query = mysqli_query($con, $select_query);
                    $cat_array = mysqli_fetch_row($result_query);

                    if ($result_query) {
                        while ($row = mysqli_fetch_assoc($result_query)) {
                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];
                            echo "<option value='$cat_id'>$cat_title</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <!-- end categories field -->

            <!-- start brands field -->
            <div class="input-group mb-4 mx-auto w-75">
                <div class="input-group-prepend w-25">
                    <label for="product_brand" class="input-group-text w-100">Brands</label>
                </div>

                <select name="product_brand" id="product_brand" class="custom-select">
                    <option value="">Select a brand</option>

                    <?php
                    $select_query = "Select * from`brands`;";
                    $result_query = mysqli_query($con, $select_query);
                    $cat_array = mysqli_fetch_row($result_query);

                    if ($result_query) {
                        while ($row = mysqli_fetch_assoc($result_query)) {
                            $br_title = $row['br_title'];
                            $br_id = $row['br_id'];
                            echo "<option value='$br_id'>$br_title</option>";
                        }
                    }
                    ?>

                </select>
            </div>
            <!-- end brands field -->

            <!-- start image1 field -->
            <div class="input-group mb-4 mx-auto w-75">
                <label for="product_image1" aria-describedby="product_image1">Image 1</label>
                <input type="file" name="product_image1" id="product_image1">
            </div>
            <!-- end image1 field -->

            <!-- start image2 field -->
            <div class="input-group mb-4 mx-auto w-75 ">
                <label for="product_image2" aria-describedby="product_image2">Image 2</label>
                <input type="file" name="product_image2" id="product_image2">

            </div>
            <!-- end image2 field -->


            <!-- start image3 field -->
            <div class=" input-group mb-4 mx-auto w-75">
                <label for="product_image3" aria-describedby="product_image3">Image 3</label>
                <input type="file" name="product_image3" id="product_image3">
            </div>
            <!-- end image3 field -->

            <!-- start price field -->
            <div class="form-outline mb-4 mx-auto w-75">
                <label for="product_price" class="form-label">
                    Product price
                </label>
                <input type="number" name="product_price" id="product_price" class="form-control" placeholder="Enter product price" autocomplete="off" autofocus required>
            </div>
            <!-- end price field -->

            <!-- start submit button -->
            <div class="form-outline mb-4 mx-auto w-75">
                <input type="submit" name="insert_product" id="insert_product" class="btn btn-info mb-3  w-100 px-3 to" value="Insert Porduct" autocomplete="off" required>
            </div>
            <!-- end submit button -->


        </form>
        <!-- End Form -->

    </div>



    <?php include("../footer.php");
    ?>

</body>

</html>