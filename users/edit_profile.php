<?php
session_start();
require("../includes/connect.php");
include("../functions/common_function.php");


// Check if user is logged in
if (!isset($_SESSION['usr_id'])) {
    header('Location: login.php');
    exit();
}

// Fetch user data from the database
$user_id = $_SESSION['usr_id'];
$query = "SELECT * FROM users WHERE usr_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Update user data in the database
    if (!empty($password)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $update_query = "UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $con->prepare($update_query);
        $stmt->bind_param('sssi', $name, $email, $password_hash, $user_id);
    } else {
        $update_query = "UPDATE users SET usr_name = ?, usr_email = ? WHERE usr_id = ?";
        $stmt = $con->prepare($update_query);
        $stmt->bind_param('ssi', $name, $email, $user_id);
    }

    if ($stmt->execute()) {
        $_SESSION['success'] = "Profile updated successfully.";
    } else {
        $_SESSION['error'] = "Failed to update profile.";
    }

    header('Location: edit_profile.php');
    exit();
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

    <title>Edit Profile</title>
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
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
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



    <div class="container container-fluid my-5 place-items-center">
        <?php
        if (isset($_SESSION['success'])) {

            echo "<p style='color: green;'>{$_SESSION['success']}</p>";
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo "<p style='color: red;'>{$_SESSION['error']}</p>";
            unset($_SESSION['error']);
        }
        ?>
        <h1 class="text-center">Edit Profile</h1>
        <form action="edit_profile.php" method="post" class="form-horizontal">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">New Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['usr_name']); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">New Email:</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['usr_email']); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password" class="col-sm-2 control-label">New Password: </label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" placeholder=" (leave blank to keep current password)">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-warning">Update Profile</button>
                    <a href="./profile.php"><button type="button" class="btn btn-primary">Cancel</button> </a>
                </div>
            </div>
        </form>

    </div>

</body>

</html>