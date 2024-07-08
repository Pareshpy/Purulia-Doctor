<!-- ======= Doctors Section ======= -->
<?php include 'connection.php'; ?>

<section id="doctors" class="doctors">
    <div class="container">

        <div class="section-title">
            <a href="doctor.php">
                <h2>Doctors</h2>
            </a>
            <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint
                consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia
                fugiat sit in iste officiis commodi quidem hic quas.</p>
        </div>

        <div class="container-2">
            <div class="services">
                <?php
                $query = "SELECT * FROM doctors";
                $query_run = mysqli_query($conn, $query);
                $check_doctor = mysqli_num_rows($query_run) > 0;

                if ($check_doctor) {
                    while ($row = mysqli_fetch_assoc($query_run)) {
                        ?>

                        <a href="doctor-details.php">
                            <div class="member d-flex align-items-start">
                                <div class="pic"><img src="assets/img/doctors/dortor1.jpg" class="img-fluid" alt=""></div>
                                <div class="member-info">
                                    <a href="doctor-details.php">
                                        <h4><?php echo $row['full_name'] ?></h4>
                                    </a>
                                    <span><?php echo $row['category'] ?></span>
                                    <p><?php echo $row['category'] ?></p>
                                    <div class="clinic-details">
                                        <p class="doc-location">
                                            <i class="ri-map-pin-2-fill"></i> <?php echo $row['address'] ?>
                                            <a href="javascript:void(0);">Get Directions</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <?php
                    }
                } else {
                    echo "No Doctor Found";
                }

                ?>

            </div>
        </div>