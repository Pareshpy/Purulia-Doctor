<?php
include 'functions.php';

$pd = new PD;
$doctors = $pd->getDoctors();
$doctors = json_decode($doctors, true);


// if ($doctors === null) {
//     echo "Failed to decode JSON.";
// } else {
//     echo "<div>";
//     foreach ($doctors as $doctor) {
//         echo "<p>ID: " . htmlspecialchars($doctor['id']) . "</p>";
//         echo "<p>doctor name: " . htmlspecialchars($doctor['full_name']) . "</p>";
//         echo "<p>short email: " . htmlspecialchars($doctor['short_name']) . "</p>";
//         echo "<p>doctor phone: " . htmlspecialchars($doctor['phone']) . "</p>";
//         echo "<p>doctor email: " . htmlspecialchars($doctor['email']) . "</p>";
//         echo "<p>registration no: " . htmlspecialchars($doctor['reg_no']) . "</p>";
//         echo "<p>degrees: " . htmlspecialchars($doctor['degrees']) . "</p>";
//         echo "<p>category: " . htmlspecialchars($doctor['category']) . "</p>";
//         echo "<p>specialty: " . htmlspecialchars($doctor['specialty']) . "</p>";
//         echo "<p>exp in years: " . htmlspecialchars($doctor['exp']) . "</p>";
//         echo "<p>address: " . htmlspecialchars($doctor['address']) . "</p>";
//         echo "<p>verified: " . htmlspecialchars($doctor['verified']) . "</p>";
//         echo "<p>status: " . htmlspecialchars($doctor['status']) . "</p>";
//         echo "<p>document: " . htmlspecialchars($doctor['document']) . "</p>";
//         echo "<p>fees: " . htmlspecialchars($doctor['fees']) . "</p>";
//         echo '<img src="../' . htmlspecialchars($doctor['photo']) . '" alt="' . htmlspecialchars($doctor['photo']) . '">';
//         echo "<hr>";
//     }
//     echo "</div>";
// }
?>

<body class="bg-gray-50">
    <section class="p-6 gap-4">
        <div class="max-w-7xl mx-auto bg-white shadow-md rounded-lg p-6 my-6">
            <!-- Title & Search Box Wrapper -->
            <div class="flex justify-between items-center">
                <!-- Title -->
                <h2 class="text-xl font-semibold text-gray-800 sm:hidden md:block">
                    <?= count($doctors) ?> doctors in Purulia
                </h2>

                <!-- Search Box -->
                <div class="relative w-full md:w-64">
                    <input
                        class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 w-full rounded-lg text-sm focus:outline-none"
                        type="search" name="search" placeholder="Search" id="search">
                    <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                        <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 56.966 56.966" width="512px" height="512px">
                            <path d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  
                s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  
                c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17
                s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div id="searchResult"></div>

        <?php foreach ($doctors as $doctor) { ?>
            <div class="max-w-7xl mx-auto bg-white shadow-md rounded-lg p-6 my-6 allClinics">
                <div class="flex flex-col md:flex-row items-center gap-6">
                    <!-- Doctor Image -->
                    <div class="w-full md:w-1/3 flex justify-center">
                        <img src="./uploads/dr.jaydeepmandal.jpg" alt="Doctor Image"
                            class="max-h-80 w-40 sm:w-48 md:w-56 lg:w-60 xl:w-64 object-cover rounded-lg">
                    </div>

                    <!-- Doctor Info -->
                    <div class="flex-1">
                        <h3
                            class="lg:text-2xl md:text-xl font-bold text-gray-700 mb-2 text-left md:text-center lg:text-left">
                            <?php echo htmlspecialchars($doctor['full_name']); ?>
                        </h3>
                        <p class="text-gray-600 text-medium mb-1 ">
                            <span class="font-semibold"><?php echo htmlspecialchars($doctor['category']); ?></span>
                        </p>
                        <p class="text-gray-600 text-medium mb-10 ">
                            <span class="text-sm"><?php echo htmlspecialchars($doctor['exp']); ?> Years Experience
                                Overall</span>
                        </p>

                        <p class="text-gray-600 text-sm mb-2">
                            <span
                                class="text-indigo-500 font-semibold"><?php echo htmlspecialchars($doctor['address']); ?></span>
                        </p>
                        <p class="text-gray-600 text-sm mb-2">
                            <span class="font-semibold">₹<?php echo htmlspecialchars($doctor['fees']); ?></span>
                            Consultation
                            Fees
                        </p>
                        <p class="text-gray-700 font-semibold text-sm mb-2">11 Specialties • 12 doctors</p>
                        <p class="text-gray-600 text-sm mb-2"><span class="font-thin">🕒</span> MON - SUN 08:00AM - 10:30PM
                        </p>
                    </div>

                    <!-- Rating -->
                    <div class="flex flex-col items-center w-full md:w-1/4 space-y-4">
                        <!-- Rating -->
                        <span class="bg-green-100 text-green-600 text-sm font-semibold px-16 py-2 rounded-lg transition">
                            ⭐ 3.5 (35 rated)
                        </span>

                        <!-- Button -->
                        <button
                            class="bg-blue-500 text-white text-sm font-semibold px-16 py-2 rounded-lg hover:bg-blue-600 transition">
                            Book clinic visit
                        </button>
                        <button
                            class="bg-blue-500 text-white text-sm font-semibold px-16 py-2 rounded-lg hover:bg-blue-600 transition">
                            <i class="ri-phone-fill"></i>
                            Call Clinic   
                        </button>
                    </div>


                </div>
                <div class="mt-6">

                </div>
            </div>
        <?php } ?>






    </section>
</body>

<!-- <section id="doctors" class="doctors">
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
</section> -->