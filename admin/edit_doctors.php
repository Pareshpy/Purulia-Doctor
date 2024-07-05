<?php
session_start();
include("./includes/config.php");
if (!isset($_SESSION['username'])) {
    header("location: ./");
}
include(header);
$d_id = $_GET['id'];
$get_d = "SELECT * FROM `doctors` WHERE `id` = '$d_id'";
$run_d = $conn->query($get_d);
$res_d = $run_d->fetch_object();
$degs = explode(',', $res_d->degrees);
$count_degs = count($degs);

$specs = explode(',', $res_d->specialty);
$count_specs = count($specs);


$cat = $res_d->category;
$get_cat = "SELECT * FROM `categories` WHERE `name` ='$cat'";
$run_cat = $conn->query($get_cat);

$zone = explode(',', $res_d->zones);
$zone = array_filter($zone);
$zone_count = count($zone);
?>
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Edit Doctor</h4>
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
                                                <input type="text" class="form-control" value="<?= $res_d->full_name ?>" name="full_name" required>
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Short Name</label>
                                                <input type="text" class="form-control" value="<?= $res_d->short_name ?>" name="short_name">
                                            </div>
                                        </div><!-- Col -->
                                        <!-- <h4 class="mb-3 mb-md-0">Blood Bank Details</h3> -->
                                    </div><!-- Row -->

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Registration No.</label>
                                                <input type="text" class="form-control" value="<?= $res_d->reg_no ?>" name="reg_no">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Email ID</label>
                                                <input type="text" class="form-control" value="<?= $res_d->email ?>" name="email">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Phone no.</label>
                                                <input type="text" class="form-control" value="<?= $res_d->phone ?>" name="phone">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-4">

                                            <div class="form-group" data-select2-id="7">
                                                <label>Degrees</label>

                                                <select class="js-example-basic-multiple" name="degrees[]" multiple="multiple" disabled>
                                                    <?php
                                                    for ($i = 0; $i < $count_degs; $i++) {
                                                        $get_dg = "SELECT * FROM `degrees` WHERE `id` = '$degs[$i]'";
                                                        $run_dg = $conn->query($get_dg);

                                                        $res_dg = $run_dg->fetch_object();
                                                    ?>
                                                        <option value="<?= $res_dg->id ?>" selected><?= $res_dg->name ?></option>
                                                    <?php }
                                                    ?>
                                                </select>

                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">

                                            <div class="form-group" data-select2-id="7">
                                                <label>Category</label>

                                                <select class="js-example-basic-multiple" name="category" disabled>
                                                    <?php
                                                    $res_cat = $run_cat->fetch_object();
                                                    ?>
                                                    <option value="<?= $res_cat->name ?>"><?= $res_cat->name ?></option>

                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-sm-4">

                                            <div class="form-group" data-select2-id="7">
                                                <label>Specialties</label>

                                                <select class="js-example-basic-multiple" name="specialties[]" multiple="multiple" disabled>
                                                    <?php
                                                    for ($j = 0; $j < $count_specs; $j++) {
                                                        $get_spec = "SELECT * FROM `specialties` WHERE `id` = '$specs[$j]'";
                                                        $run_spec = $conn->query($get_spec);
                                                        $res_spec = $run_spec->fetch_object();
                                                    ?>
                                                        <option value="<?= $res_spec->id ?>" selected><?= $res_spec->name ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Experience</label>
                                                <input type="text" class="form-control" value="<?= $res_d->exp ?>" name="exp">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Address</label>
                                                <input type="text" class="form-control" value="<?= $res_d->address ?>" name="address">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Verified <span style="color:crimson">*</span></label>
                                                <!-- <input type="text" class="form-control" placeholder="Enter alternative phone no."> -->
                                                <select name="verified" class="form-control" required>
                                                    <option value="<?= $res_d->verified ?>"><?= $res_d->verified == 1 ? "Yes" : "No" ?></option>
                                                    <option value="<?= $res_d->verified == 1 ? "0" : "1" ?>"><?= $res_d->verified == 1 ? "No" : "Yes" ?></option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">

                                            <div class="form-group" data-select2-id="7">
                                                <label>Zones</label>

                                                <select class="js-example-basic-multiple" name="zones[]" multiple="multiple">
                                                    <?php
                                                    if (!empty($zone)) {
                                                        for ($j = 0; $j < $zone_count; $j++) {
                                                            $get_zone = "SELECT * FROM `zones` WHERE `id` = '$zone[$j]'";
                                                            $run_zone = $conn->query($get_zone);
                                                            $res_zone = $run_zone->fetch_object();
                                                    ?>
                                                            <option value="<?= $res_zone->id ?>" selected><?= $res_zone->name ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        $get_zone = "SELECT * FROM `zones`";
                                                        $run_zone = $conn->query($get_zone);
                                                        while ($res_zone = $run_zone->fetch_object()) {
                                                        ?>

                                                            <option value="<?= $res_zone->id ?>"><?= $res_zone->name ?></option>
                                                    <?php }
                                                    } ?>
                                                </select>
                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="logo">Photo </label>
                                                <br>
                                                <?php
                                                if (!empty($res_d->photo)) {
                                                ?>
                                                    <img src="./includes/doc_imgs/<?= $res_d->photo ?>" width="100px">
                                                <?php } else {
                                                    echo "<p>No photo found!</p>";
                                                } ?>
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="document">Document</label>
                                                <br>
                                                <br>
                                                <a href="./includes/doc_docs/<?= $res_d->document ?>" target="_blank" class="btn btn-primary"><i data-feather="download-cloud"></i> Download Document</a>

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
                                                <label class="control-label" for="document">Document</label>
                                                <br>
                                                <input type="file" name="document" id="document">
                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->
                                    <!-- <input type="submit" class="btn btn-primary submit" value="Add" name="" /> -->
                                    <button type="submit" class="btn btn-primary submit float-right" name="add_doc"><i data-feather="edit"></i> Update</button>

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
                                    // $alt_phone = $conn->real_escape_string($_POST['alt_phone']);
                                    $verified = $conn->real_escape_string($_POST['verified']);
                                    if (!empty($_POST['zones'])) {
                                        $n_zone = $_POST['zones'];
                                        $n_zone = implode(',', $n_zone);
                                    } else {
                                        $n_zone = '';
                                    }
                                    if (!empty($_FILES['photo']['name'])) {
                                        $photo = $_FILES['photo']['name'];
                                        $photo_tmp = $_FILES['photo']['tmp_name'];
                                        $n_photo = rand() . '-' . $photo;
                                        $photo_folder = './includes/doc_imgs/';
                                        move_uploaded_file($photo_tmp, $photo_folder . $n_photo);
                                    } else {
                                        $n_photo = $res_d->photo;
                                    }
                                    if (!empty($_FILES['document']['name'])) {
                                        $document = $_FILES['document']['name'];
                                        $document_tmp = $_FILES['document']['tmp_name'];
                                        $n_doc = rand() . '-' . $document;
                                        $document_folder = './includes/doc_docs/';
                                        move_uploaded_file($document_tmp, $document_folder . $n_doc);
                                    } else {
                                        $n_doc = $res_d->document;
                                    }

                                    $add = "UPDATE `doctors` SET 
                                    `full_name` = '$full_name',
                                    `short_name` = '$short_name',
                                    `reg_no` = '$reg_no',
                                    `email` = '$email',
                                    `phone` = '$phone',
                                    `exp` = '$exp',
                                    `address` = '$address',
                                    `verified` = '$verified',
                                    `zones`= '$n_zone',
                                    `status` = '1',
                                    `photo` = '$n_photo',
                                    `document` = '$n_doc' WHERE `id` = '$d_id'";

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
        document.title = "Edit Doctors - Purulia Doctors Admin"
    </script>
    <?php include(footer); ?>