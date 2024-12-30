<?php


try {
    // Attempt to connect to the database
    $con = mysqli_connect('localhost', 'root', '', 'MyStore'); // Intentionally using an incorrect database name
} catch (mysqli_sql_exception $e) {
    // Log the error and display a custom message
    error_log("Database connection failed: " . $e->getMessage());
    die("Something went wrong. Please try again.");
}

// If successful
return "Connected to the database successfully!";
