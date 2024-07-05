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
                <h4 class="mb-3 mb-md-0">Add Specialty</h4>
            </div>
            <a href="./specialties.php" class="btn btn-primary btn-icon-text mb-2 mb-md-0 float-right"><i data-feather="arrow-left"></i> Back</a>
        </div>
        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow">

                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form class="forms-sample" method="post">
                                    <div class="form-group">
                                        <label for="specialties">Specialties Name</label>
                                        <input type="text" class="form-control" id="specialties" autocomplete="off" placeholder="Specialty" name="specialty">
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2 float-right" name="add_specialty"><i data-feather="plus"></i> Add</button>
                                </form>
                                <?php
                                if (isset($_POST['add_specialty'])) {
                                    $specialty = $conn->real_escape_string($_POST['specialty']);
                                    $stmt = "INSERT INTO `specialties` (`name`,`status`) VALUES ('$specialty', '1')";
                                    $run = $conn->query($stmt);
                                    if ($run) {
                                        echo "<script>location.href='./specialties.php'</script>";
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
        document.title = "Add Specialty - Purulia Doctors Admin"
    </script>
    <?php include(footer); ?>