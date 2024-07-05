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
                <h4 class="mb-3 mb-md-0">Add Clinic</h4>
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
                                                <input type="text" class="form-control" placeholder="Enter owner name" name="owner_name" required>
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Owner Email </label>
                                                <input type="text" class="form-control" placeholder="Enter owner email" name="owner_email">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Owner Phone <span style="color:crimson">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter owner phone" name="owner_phone" required>
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
                                                <input type="text" class="form-control" placeholder="Enter clinic name" name="name" required>
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Phone no. <span style="color:crimson">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter phone no." name="phone" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Email</label>
                                                <input type="text" class="form-control" placeholder="Enter email" name="email">
                                            </div>
                                        </div><!-- Col -->

                                        <!-- <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Alternative No.</label>
                                                <input type="text" class="form-control" placeholder="Enter alternative phone no." name="alt_phone">
                                            </div>
                                        </div> -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Address <span style="color:crimson">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter address" name="address" required>
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">

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
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Verified <span style="color:crimson">*</span></label>
                                                <!-- <input type="text" class="form-control" placeholder="Enter alternative phone no."> -->
                                                <select name="verified" class="form-control" required>
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
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
                                    <button type="submit" class="btn btn-primary submit float-right" name="add_bb"><i data-feather="plus"></i> Add</button>

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
                                    $zones = $_POST['zones'];
                                    $zones = implode(',', $zones);
                                    // $alt_phone = $conn->real_escape_string($_POST['alt_phone']);
                                    $verified = $conn->real_escape_string($_POST['verified']);
                                    if (!empty($_FILES['photo']['name'])) {
                                        $logo = $_FILES['photo']['name'];
                                        $logo_tmp = $_FILES['photo']['tmp_name'];
                                        $n_logo = rand() . '-' . $logo;
                                        move_uploaded_file($logo_tmp, $logo_folder . $n_logo);
                                    } else {
                                        $n_logo = '';
                                    }

                                    $logo_folder = './includes/clinic_imgs/';
                                    $document = $_FILES['document']['name'];
                                    $document_tmp = $_FILES['document']['tmp_name'];
                                    $n_doc = rand() . '-' . $document;
                                    $document_folder = './includes/clinic_docs/';
                                    move_uploaded_file($document_tmp, $document_folder . $n_doc);

                                    $add = "INSERT INTO `clinics` 
                                    (`owner_name`,`owner_email`,`owner_phone`,`clinic_name`,`clinic_phone`,`clinic_email`,`clinic_address`,
                                    `verified`,`zones`,`status`,`photo`,`document`)" .
                                        "VALUES('$owner_name','$owner_email','$owner_phone','$name',
                                        '$phone','$email' ,'$address','$verified','$zones','1','$n_logo','$n_doc')";

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
        document.title = "Add Clinic - Purulia Doctors Admin"
    </script>
    <?php include(footer); ?>