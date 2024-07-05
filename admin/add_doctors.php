<?php
session_start();
include("./includes/config.php");
if (!isset($_SESSION['username'])) {
    header("location: ./");
}
include(header);

$get_dg = "SELECT * FROM `degrees`";
$run_dg = $conn->query($get_dg);
$get_spec = "SELECT * FROM `specialties`";
$run_spec = $conn->query($get_spec);
$get_cat = "SELECT * FROM `categories`";
$run_cat = $conn->query($get_cat);
?>
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Add Doctor</h4>
            </div>
            <a href="./doctors.php" class="btn btn-primary btn-icon-text mb-2 mb-md-0 float-right"><i data-feather="arrow-left"></i> Back</a>
        </div>
        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow">

                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Full Name <span style="color:crimson">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter full name" name="full_name" required>
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Short Name</label>
                                                <input type="text" class="form-control" placeholder="Enter short name" name="short_name">
                                            </div>
                                        </div><!-- Col -->
                                        <!-- <h4 class="mb-3 mb-md-0">Blood Bank Details</h3> -->
                                    </div><!-- Row -->

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Registration No.</label>
                                                <input type="text" class="form-control" placeholder="Enter registration no." name="reg_no">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Email ID</label>
                                                <input type="text" class="form-control" placeholder="Enter email" name="email">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Phone no.</label>
                                                <input type="text" class="form-control" placeholder="Enter phone no." name="phone">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-4">

                                            <div class="form-group" data-select2-id="7">
                                                <label>Degrees <span style="color:crimson">*</span></label>

                                                <select class="js-example-basic-multiple" name="degrees[]" multiple="multiple" required>
                                                    <?php
                                                    while ($res_dg = $run_dg->fetch_object()) {
                                                    ?>
                                                        <option value="<?= $res_dg->id ?>"><?= $res_dg->name ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">

                                            <div class="form-group" data-select2-id="7">
                                                <label>Category <span style="color:crimson">*</span></label>

                                                <select class="js-example-basic-multiple" name="category" required>
                                                    <?php
                                                    while ($res_cat = $run_cat->fetch_object()) {
                                                    ?>
                                                        <option value="<?= $res_cat->name ?>"><?= $res_cat->name ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-sm-4">

                                            <div class="form-group" data-select2-id="7">
                                                <label>Specialties <span style="color:crimson">*</span></label>

                                                <select class="js-example-basic-multiple" name="specialties[]" multiple="multiple" required>
                                                    <?php
                                                    while ($res_spec = $run_spec->fetch_object()) {
                                                    ?>
                                                        <option value="<?= $res_spec->id ?>"><?= $res_spec->name ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Experience</label>
                                                <input type="text" class="form-control" placeholder="Enter experience" name="exp">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Address</label>
                                                <input type="text" class="form-control" placeholder="Enter address" name="address">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Verified <span style="color:crimson">*</span></label>
                                                <!-- <input type="text" class="form-control" placeholder="Enter alternative phone no."> -->
                                                <select name="verified" class="form-control" required>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">

                                            <div class="form-group" data-select2-id="7">
                                                <label>Zones <span style="color:crimson">*</span></label>

                                                <select class="js-example-basic-multiple" name="zones[]" multiple="multiple" required>
                                                    <?php
                                                    $get_zone = "SELECT * FROM `zones`";
                                                    $run_zone = $conn->query($get_zone);
                                                    while ($res_zone = $run_zone->fetch_object()) {
                                                    ?>
                                                        <option value="<?= $res_zone->id ?>"><?= $res_zone->name ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="logo">Photo</label>
                                                <br>
                                                <input type="file" name="photo" id="logo">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="document">Document <span style="color:crimson">*</span></label>
                                                <br>
                                                <input type="file" name="document" id="document" required>
                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->
                                    <!-- <input type="submit" class="btn btn-primary submit" value="Add" name="" /> -->
                                    <button type="submit" class="btn btn-primary submit float-right" name="add_doc"><i data-feather="plus"></i> Add</button>

                                </form>

                                <?php
                                if (isset($_POST['add_doc'])) {
                                    $full_name = $conn->real_escape_string($_POST['full_name']);
                                    $short_name = $conn->real_escape_string($_POST['short_name']);

                                    $reg_no = $conn->real_escape_string($_POST['reg_no']);
                                    $email = $conn->real_escape_string($_POST['email']);
                                    $phone = $conn->real_escape_string($_POST['phone']);
                                    $exp = $conn->real_escape_string($_POST['exp']);
                                    $address = $conn->real_escape_string($_POST['address']);
                                    $zones = $_POST['zones'];
                                    $zones = implode(',', $zones);
                                    // $alt_phone = $conn->real_escape_string($_POST['alt_phone']);
                                    $verified = $conn->real_escape_string($_POST['verified']);
                                    $degrees = $_POST['degrees'];
                                    $degrees = implode(',', $degrees);
                                    $specialties = $_POST['specialties'];
                                    $specialties = implode(',', $specialties);
                                    $category = $conn->real_escape_string($_POST['category']);

                                    if (!empty($_FILES['photo']['name'])) {
                                        $photo = $_FILES['photo']['name'];
                                        $photo_tmp = $_FILES['photo']['tmp_name'];
                                        $n_photo = rand() . '-' . $photo;
                                        $photo_folder = './includes/doc_imgs/';
                                        move_uploaded_file($photo_tmp, $photo_folder . $n_photo);
                                    } else {
                                        $n_photo = '';
                                    }
                                    $document = $_FILES['document']['name'];
                                    $document_tmp = $_FILES['document']['tmp_name'];
                                    $n_doc = rand() . '-' . $document;
                                    $document_folder = './includes/doc_docs/';
                                    move_uploaded_file($document_tmp, $document_folder . $n_doc);

                                    $add = "INSERT INTO `doctors` (`full_name`,`short_name`,`reg_no`,`email`,`phone`,
                                    `degrees`,`category`,`specialty`,`exp`,`address`,`verified`,`zones`,`status`,`photo`,`document`)" .
                                        "VALUES('$full_name','$short_name','$reg_no','$email','$phone','$degrees' ,
                                        '$category','$specialties','$exp','$address','$verified','$zones','1','$n_photo','$n_doc')";

                                    $run_add = $conn->query($add);

                                    if ($run_add) {
                                        echo "<script>location.href='./doctors.php'</script>";
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
        document.title = "Add Doctors - Purulia Doctors Admin"
    </script>
    <?php include(footer); ?>