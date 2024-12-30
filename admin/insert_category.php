<?php
include("../includes/connect.php");

// check if form submit button is clicked
if (isset($_POST['insert_cat'])) {
    $cat_title = $_POST['cat_title'];

    // select data from db to check if already exist
    $select_query = "Select * from `categories` where LOWER(cat_title) Like LOWER('%$cat_title%')";
    $res_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($res_select);

    if ($number > 0) echo "<script>alert('Category $cat_title already exist!')</script>";
    else {
        $insert_query = "insert into `categories` (cat_title) values ('$cat_title')";
        $res = mysqli_query($con, $insert_query);
        if ($res) {
            echo "<script>alert('Category $cat_title inserted successfully')</script>";
        }
    }
}
?>
<h2 class="text-center mb-3">Insert Category</h2>

<form class="mb-2" action="" method="post">
    <div class="input-group w-90 mb-3">
        <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input autofocus type="text" class="form-control" placeholder="Insert category" name="cat_title">
    </div>
    <div class="input-group w-10 m-auto">
        <input type="submit" value="insert category" name="insert_cat" class="bg-info form-control">
    </div>
</form>