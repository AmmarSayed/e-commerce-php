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

        <input type="submit" value="Insert Brand" name="insert_brand" class="btn btn-success form-control">
    </div>
</form>


<?php $query = "SELECT * FROM brands";
$result = mysqli_query($con, $query);
?>

<table class="table table-striped table-hover mt-5">
    <tr>
        <th>Brand ID</th>
        <th>Brand Name</th>
        <th>Actions</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
            <td> <?php echo $row['br_id'] ?></td>
            <td> <?php echo $row['br_title'] ?></td>
            <td>
                <a href="index.php?insert_brand&delete_br_id=<?php echo $row['br_id'] ?>">
                    <button class="btn btn-danger">
                        Delete
                    </button>
                </a>
            </td>
        </tr>

    <?php
    }
    ?>
</table>


<?php


if (isset($_GET['delete_br_id'])) {
    $delete_id = $_GET['delete_br_id'];
    // scipt alert to confirm delete action
    echo "<script>
    if(confirm('Are you sure you want to delete this brand?')){
        window.location.href = 'index.php?insert_brand&confirm_delete_br_id=$delete_id';
    }else{
        window.location.href = 'index.php?insert_brand';
    }
    </script>";
} elseif (isset($_GET['confirm_delete_br_id'])) {
    $delete_id = $_GET['confirm_delete_br_id'];
    $delete_query = "DELETE FROM brands WHERE br_id = $delete_id";
    $res = mysqli_query($con, $delete_query);
    if ($res) {
        echo "<script>alert('Category deleted successfully')</script>";
        echo "<script>window.open('index.php?insert_brand','_self')</script>";
    }
}

$query = "SELECT * FROM brands";
$result = mysqli_query($con, $query);
?>