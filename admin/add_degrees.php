<?php
session_start();
include("./includes/config.php");
if (!isset($_SESSION['username'])) {
    header("location: ./");
}
include(header);

?>
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Add Degree</h4>
            </div>
            <a href="./degrees.php" class="btn btn-primary btn-icon-text mb-2 mb-md-0 float-right"><i data-feather="arrow-left"></i> Back</a>
        </div>
        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow">

                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form class="forms-sample" method="post">
                                    <div class="form-group">
                                        <label for="category">Degree Name</label>
                                        <input type="text" class="form-control" id="category" autocomplete="off" placeholder="Degree" name="category">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2 float-right" name="add_cat"><i data-feather="plus"></i> Add</button>
                                </form>
                                <?php
                                if (isset($_POST['add_cat'])) {
                                    $category = $conn->real_escape_string($_POST['category']);
                                    $stmt = "INSERT INTO `degrees` (`name`,`status`) VALUES ('$category', '1')";
                                    $run = $conn->query($stmt);
                                    if ($run) {
                                        echo "<script>location.href='./degrees.php'</script>";
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
        document.title = "Add Degree - Purulia Doctors Admin"
    </script>
    <?php include(footer); ?>