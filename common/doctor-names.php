<!-- ======= Doctors Section ======= -->
<?php
include 'functions.php';

$pd = new PD;
$doctors = $pd->getDoctors();
$doctors = json_decode($doctors);

?>

<section id="doctors" class="doctors">
    <div class="container">
        <div class="section-title">
            <a style="text-decoration: none;" href="doctor.php">
                <h2>Doctors</h2>
            </a>
            <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia
                fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="main-div">
            <div class="row gy-4">
                <?php
                // $query = "SELECT * FROM doctors";
                // $query_run = mysqli_query($conn, $query);
                // $check_doctor = mysqli_num_rows($query_run) > 0;
                
                // if ($check_doctor) {
                //     while ($row = mysqli_fetch_assoc($query_run)) {
                foreach ($doctors as $i => $doctor) {
                    ?>
                    <div class="col-md-6 ">
                        <a href="doctor-details.php?doctor_id=<?php echo $doctor->id; ?>">
                            <div class="member d-flex">
                                <div class="pic"><img src="../<?php echo $doctor->photo ?>" class="img-fluid" alt=""></div>
                                <div class="member-info">
                                    <a style="text-decoration: none;"
                                        href="doctor-details.php?doctor_id=<?php echo $doctor->id; ?>">
                                        <h4><?php echo $doctor->full_name ?></h4>
                                    </a>
                                    <span><?php echo $doctor->category ?></span>
                                    <p><?php echo $doctor->category ?></p>
                                    <div class="clinic-details">
                                        <p class="doc-location">
                                            <i class="ri-map-pin-2-fill"></i> <?php echo $doctor->address ?>
                                            <a href="javascript:void(0);">Get Directions</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
                //     }
                // } else {
                //     echo "No Doctor Found";
                // }
                ?>
            </div>
        </div>
        <div class="more">
            <a href="doctor.php" style="text-decoration:none"
                class="py-3 px-5 bg-indigo-500 text-white text-sm font-semibold rounded-md shadow-lg shadow-indigo-500/50 focus:outline-none">
                All Doctors
            </a>
        </div>
    </div>
</section>