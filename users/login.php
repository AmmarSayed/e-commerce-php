<?php
@session_start();
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
        <h2 class="text-center">User Login</h2>

        <div class="row align-items-center justify-content-center">
            <div class="col-md-8 col-xl-6">
                <form action="" method="post">
                    <!-- username -->
                    <div class="form-group mb-3">
                        <label for="usr_name">Username</label>
                        <input type="text" class="form-control" id="usr_name" name="usr_name" placeholder="enter your username" required autocomplete="off">
                    </div>

                    <!-- password -->
                    <div class="form-group mb-3">
                        <label for="usr_password">Password</label>
                        <input type="password" class="form-control" id="usr_password" name="usr_password" placeholder="enter your password" required autocomplete="off">
                    </div>


                    <input type="submit" value="Login" class="btn btn-primary btn-block" name="user_login" />

                </form>

                <p class="font-weight-bold p-3 mb-0">Don't have an account? <a href="register.php" class="text-danger">Register Instead.</a></p>
            </div>
        </div>
    </div>

</body>

</html>

<?php
global $con;
if (isset($_POST['user_login'])) {
    // get current ip address
    $ip_address = $_SERVER['REMOTE_ADDR'];
    $usr_name = $_POST['usr_name'];
    $usr_password = $_POST['usr_password'];

    $query = "SELECT * FROM users WHERE usr_name = '$usr_name'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);


    // echo "<h2>verified: " . password_verify($usr_password, $row['usr_password']) . "</h2>";

    // check if user has items in cart
    $cart_query = "SELECT * FROM cart WHERE ip_address = '$ip_address'";
    $cart_query = mysqli_query($con, $cart_query);
    $cart_items = mysqli_num_rows($cart_query);

    // echo "<h2>cart items: " . $cart_items . "</h2>";

    if ($row) {
        $_SESSION['usr_name'] = $row['usr_name'];
        $_SESSION['usr_id'] = $row['usr_id'];

        // verify password
        if (password_verify($usr_password, $row['usr_password'])) {

            // if user has items in cart
            if ($cart_items > 0) {
                echo "<script>alert('login successful!')</script>";
                echo "<script>window.open('./checkout.php', '_self')</script>";
            } else {
                echo "<script>alert('login successful!')</script>";
                echo "<script>window.open('profile.php', '_self')</script>";
            }
        } else {
            echo "<script>alert('Invalid Password')</script>";
        }
    } else {
        echo "<script>alert('Invalid Username ')</script>";
    }
}

?>