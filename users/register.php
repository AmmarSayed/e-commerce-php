<?php
include("../includes/connect.php");



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
</head>

<body>

    <div class="container-fluid my-5">
        <h2 class="text-center">New User Registeration</h2>

        <div class="row align-items-center justify-content-center">
            <div class="col-md-8 col-xl-6">
                <form action="" method="post" enctype="multipart/form-data">
                    <!-- username -->

                    <div class="form-group mb-3">
                        <label for="usr_name">Username</label>
                        <input type="text" class="form-control" id="usr_name" name="usr_name" placeholder="enter your username" required autocomplete="off">
                    </div>

                    <!-- email -->
                    <div class="form-group mb-3">
                        <label for="usr_email">Email</label>
                        <input type="email" class="form-control" id="usr_email" name="usr_email" placeholder="enter your email" required autocomplete="off">
                    </div>

                    <!-- User Image -->
                    <div class="form-group">
                        <label for="usr_image">User Image</label>
                        <input type="file" class="form-control-file" id="usr_image" name="usr_image" required>
                    </div>

                    <!-- password -->
                    <div class="form-group mb-3">
                        <label for="usr_password">Password</label>
                        <input type="password" class="form-control" id="usr_password" name="usr_password" placeholder="enter your password" required autocomplete="off">
                    </div>

                    <!-- password confirm-->
                    <div class="form-group mb-3">
                        <label for="usr_password">Confirm Password</label>
                        <input type="password" class="form-control" id="conf_usr_password" name="conf_usr_password" placeholder="confirm password" required autocomplete="off">
                    </div>


                    <!-- User Address-->
                    <div class="form-group mb-3">
                        <label for="usr_address">Address</label>
                        <input type="text" class="form-control" id="usr_address" name="usr_address" placeholder="enter your address" required autocomplete="off">
                    </div>

                    <!-- contact number -->
                    <div class="form-group mb-3">
                        <label for="usr_contact">Contact Number</label>
                        <input type="text" class="form-control" id="usr_contact" name="usr_contact" placeholder="enter your contact number" required autocomplete="off">
                    </div>

                    <input type="submit" value="Register" class="btn btn-primary btn-block" name="user_register" />

                </form>

                <p class="font-weight-bold p-3 mb-0">Already have an account? <a href="login.php" class="text-danger">Login Instead.</a></p>
            </div>
        </div>
    </div>

</body>



</html>

<?php
$upload_dir = __DIR__ . "/users_images/";

// if user clicks on the register button
if (isset($_POST['user_register'])) {
    $usr_name = $_POST['usr_name'];
    $usr_email = $_POST['usr_email'];
    $usr_password = $_POST['usr_password'];
    $conf_usr_password = $_POST['conf_usr_password'];

    $hashed_password = password_hash($usr_password, PASSWORD_DEFAULT);

    $usr_address = $_POST['usr_address'];
    $usr_contact = $_POST['usr_contact'];

    $usr_image = $_FILES['usr_image']['name'];
    $usr_image_tmp = $_FILES['usr_image']['tmp_name'];
    $usr_ip = $_SERVER['REMOTE_ADDR'];

    // if email or user name already exist BEFORE registration and alert the user
    $check_email = "SELECT * FROM users WHERE usr_email = '$usr_email'";


    $run_email = mysqli_query($con, $check_email);
    $check_username = "SELECT * FROM users WHERE usr_name = '$usr_name'";
    $run_username = mysqli_query($con, $check_username);

    // // debug

    // echo "Temporary File Path: " . $usr_image_tmp . "<br>";
    // echo "Target Path: " . $upload_dir . $usr_image . "<br>";

    // if (file_exists($usr_image_tmp)) {
    //     echo "Temporary file exists.<br>";
    // } else {
    //     echo "Temporary file does not exist.<br>";
    // }

    // if (is_writable($upload_dir)) {
    //     echo "Target directory is writable.<br>";
    // } else {
    //     echo "Target directory is not writable.<br>";
    // }

    // if (move_uploaded_file($usr_image_tmp, $upload_dir . $usr_image)) {
    //     echo "File moved successfully!";
    // } else {
    //     echo "Failed to move the file.";
    // }


    // //// end debug


    if (mysqli_num_rows($run_email) > 0) {
        echo "<script>alert('Email already exists. Please try another email.')</script>";
    } elseif (mysqli_num_rows($run_username) > 0) {
        echo "<script>alert('Username already exists. Please try another username.')</script>";
    } elseif ($usr_password !== $conf_usr_password) {
        echo "<script>alert('Password does not match. Please try again.')</script>";
    } else {

        // if email or user name does not exist, then insert the data into the database
        $insert_user = "INSERT INTO users (usr_name, usr_email, usr_password, usr_img, usr_address, usr_contact, usr_ip) VALUES ('$usr_name', '$usr_email', '$hashed_password', '$usr_image', '$usr_address', '$usr_contact', '$usr_ip')";

        $run_user = mysqli_query($con, $insert_user);
        if ($run_user) {
            move_uploaded_file($usr_image_tmp, $upload_dir . $usr_image);
            echo "<script>alert('Registration Successful.')</script>";
        } else {
            echo "<script>alert('Registration Failed. Please try again.')</script>";
        }

        // check if that user already selected items in the cart using ip address
        $ip = $_SERVER['REMOTE_ADDR'];  // get the ip address of the user
        $check_cart = "SELECT * FROM cart WHERE ip_address = '$ip'";
        $run_check_cart = mysqli_query($con, $check_cart);
        if (mysqli_num_rows($run_check_cart) > 0) {
            $_SESSION['usr_email'] = $usr_email;
            $_SESSION['usr_name'] = $usr_name;
            echo "<script>alert('you have items in your cart')</script>";
            echo "<script>window.open('checkout.php', '_self')</script>";
        } else {
            echo "<script>window.open('index.php', '_self')</script>";
        }
    }
}
