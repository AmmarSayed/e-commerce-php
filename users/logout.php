<?php
session_start();
session_unset();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

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

    <title>Lougout</title>
</head>

<div class="container h-100 d-flex justify-content-center align-items-center mt-5">
    <div class="text-center">
        <h1>Goodbye!</h1>
        <p class="my-5">You have been logged out successfully.</p>
        <a href="../index.php" class="btn btn-primary">Go to Home Page</a>
        <p class="mt-5">You will be redirected to the home page in <span id="countdown">10</span> seconds.</p>
    </div>
</div>

<script>
    // Countdown timer
    var countdownElement = document.getElementById('countdown');
    var countdown = 10;
    setInterval(function() {
        if (countdown > 0) {
            countdown--;
            countdownElement.textContent = countdown;
        } else {
            window.location.href = '../index.php';
        }
    }, 1000);
</script>
</body>

</html>