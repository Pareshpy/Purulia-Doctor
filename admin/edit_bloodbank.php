<?php
session_start();
include("./includes/config.php");
if (!isset($_SESSION['username'])) {
    header("location: ./");
}
include(header);
$bb_id = $_GET['id'];
$bb_stmt = "SELECT * FROM `bloodbanks` WHERE `id` = '$bb_id'";
$run_bb = $conn->query($bb_stmt);
$data_bb = $run_bb->fetch_object();
?>
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Edit Blood Bank</h4>
            </div>
            <a href="./bloodbanks.php" class="btn btn-primary btn-icon-text mb-2 mb-md-0 float-right"><i data-feather="arrow-left"></i> Back</a>
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
                                                <label class="control-label">Owner Name <span style="color:crimson">*</span></label>
                                                <input type="text" class="form-control" value="<?= $data_bb->owner_name ?>" name="owner_name" required>
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Owner Email <span style="color:crimson">*</span></label>
                                                <input type="text" class="form-control" value="<?= $data_bb->owner_email ?>" name="owner_email" required>
                                            </div>
                                        </div><!-- Col -->
                                        <!-- <h4 class="mb-3 mb-md-0">Blood Bank Details</h3> -->
                                    </div><!-- Row -->
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Blood Bank Name <span style="color:crimson">*</span></label>
                                                <input type="text" class="form-control" value="<?= $data_bb->name ?>" name="name" required>
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Phone no. <span style="color:crimson">*</span></label>
                                                <input type="text" class="form-control" value="<?= $data_bb->phone ?>" name="phone" required>
                                            </div>
                                        </div><!-- Col -->

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Alternative No.</label>
                                                <input type="text" class="form-control" value="<?= $data_bb->alt_phone ?>" name="alt_phone">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Address <span style="color:crimson">*</span></label>
                                                <input type="text" class="form-control" value="<?= $data_bb->address ?>" name="address" required>
                                            </div>
                                        </div><!-- Col -->
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
                                                <label class="control-label" for="logo">Logo <span style="color:crimson">*</span></label>
                                                <br>
                                                <img src="./includes/bb_imgs/<?= $data_bb->cover_img ?>" width="100px">

                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="document">Document <span style="color:crimson">*</span></label>
                                                <br>
                                                <br>
                                                <a href="./includes/bb_docs/<?= $data_bb->document ?>" target="_blank" class="btn btn-primary"><i data-feather="download-cloud"></i> Download Document</a>

                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="logo">Logo</label>
                                                <br>

                                                <input type="file" name="logo" id="logo" <?= !empty($data_bb->cover_img) ? "" : "required"; ?> />
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label" for="document">Document</label>
                                                <br>

                                                <input type="file" name="document" id="document" <?= !empty($data_bb->document) ? "" : "required"; ?>>
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

                                    $name = $conn->real_escape_string($_POST['name']);
                                    $address = $conn->real_escape_string($_POST['address']);
                                    $phone = $conn->real_escape_string($_POST['phone']);
                                    $alt_phone = $conn->real_escape_string($_POST['alt_phone']);
                                    $verified = $conn->real_escape_string($_POST['verified']);

                                    if (!empty($_FILES['logo']['name'])) {
                                        $logo = $_FILES['logo']['name'];
                                        $logo_tmp = $_FILES['logo']['tmp_name'];
                                        $n_logo = rand() . '-' . $logo;
                                        $logo_folder = './includes/bb_imgs/';
                                        move_uploaded_file($logo_tmp, $logo_folder . $n_logo);
                                    } else {
                                        $n_logo = $data_bb->cover_img;
                                    }
                                    if (!empty($_FILES['document']['name'])) {
                                        $document = $_FILES['document']['name'];
                                        $document_tmp = $_FILES['document']['tmp_name'];
                                        $n_doc = rand() . '-' . $document;
                                        $document_folder = './includes/bb_docs/';
                                        move_uploaded_file($document_tmp, $document_folder . $n_doc);
                                    } else {
                                        $n_doc = $data_bb->document;
                                    }

                                    // print_r($n_logo);
                                    $add = "UPDATE `bloodbanks` SET
                                     `owner_name` = '$owner_name',
                                     `owner_email`='$owner_email',
                                     `name` = '$name',
                                    `phone` = '$phone',
                                    `alt_phone` = '$alt_phone'
                                    ,`address` = '$address'
                                    ,`verified` = '$verified'
                                    ,`cover_img` = '$n_logo'
                                    ,`document` = '$n_doc'
                                    ,`status` = '1' WHERE `id` = '$bb_id'";


                                    $run_add = $conn->query($add);

                                    if ($run_add) {
                                        echo "<script>location.href='./bloodbanks.php'</script>";
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
        document.title = "Edit Blood Bank - Purulia Doctors Admin"
    </script>
    <?php include(footer); ?>