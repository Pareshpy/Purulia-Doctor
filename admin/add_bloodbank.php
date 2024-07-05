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
                <h4 class="mb-3 mb-md-0">Add Blood Bank</h4>
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
                                                <input type="text" class="form-control" placeholder="Enter owner name" name="owner_name" required>
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Owner Email <span style="color:crimson">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter owner email" name="owner_email" required>
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
                                                <input type="text" class="form-control" placeholder="Enter blood bank name" name="name" required>
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Phone no. <span style="color:crimson">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter phone no." name="phone" required>
                                            </div>
                                        </div><!-- Col -->

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Alternative No.</label>
                                                <input type="text" class="form-control" placeholder="Enter alternative phone no." name="alt_phone">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Address <span style="color:crimson">*</span></label>
                                                <input type="text" class="form-control" placeholder="Enter address" name="address" required> 
                                            </div>
                                        </div><!-- Col -->
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
                                            <div class="form-group" >
                                                <label class="control-label" for="logo">Logo <span style="color:crimson">*</span></label>
                                                <br>
                                                <input type="file" name="logo" id="logo" required>
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

                                    $name = $conn->real_escape_string($_POST['name']);
                                    $address = $conn->real_escape_string($_POST['address']);
                                    $phone = $conn->real_escape_string($_POST['phone']);
                                    $alt_phone = $conn->real_escape_string($_POST['alt_phone']);
                                    $verified = $conn->real_escape_string($_POST['verified']);

                                    $logo = $_FILES['logo']['name'];
                                    $logo_tmp = $_FILES['logo']['tmp_name'];
                                    $n_logo = rand() . '-' . $logo;

                                    $logo_folder = './includes/bb_imgs/';
                                    $document = $_FILES['document']['name'];
                                    $document_tmp = $_FILES['document']['tmp_name'];
                                    $n_doc = rand() . '-' . $document;

                                    $document_folder = './includes/bb_docs/';

                                    move_uploaded_file($logo_tmp, $logo_folder . $n_logo);
                                    move_uploaded_file($document_tmp, $document_folder . $n_doc);

                                    $add = "INSERT INTO `bloodbanks` (`owner_name`,`owner_email`,`name`,`phone`,`alt_phone`,`address`,`verified`,`cover_img`,`document`,`status`)" .
                                        "VALUES('$owner_name','$owner_email','$name','$phone','$alt_phone','$address' ,'$verified','$n_logo','$n_doc','1')";

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
        document.title = "Add Blood Bank - Purulia Doctors Admin"
    </script>
    <?php include(footer); ?>