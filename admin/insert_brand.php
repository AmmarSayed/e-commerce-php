<?php
include("../includes/connect.php");

// check if form submit button is clicked
if (isset($_POST['insert_brand'])) {
    $br_title = $_POST['br_title'];

    // select data from db to check if already exist disregarding case
    $select_query = "Select * from `brands` where LOWER(br_title) Like LOWER('%$br_title%')";
    $res_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($res_select);

    if ($number > 0) echo "<script>alert('Brand $br_title already exist!')</script>";
    else {
        $insert_query = "insert into `brands` (br_title) values ('$br_title')";
        $res = mysqli_query($con, $insert_query);
        if ($res) {
            echo "<script>alert('Brand $br_title inserted successfully')</script>";
        }
    }
}
?>

<h2 class="text-center mb-3">Insert Brand</h2>
<form class="mb-2" action="" method="post">
    <div class="input-group w-90 mb-3">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input autofocus type="text" class="form-control" placeholder="insert brand" name="br_title">
    </div>
    <div class="input-group w-10 m-auto">

        <input type="submit" value="Insert Brand" name="insert_brand" class="bg-info form-control">
    </div>
</form>