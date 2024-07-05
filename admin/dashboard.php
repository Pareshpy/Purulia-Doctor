<?php
session_start();
include("./includes/config.php");
if (!isset($_SESSION['username'])) {
	header("location: ./");
}
include(header);
// Get clinics
$clinics = "SELECT * FROM `clinics`";
$get_clinics = $conn->query($clinics);
$num_clinics = $get_clinics->num_rows;
// Get doctors
$docs = "SELECT * FROM `doctors`";
$get_docs = $conn->query($docs);
$num_docs = $get_docs->num_rows;
// Get bloodbanks
$bb = "SELECT * FROM `bloodbanks`";
$get_bb = $conn->query($bb);
$num_bb = $get_bb->num_rows;
// Get categories
$cats = "SELECT * FROM `categories`";
$get_cats = $conn->query($cats);
$num_cats = $get_cats->num_rows;
// Get specialties
$specs = "SELECT * FROM `specialties`";
$get_specs = $conn->query($specs);
$num_specs = $get_specs->num_rows;
// Get categories
$degrees = "SELECT * FROM `degrees`";
$get_degrees = $conn->query($degrees);
$num_degrees = $get_degrees->num_rows;
?>


<div class="page-wrapper">

	<div class="page-content">

		<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
			<div>
				<h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
			</div>

		</div>

		<div class="row">
			<div class="col-12 col-xl-12 stretch-card">
				<div class="row flex-grow">
					<div class="col-md-4 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<div class="d-flex justify-content-between align-items-baseline">
									<h6 class="card-title mb-0">Clinics</h6>

								</div>
								<div class="row">
									<div class="col-6 col-md-12 col-xl-5">
										<h3 class="mb-2"><?= $num_clinics ?></h3>

									</div>
									<div class="col-6 col-md-12 col-xl-7">
										<a href="./clinics.php" class="btn btn-primary btn-icon-text mb-2 mb-md-0" style="width:100%;">View Clinics</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<div class="d-flex justify-content-between align-items-baseline">
									<h6 class="card-title mb-0">Doctors</h6>

								</div>
								<div class="row">
									<div class="col-6 col-md-12 col-xl-5">
										<h3 class="mb-2"><?= $num_docs ?></h3>

									</div>
									<div class="col-6 col-md-12 col-xl-7">
										<a href="./doctors.php" class="btn btn-primary btn-icon-text mb-2 mb-md-0" style="width:100%;">View Doctors</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<div class="d-flex justify-content-between align-items-baseline">
									<h6 class="card-title mb-0">Blood Banks</h6>

								</div>
								<div class="row">
									<div class="col-6 col-md-12 col-xl-5">
										<h3 class="mb-2"><?= $num_bb ?></h3>

									</div>
									<div class="col-6 col-md-12 col-xl-7">
										<a href="./bloodbanks.php" class="btn btn-primary btn-icon-text mb-2 mb-md-0" style="width:100%;">View Blood Banks</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div> <!-- row -->
		<hr>
		<br>
		<div class="row">
			<div class="col-12 col-xl-12 stretch-card">
				<div class="row flex-grow">
					<div class="col-md-4 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<div class="d-flex justify-content-between align-items-baseline">
									<h6 class="card-title mb-0">Categories</h6>

								</div>
								<div class="row">
									<div class="col-6 col-md-12 col-xl-5">
										<h3 class="mb-2"><?= $num_cats ?></h3>

									</div>
									<div class="col-6 col-md-12 col-xl-7">
										<a href="./categories.php" class="btn btn-primary btn-icon-text mb-2 mb-md-0" style="width:100%;">View Categories</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<div class="d-flex justify-content-between align-items-baseline">
									<h6 class="card-title mb-0">Specialties</h6>

								</div>
								<div class="row">
									<div class="col-6 col-md-12 col-xl-5">
										<h3 class="mb-2"><?= $num_specs ?></h3>

									</div>
									<div class="col-6 col-md-12 col-xl-7">
										<a href="./specialties.php" class="btn btn-primary btn-icon-text mb-2 mb-md-0" style="width:100%;">View Specialties</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 grid-margin stretch-card">
						<div class="card">
							<div class="card-body">
								<div class="d-flex justify-content-between align-items-baseline">
									<h6 class="card-title mb-0">Degrees</h6>

								</div>
								<div class="row">
									<div class="col-6 col-md-12 col-xl-5">
										<h3 class="mb-2"><?= $num_degrees ?></h3>

									</div>
									<div class="col-6 col-md-12 col-xl-7">
										<a href="./degrees.php" class="btn btn-primary btn-icon-text mb-2 mb-md-0" style="width:100%;">View Degrees</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div> <!-- row -->

	</div>

	<?php include(footer); ?>