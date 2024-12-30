<?php

$con = mysqli_connect('localhost', 'root', '', 'MyStore');
if (!$con) {
    echo "Connection Faild";
    // die(mysqli_info($con));
}
