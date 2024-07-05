<?php
session_start();
include("./includes/config.php");
if (!isset($_SESSION['username'])) {
    header("location: ./");
}
include(header);
$d_id = $_GET['id'];
$c_id = $_GET['c'];
$doc = "SELECT * FROM `doctors` WHERE `id` = '$d_id'";
$r_doc = $conn->query($doc);
$d_doc = $r_doc->fetch_object();
$clinic = "SELECT * FROM `clinics` WHERE `id` = '$c_id'";
$r_clinic = $conn->query($clinic);
$d_clinic = $r_clinic->fetch_object();
$tql1 = "SELECT * FROM `doc_times` WHERE `doc_id` = '$d_id' AND `c_id` = '$c_id'";
$rtql1 = $conn->query($tql1);
$d_tql1 = $rtql1->fetch_object();

?>

<div class="page-wrapper">
    <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
            <div>
                <h4 class="mb-3 mb-md-0">Set Timing</h4>
            </div>
            <a href="./assign_doctors.php?id=<?= $c_id ?>" class="btn btn-primary btn-icon-text mb-2 mb-md-0 float-right"><i data-feather="arrow-left"></i> Back</a>
        </div>
        <form action="" method="post">
            <div class="row">
                <div class="col-12 col-xl-12 stretch-card">
                    <div class="row flex-grow">

                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4><?= $d_doc->full_name ?> - <?= $d_clinic->clinic_name ?></h4>
                                    <div class="form-group">
                                        <div class="row">

                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" id="dailyIn" name="t_type" value="Daily" <?php if (!empty($d_tql1) && $d_tql1->t_type == 'Daily') echo 'checked';
                                                                                                                                                    else echo '' ?>>
                                                        Daily
                                                        <i class="input-frame"></i></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="daily" style="display:<?php if (!empty($d_tql1) && $d_tql1->t_type == 'Daily') echo '';
                                                                                    else echo 'none' ?>">

                                            <div class="col-md-3">
                                                <p>Morning Starting</p>

                                                <div class="input-group date timepicker" id="datetimepickerExample" data-target-input="nearest">
                                                    <input type="text" name="d1" class="form-control datetimepicker-input" data-target="#datetimepickerExample" value="<?php if (!empty($d_tql1)) echo $d_tql1->d_ms ?>">
                                                    <div class="input-group-append" data-target="#datetimepickerExample" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Morning Ending</p>

                                                <div class="input-group date timepicker" id="datetimepicker2" data-target-input="nearest">
                                                    <input type="text" name="d2" class="form-control datetimepicker-input" data-target="#datetimepicker2" value="<?php if (!empty($d_tql1)) echo $d_tql1->d_me ?>">
                                                    <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <p>Evening Starting</p>

                                                <div class="input-group date timepicker" id="datetimepicker3" data-target-input="nearest">
                                                    <input type="text" name="d3" class="form-control datetimepicker-input" data-target="#datetimepicker3" value="<?php if (!empty($d_tql1)) echo $d_tql1->d_es ?>">
                                                    <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Evening Ending</p>

                                                <div class="input-group date timepicker" id="datetimepicker4" data-target-input="nearest">
                                                    <input type="text" name="d4" class="form-control datetimepicker-input" data-target="#datetimepicker4" value="<?php if (!empty($d_tql1)) echo $d_tql1->d_ee ?>">
                                                    <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" id="selectedD" name="t_type" value="Selected Days">
                                                Selected Days
                                                <i class="input-frame"></i></label>
                                        </div>
                                        <div class="form-check " id="days" style="display:none">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" id="monday">
                                                Monday
                                                <i class="input-frame"></i></label>
                                        </div>
                                        <div class="row" id="monday1" style="display:none">

                                            <div class="col-md-3">
                                                <p>Morning Starting</p>

                                                <div class="input-group date timepicker" id="datetimepickerM1" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerM1">
                                                    <div class="input-group-append" data-target="#datetimepickerM1" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Morning Ending</p>

                                                <div class="input-group date timepicker" id="datetimepickerM2" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerM2">
                                                    <div class="input-group-append" data-target="#datetimepickerM2" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <p>Evening Starting</p>

                                                <div class="input-group date timepicker" id="datetimepickerM3" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerM3">
                                                    <div class="input-group-append" data-target="#datetimepickerM3" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Evening Ending</p>

                                                <div class="input-group date timepicker" id="datetimepickerM4" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerM4">
                                                    <div class="input-group-append" data-target="#datetimepickerM4" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check " id="days1" style="display:none">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" id="tuesday">
                                                Tuesday
                                                <i class="input-frame"></i></label>
                                        </div>
                                        <div class="row" id="tuesday1" style="display:none">

                                            <div class="col-md-3">
                                                <p>Morning Starting</p>

                                                <div class="input-group date timepicker" id="datetimepickerT1" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerT1">
                                                    <div class="input-group-append" data-target="#datetimepickerT1" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Morning Ending</p>

                                                <div class="input-group date timepicker" id="datetimepickerT2" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerT2">
                                                    <div class="input-group-append" data-target="#datetimepickerT2" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <p>Evening Starting</p>

                                                <div class="input-group date timepicker" id="datetimepickerT3" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerT3">
                                                    <div class="input-group-append" data-target="#datetimepickerT3" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Evening Ending</p>

                                                <div class="input-group date timepicker" id="datetimepickerT4" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerT4">
                                                    <div class="input-group-append" data-target="#datetimepickerT4" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check " id="days2" style="display:none">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input " id="wednesday">
                                                Wednesday
                                                <i class="input-frame"></i></label>
                                        </div>
                                        <div class="row" id="wednesday1" style="display:none">

                                            <div class="col-md-3">
                                                <p>Morning Starting</p>

                                                <div class="input-group date timepicker" id="datetimepickerW1" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerW1">
                                                    <div class="input-group-append" data-target="#datetimepickerW1" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Morning Ending</p>

                                                <div class="input-group date timepicker" id="datetimepickerW2" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerW2">
                                                    <div class="input-group-append" data-target="#datetimepickerW2" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <p>Evening Starting</p>

                                                <div class="input-group date timepicker" id="datetimepickerW3" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerW3">
                                                    <div class="input-group-append" data-target="#datetimepickerW3" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Evening Ending</p>

                                                <div class="input-group date timepicker" id="datetimepickerW4" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerW4">
                                                    <div class="input-group-append" data-target="#datetimepickerW4" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check " id="days3" style="display:none">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input " id="thursday">
                                                Thursday
                                                <i class="input-frame"></i></label>
                                        </div>
                                        <div class="row" id="thursday1" style="display:none">

                                            <div class="col-md-3">
                                                <p>Morning Starting</p>

                                                <div class="input-group date timepicker" id="datetimepickerTT1" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerTT1">
                                                    <div class="input-group-append" data-target="#datetimepickerTT1" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Morning Ending</p>

                                                <div class="input-group date timepicker" id="datetimepickerTT2" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerTT2">
                                                    <div class="input-group-append" data-target="#datetimepickerTT2" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <p>Evening Starting</p>

                                                <div class="input-group date timepicker" id="datetimepickerTT3" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerTT3">
                                                    <div class="input-group-append" data-target="#datetimepickerTT3" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Evening Ending</p>

                                                <div class="input-group date timepicker" id="datetimepickerTT4" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerTT4">
                                                    <div class="input-group-append" data-target="#datetimepickerTT4" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check " id="days4" style="display:none">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input " id="friday">
                                                Friday
                                                <i class="input-frame"></i></label>
                                        </div>
                                        <div class="row" id="friday1" style="display:none">

                                            <div class="col-md-3">
                                                <p>Morning Starting</p>

                                                <div class="input-group date timepicker" id="datetimepickerF1" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerF1">
                                                    <div class="input-group-append" data-target="#datetimepickerF1" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Morning Ending</p>

                                                <div class="input-group date timepicker" id="datetimepickerF2" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerF2">
                                                    <div class="input-group-append" data-target="#datetimepickerF2" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <p>Evening Starting</p>

                                                <div class="input-group date timepicker" id="datetimepickerF3" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerF3">
                                                    <div class="input-group-append" data-target="#datetimepickerF3" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Evening Ending</p>

                                                <div class="input-group date timepicker" id="datetimepickerF4" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerF4">
                                                    <div class="input-group-append" data-target="#datetimepickerF4" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check " id="days5" style="display:none">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input " id="saturday">
                                                Saturday
                                                <i class="input-frame"></i></label>
                                        </div>
                                        <div class="row" id="saturday1" style="display:none">

                                            <div class="col-md-3">
                                                <p>Morning Starting</p>

                                                <div class="input-group date timepicker" id="datetimepickerS1" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerS1">
                                                    <div class="input-group-append" data-target="#datetimepickerS1" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Morning Ending</p>

                                                <div class="input-group date timepicker" id="datetimepickerS2" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerS2">
                                                    <div class="input-group-append" data-target="#datetimepickerS2" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <p>Evening Starting</p>

                                                <div class="input-group date timepicker" id="datetimepickerS3" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerS3">
                                                    <div class="input-group-append" data-target="#datetimepickerS3" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Evening Ending</p>

                                                <div class="input-group date timepicker" id="datetimepickerS4" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerS4">
                                                    <div class="input-group-append" data-target="#datetimepickerS4" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check " id="days6" style="display:none">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input " id="sunday">
                                                Sunday
                                                <i class="input-frame"></i></label>
                                        </div>
                                        <div class="row" id="sunday1" style="display:none">

                                            <div class="col-md-3">
                                                <p>Morning Starting</p>

                                                <div class="input-group date timepicker" id="datetimepickerSS1" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerSS1">
                                                    <div class="input-group-append" data-target="#datetimepickerSS1" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Morning Ending</p>

                                                <div class="input-group date timepicker" id="datetimepickerSS2" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerSS2">
                                                    <div class="input-group-append" data-target="#datetimepickerSS2" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <p>Evening Starting</p>

                                                <div class="input-group date timepicker" id="datetimepickerSS3" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerSS3">
                                                    <div class="input-group-append" data-target="#datetimepickerSS3" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <p>Evening Ending</p>

                                                <div class="input-group date timepicker" id="datetimepickerSS4" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepickerSS4">
                                                    <div class="input-group-append" data-target="#datetimepickerSS4" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clock">
                                                                <circle cx="12" cy="12" r="10"></circle>
                                                                <polyline points="12 6 12 12 16 14"></polyline>
                                                            </svg></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" name="t_type" value="Special Day" class="form-check-input" id="specialD">
                                                Special Day
                                                <i class="input-frame"></i></label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary mr-2 float-right" name="add_time"><i data-feather="plus"></i> Update</button>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <?php
        if (isset($_POST['add_time'])) {
            $type = $_POST['t_type'];
            $d1 = $conn->real_escape_string($_POST['d1']);
            $d2 = $conn->real_escape_string($_POST['d2']);
            $d3 = $conn->real_escape_string($_POST['d3']);
            $d4 = $conn->real_escape_string($_POST['d4']);


            $nrql1 = $rtql1->num_rows;

            if (!$nrql1 > 0) {
                if ($type == 'Daily') {
                    $ql2 = "INSERT INTO `doc_times` (`doc_id`,`c_id`,`t_type`,`d_ms`,`d_me`,`d_es`,`d_ee`)
                    VALUES('$d_id','$c_id','$type','$d1','$d2','$d3','$d4')";
                    $rql2 = $conn->query($ql2);
                    if ($rql2) {
                        echo "<script>location.href='./set_time.php?id=$d_id&c=$c_id'</script>";
                    }
                }
            } else {
                if ($type == 'Daily') {
                    $ql3 = "UPDATE  `doc_times` SET 
                    `d_ms` = '$d1',
                    `d_me` = '$d2',
                    `d_es` = '$d3',
                    `d_ee` = '$d4' 
                    WHERE `id` = '$d_tql1->id'";
                    $rql3 = $conn->query($ql3);
                    if ($rql3) {
                        echo "<script>location.href='./set_time.php?id=$d_id&c=$c_id'</script>";
                    }
                }
            }
        }
        ?>
    </div> <!-- row -->
</div>
<script>
    document.title = "Set Timing - Purulia Doctors Admin"
</script>

<?php include(footer); ?>
<script>
    $('#dailyIn').change(function() {
        $('#daily').toggle();
        // $('#selectedD').toggleAttr('disabled','disabled') 
        // let selectedD = document.querySelector('#selectedD');

        // selectedD.toggleAttribute('disabled','disabled')
        $('#dailyIn').click(function() {
            if (this.checked) {
                $('#selectedD').prop('disabled', true);
                $('#specialD').prop('disabled', true);

            } else {
                $('#selectedD').prop('disabled', false);
                $('#specialD').prop('disabled', false);

            }
        });
    });
    $('#selectedD').change(function() {
        $('#days').toggle();
        $('#days1').toggle();
        $('#days2').toggle();
        $('#days3').toggle();
        $('#days4').toggle();
        $('#days5').toggle();
        $('#days6').toggle();

    });
    $('#monday').change(function() {
        $('#monday1').toggle();

    });
    $('#tuesday').change(function() {
        $('#tuesday1').toggle();

    });
    $('#wednesday').change(function() {
        $('#wednesday1').toggle();

    });
    $('#thursday').change(function() {
        $('#thursday1').toggle();

    });
    $('#friday').change(function() {
        $('#friday1').toggle();

    });
    $('#saturday').change(function() {
        $('#saturday1').toggle();

    });
    $('#sunday').change(function() {
        $('#sunday1').toggle();

    });
</script>