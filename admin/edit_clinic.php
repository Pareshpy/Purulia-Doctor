<?php
session_start();
include("./includes/config.php");
if (!isset($_SESSION['username'])) {
    header("location: ./");
}
include(header);
$bb_id = $_GET['id'];
$bb_stmt = "SELECT * FROM `clinics` WHERE `id` = '$bb_id'";
$run_bb = $conn->query($bb_stmt);
$data_bb = $run_bb->fetch_object();

$zone = explode(',', $data_bb->zones);
$zone = array_filter($zone);
$zone_count = count($zone);
// print_r($zone);
?>
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Edit Clinic</h4>
            </div>
            <a href="./clinics.php" class="btn btn-primary btn-icon-text mb-2 mb-md-0 float-right"><i data-feather="arrow-left"></i> Back</a>
        </div>
        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow">

                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <form method="post" enctype="multipart/form-data">
                                    <div class="row">

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Owner Name <span style="color:crimson">*</span></label>
                                                <input type="text" class="form-control" value="<?= $data_bb->owner_name ?>" name="owner_name" required>
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Owner Email</label>
                                                <input type="text" class="form-control" value="<?= $data_bb->owner_email ?>" name="owner_email">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Owner Phone <span style="color:crimson">*</span></label>
                                                <input type="text" class="form-control" value="<?= $data_bb->owner_phone ?>" name="owner_phone" required>
                                            </div>
                                        </div><!-- Col -->
                                        <!-- <h4 class="mb-3 mb-md-0">Blood Bank Details</h3> -->
                                    </div><!-- Row -->
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Clinic Name <span style="color:crimson">*</span></label>
                                                <input type="text" class="form-control" value="<?= $data_bb->clinic_name ?>" name="name" required>
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Phone no. <span style="color:crimson">*</span></label>
                                                <input type="text" class="form-control" value="<?= $data_bb->clinic_phone ?>" name="phone" required>
                                            </div>
                                        </div><!-- Col -->

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Email</label>
                                                <input type="text" class="form-control" value="<?= $data_bb->clinic_email ?>" name="email">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Address <span style="color:crimson">*</span></label>
                                                <input type="text" class="form-control" value="<?= $data_bb->clinic_address ?>" name="address" required>
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">

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
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Verified <span style="color:crimson">*</span></label>
                                                <!-- <input type="text" class="form-control" placeholder="Enter alternative phone no."> -->
                                                <select name="verified" class="form-control" required>
                                                    <option value="<?= $data_bb->verified ?>"><?= $data_bb->verified == 1 ? "Yes" : "No" ?></option>
                                                    <option value="<?= $data_bb->verified == 1 ? "0" : "1" ?>"><?= $data_bb->verified == 1 ? "No" : "Yes" ?></option>
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
                                                <?php if (!empty($data_bb->photo)) { ?>
                                                    <img src="./includes/clinic_imgs/<?= $data_bb->photo ?>" width="100px">
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
                                                <a href="./includes/clinic_docs/<?= $data_bb->document ?>" target="_blank" class="btn btn-primary"><i data-feather="download-cloud"></i> Download Document</a>

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

                                                <input type="file" name="document" id="document" <?php if (!empty($data_bb->document)) echo "";
                                                                                                    else {
                                                                                                        echo "required";
                                                                                                    } ?>>
                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->
                                    <!-- <input type="submit" class="btn btn-primary submit" value="Add" name="" /> -->
                                    <button type="submit" class="btn btn-primary submit float-right" name="add_bb"><i data-feather="edit"></i> Update</button>

                                </form>

                                <?php
                                if (isset($_POST['add_bb'])) {
                                    $owner_name = $conn->real_escape_string($_POST['owner_name']);
                                    $owner_email = $conn->real_escape_string($_POST['owner_email']);
                                    $owner_phone = $conn->real_escape_string($_POST['owner_phone']);


                                    $name = $conn->real_escape_string($_POST['name']);
                                    $address = $conn->real_escape_string($_POST['address']);
                                    $phone = $conn->real_escape_string($_POST['phone']);
                                    $email = $conn->real_escape_string($_POST['email']);
                                    $verified = $conn->real_escape_string($_POST['verified']);
                                    if (!empty($_POST['zones'])) {
                                        $n_zone = $_POST['zones'];
                                        $n_zone = implode(',', $n_zone);
                                    } else {
                                        $n_zone = '';
                                    }
                                    if (!empty($_FILES['photo']['name'])) {
                                        $logo = $_FILES['photo']['name'];
                                        $logo_tmp = $_FILES['photo']['tmp_name'];
                                        $n_logo = rand() . '-' . $logo;
                                        $logo_folder = './includes/clinic_imgs/';
                                        move_uploaded_file($logo_tmp, $logo_folder . $n_logo);
                                    } else {
                                        $n_logo = $data_bb->photo;
                                    }
                                    if (!empty($_FILES['document']['name'])) {
                                        $document = $_FILES['document']['name'];
                                        $document_tmp = $_FILES['document']['tmp_name'];
                                        $n_doc = rand() . '-' . $document;
                                        $document_folder = './includes/clinic_docs/';
                                        move_uploaded_file($document_tmp, $document_folder . $n_doc);
                                    } else {
                                        $n_doc = $data_bb->document;
                                    }

                                    // print_r($n_logo);
                                    $add = "UPDATE `clinics` SET
                                     `owner_name` = '$owner_name',
                                     `owner_email`='$owner_email',
                                     `owner_phone`='$owner_phone',

                                     `clinic_name` = '$name',
                                    `clinic_phone` = '$phone',
                                    `clinic_email` = '$email'
                                    ,`clinic_address` = '$address',
                                    `verified` = '$verified',
                                    `zones` ='$n_zone',
                                    `photo` = '$n_logo'
                                    ,`document` = '$n_doc'
                                    ,`status` = '1' WHERE `id` = '$bb_id'";


                                    $run_add = $conn->query($add);

                                    if ($run_add) {
                                        echo "<script>location.href='./clinics.php'</script>";
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
        document.title = "Edit Clinic - Purulia Doctors Admin"
    </script>
    <?php include(footer); ?>