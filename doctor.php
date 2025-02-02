<?php
// Include the connection file
include ('./common/header.php');
// global $conn;
?>
<br>
<br>
<br>
<!-- ======= Doctors Section ======= -->

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
        <br>

        <!-- =========== searchbox =========== -->
        <form class="max-w-2xl mx-auto" method="POST">
            <div class="flex">
                <label for="search-dropdown" class="mb-2 text-sm font-medium text-gray-900 sr-only">Your Email</label>
                <div class="relative">
                    <button id="dropdown-button" data-dropdown-toggle="dropdown"
                        class="flex-shrink-0 z-10 inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-gray-900 bg-gray-100 border border-gray-300 rounded-s-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100"
                        type="button">All <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg></button>
                    <div id="dropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 absolute mt-2">
                        <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdown-button">
                            <li>
                                <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100"
                                    onclick="selectCategory('Doctor')">Doctor</button>
                            </li>
                            <li>
                                <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100"
                                    onclick="selectCategory('Category')">Category</button>
                            </li>
                            <li>
                                <button type="button" class="inline-flex w-full px-4 py-2 hover:bg-gray-100"
                                    onclick="selectCategory('Clinic')">Clinic</button>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="relative w-full">
                    <input type="search" id="search-dropdown"
                        class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg border-s-gray-50 border-s-2 border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="Doctor, Clinic, Category" required />
                    <button type="submit"
                        class="absolute top-0 end-0 p-2.5 text-sm font-medium h-full text-white bg-blue-700 rounded-e-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                        <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                        <span class="sr-only">Search</span>
                    </button>
                </div>
            </div>
        </form>
        <br>
        <br>
        <br>

        <div class="row gy-4">
            <?php
            $query = "SELECT * FROM doctors";
            $query_run = mysqli_query($conn, $query);
            $check_doctor = mysqli_num_rows($query_run) > 0;

            if ($check_doctor) {
                while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>
                    <div class="col-md-6 ">
                        <a href="doctor-details.php?doctor_id=<?php echo $row['id']; ?>">
                            <div class="relative d-flex shadow-md p-8 rounded-xl min-w-96 mb-14	max-w-min h-full  ">
                                <div class="overflow-hidden	w-48 rounded-3xl "><img class="ease-in-out duration-300 hover:scale-110	" src="<?php echo $row['photo'] ?>" class="img-fluid" alt=""></div>
                                <div class="p-8">
                                    <a class="no-underline"
                                        href="doctor-details.php?doctor_id=<?php echo $row['id']; ?>">
                                        <h4 class="font-bold mb-1.5 text-xl	text-cyan-800 no-underline	"><?php echo $row['full_name'] ?></h4>
                                    </a>
                                    <span class="inline-block text-sm pb-2.5 relative font-medium w-auto
                                        after:content-[''] after:absolute after:inline-block after:w-full after:h-px after:bg-slate-300 after:bottom-0	after:left-0 after:min-w-fit " ><?php echo $row['category'] ?></span>
                                    <p class="m-2.5	text-sm	" ><?php echo $row['category'] ?></p>
                                    <div class="mb-4">
                                        <p class="text-gray-500 text-sm mb-6">
                                            <i class="ri-map-pin-2-fill"></i> <?php echo $row['address'] ?>
                                            <a href="javascript:void(0);">Get Directions</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
            } else {
                echo "No Doctor Found";
            }
            ?>
        </div>
    </div>
    </div>
</section>
<br><br><br><br>

<?php
include ('./common/about.php');
?>

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i>
</a>

<!-- Vendor JS Files -->
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>



<!-- END of it's your boy Sudip-->
<!--=============== MAIN JS ===============-->
<!-- M-413-205-520 -->
<!-- 123456 -->
<!-- <script src="assets/js/main.js"></script> -->