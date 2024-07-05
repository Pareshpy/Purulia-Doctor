<?php
session_start();
include("./includes/config.php");
if (!isset($_SESSION['username'])) {
    header("location: ./");
}
include(header);
$c_id = $_GET['id'];
$qry = "SELECT * FROM `categories` WHERE `id` = '$c_id'";
$r_qry = $conn->query($qry);
$d_qry = $r_qry->fetch_object();
?>
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Edit Category</h4>
            </div>
            <a href="./categories.php" class="btn btn-primary btn-icon-text mb-2 mb-md-0 float-right"><i data-feather="arrow-left"></i> Back</a>
        </div>
        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow">

                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form class="forms-sample" method="post">
                                    <div class="form-group">
                                        <label for="category">Category Name</label>
                                        <input type="text" class="form-control" id="category" value="<?= $d_qry->name ?>" placeholder="Category" name="category">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2 float-right" name="add_cat"><i data-feather="plus"></i> Update</button>
                                </form>
                                <?php
                                if (isset($_POST['add_cat'])) {
                                    $category = $conn->real_escape_string($_POST['category']);
                                    $stmt = "UPDATE `categories` SET `name` = '$category' WHERE `id` = '$c_id'";
                                    $run = $conn->query($stmt);
                                    if ($run) {
                                        echo "<script>location.href='./categories.php'</script>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row -->
    </div>
    <script>
        document.title = "Edit Category - Purulia Doctors Admin"
    </script>
    <?php include(footer); ?>