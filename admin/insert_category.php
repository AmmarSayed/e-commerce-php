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
        <input type="submit" value="Insert Category" name="insert_cat" class="btn btn-warning form-control">
    </div>
</form>

<?php
$query = "SELECT * FROM categories";
$result = mysqli_query($con, $query);
?>
<table class="table table-striped table-hover mt-5">
    <tr>
        <th>Category ID</th>
        <th>Category Name</th>
        <th>Actions</th>
    </tr>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
            <td> <?php echo $row['cat_id'] ?></td>
            <td> <?php echo $row['cat_title'] ?></td>
            <td>
                <a href="index.php?insert_category&delete_cat_id=<?php echo $row['cat_id'] ?>">
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

if (isset($_GET['delete_cat_id'])) {
    $delete_id = $_GET['delete_cat_id'];
    // scipt alert to confirm delete action
    echo "<script>
    if(confirm('Are you sure you want to delete this category?')){
        window.location.href = 'index.php?insert_category&confirm_delete_cat_id=$delete_id';
    }else{
        window.location.href = 'index.php?insert_category';
    }
    </script>";
} elseif (isset($_GET['confirm_delete_cat_id'])) {
    $delete_id = $_GET['confirm_delete_cat_id'];
    $delete_query = "DELETE FROM categories WHERE cat_id = $delete_id";
    $res = mysqli_query($con, $delete_query);
    if ($res) {
        echo "<script>alert('Category deleted successfully')</script>";
        echo "<script>window.open('index.php?insert_category','_self')</script>";
    }
}
?>