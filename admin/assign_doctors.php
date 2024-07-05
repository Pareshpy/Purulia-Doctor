<?php
session_start();
include("./includes/config.php");
if (!isset($_SESSION['username'])) {
    header("location: ./");
}
include(header);
$c_id = $_GET['id'];
$get_c = "SELECT * FROM `clinics` WHERE `id` = '$c_id'";
$run_c = $conn->query($get_c);
$data_c = $run_c->fetch_object();

$get_docs = "SELECT * FROM `doctors`";
$run_docs = $conn->query($get_docs);

$assigned = "SELECT * FROM `doctor_clinic` WHERE `clinic_id` = '$c_id'";
$find_assigned = $conn->query($assigned);

// $find_assigned1 = $conn->query($assigned);
if ($find_assigned->num_rows > 0) {
    $data_ = $find_assigned->fetch_object();
    $docs_ = explode(',', $data_->doc_id);
    $docs_ = array_filter($docs_);
}

?>
<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Assign Doctors - <?= $data_c->clinic_name ?></h4>
            </div>
            <a href="./clinics.php" class="btn btn-primary btn-icon-text mb-2 mb-md-0 float-right"><i data-feather="arrow-left"></i> Back</a>
        </div>
        <div class="row">
            <div class="col-12 col-xl-12 stretch-card">
                <div class="row flex-grow">

                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form class="forms-sample" method="post">
                                    <div class="form-group" data-select2-id="7">
                                        <label>Doctors <span style="color:crimson">*</span></label>

                                        <select class="js-example-basic-multiple" name="doctors[]" multiple="multiple" required>
                                            <?php
                                            while ($data_docs = $run_docs->fetch_object()) {
                                            ?>
                                                <option value="<?= $data_docs->id ?>"><?= $data_docs->full_name ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2 float-right" name="add_cat"><i data-feather="folder-plus"></i> Assign</button>
                                </form>
                                <?php
                                if (isset($_POST['add_cat'])) {
                                    if ($find_assigned->num_rows > 0 && $data_->clinic_id == $c_id) {
                                        if (!array_intersect($docs_, $_POST['doctors'])) {
                                            $doc_id = $_POST['doctors'];
                                            $merge = array_merge($doc_id, array($data_->doc_id));
                                            $merge = array_filter($merge);
                                            $doc_id = implode(',', $merge);
                                            // print_r($doc_id);
                                            $stmt1 = "UPDATE `doctor_clinic` SET `doc_id` = '$doc_id'";
                                            $run1 = $conn->query($stmt1);
                                            if ($run1) {
                                                // echo "<script>location.href='./assign_doctors.php?id='" . $c_id . "</script>";
                                                echo "<script>location.reload()</script>";
                                            }
                                        }
                                    } else {
                                        $doc_id = $_POST['doctors'];
                                        $doc_id = implode(',', $doc_id);
                                        $stmt = "INSERT INTO `doctor_clinic` (`doc_id`,`clinic_id`,`status`) VALUES ('$doc_id','$c_id', '1')";
                                        $run = $conn->query($stmt);
                                        if ($run) {
                                            echo "<script>location.reload()</script>";

                                            // echo "<script>location.href='./assign_doctors.php?id='" . $c_id . "</script>";
                                            // header("location: ./assign_doctor.php?id=" . $c_id);
                                        }
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row -->
        <?php
        $assign = "SELECT * FROM `doctor_clinic` WHERE `clinic_id` = '$c_id'";
        $find_assign = $conn->query($assign);
        if ($find_assign->num_rows > 0 && !empty($data_->doc_id)) {
            $data_assigned = $find_assign->fetch_object();
            $doctors = explode(',', $data_assigned->doc_id);
            $doctors = array_filter($doctors);
            // print_r($doctors);
            $count_docs = count($doctors);
        ?>
            <div class="row">
                <div class="col-12 col-xl-12 stretch-card">
                    <div class="row flex-grow">

                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="dataTableExample" class="table">
                                            <thead>
                                                <tr>
                                                    <th>S. no.</th>
                                                    <th>Name</th>
                                                    <th class="d-flex justify-content-center align-items-center">Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;

                                                for ($j = 0; $j < $count_docs; $j++) {
                                                    $bb = "SELECT * FROM `doctors` WHERE `id` = '$doctors[$j]'";
                                                    $run_bb = $conn->query($bb);
                                                    $res_bb = $run_bb->fetch_object();

                                                ?>

                                                    <tr>
                                                        <td><?= $i ?></td>
                                                        <td><?= $res_bb->full_name ?></td>
                                                        <td class="d-flex justify-content-center align-items-center">
                                                            <a href="./set_time.php?id=<?= $res_bb->id . '&c=' . $c_id ?>" class="btn btn-success btn-icon-text mb-2 mb-md-0" style="margin:0 5px 0 5px;"><i data-feather="clock"></i> Timing</a>
                                                            <a href="./rem_assign.php?id=<?= $res_bb->id . '&c=' . $c_id ?>" class="btn btn-danger btn-icon-text mb-2 mb-md-0" style="margin:0 5px 0 5px;"><i data-feather="minus-circle"></i></a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $i++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <script>
        document.title = "Assign Doctors - Purulia Doctors Admin"
    </script>
    <?php include(footer); ?>