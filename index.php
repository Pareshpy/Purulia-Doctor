<?php
// Include the connection file
include ('./common/header.php');
// global $conn;
?>
<!-- ======= Hero Section ======= -->
<span id="home"></span>
<section id="hero" class="d-flex align-items-center">
    <div class="container">
        <h1>Welcome to Purulia Doctor</h1>
        <h2>We offer appointments for various clinics, providing essential health services to the community.</h2>
        <a href="#about" class="btn-get-started scrollto">Get Started</a>
    </div>
</section>

<section>
    <div class="container-2" id="service">
        <div class="left-panel">
            <h2 id="edit">Why Choose Medilab?</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Duis aute irure dolor in reprehenderit Asperiores dolores sed et. Tenetur quia eos.
                Autem tempore quibusdam vel necessitatibus optio ad corporis.</p>
            <button onclick="showToast">Learn More</button>
        </div>
        <div class="right-panel">
            <div class="card">
                <div class="icon"><i class="ri-hospital-fill"></i></div>
                <h3>Corporis voluptates sit</h3>
                <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laborios nisi ut aliquip.</p>
            </div>
            <div class="card">
                <div class="icon">logo</div>
                <h3>Ullamco laboris ladore pan</h3>
                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt.</p>
            </div>
            <div class="card">
                <div class="icon">logo</div>
                <h3>Labore consequatur</h3>
                <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere.</p>
            </div>
        </div>
    </div>
</section>

<!-- <div>
    <button onclick="showToast"></button>
</div> -->


<?php
    include ('./common/catagories.php');
?>

<?php
    include ('./common/doctor-names.php');
?>


<br><br><br><br>

<?php
include ('./common/about.php');
?>

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i>
</a>

<!-- Vendor JS Files -->
<!-- <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script> -->


<div id="toastBox"></div>
<!--=============== MAIN JS ===============-->
<!-- <script src="assets/js/main.js"></script> -->
<script src="assets/js/notify.js"></script>
</body>

</html>