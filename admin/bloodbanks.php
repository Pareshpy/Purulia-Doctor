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
				<h4 class="mb-3 mb-md-0">Blood Banks</h4>
			</div>
			<a href="./add_bloodbank.php" class="btn btn-primary btn-icon-text mb-2 mb-md-0 float-right"><i data-feather="plus"></i> Add Blood Bank</a>
		</div>
		<div class="row">


			<div class="col-md-12 grid-margin stretch-card">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="dataTableExample" class="table">
								<thead>
									<tr>
										<th>S. no.</th>
										<th>Name</th>
										<th>Phone no.</th>
										<th>Verified</th>
										<th>Status</th>
										<th class="d-flex justify-content-center align-items-center">Options</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									$bb = "SELECT * FROM `bloodbanks`";
									$run_bb = $conn->query($bb);
									while ($res_bb = $run_bb->fetch_object()) {
									?>
										<tr>
											<td><?= $i ?></td>
											<td><?= $res_bb->name ?></td>
											<td><?= $res_bb->phone ?></td>
											<td><?= $res_bb->verified == 1 ? "Yes" : "No" ?></td>
											<td><?= $res_bb->status == 1 ? "Active" : "Suspended" ?></td>
											<td class="d-flex justify-content-center align-items-center">
												<a href="./edit_bloodbank.php?id=<?= $res_bb->id ?>" class="btn btn-primary btn-icon-text mb-2 mb-md-0" style="margin:0 5px 0 5px;"><i data-feather="edit-2"></i></a>
												<a href="./del_bloodbank.php?id=<?= $res_bb->id ?>" class="btn btn-danger btn-icon-text mb-2 mb-md-0" style="margin:0 5px 0 5px;"><i data-feather="minus-circle"></i></a>
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

		</div> <!-- row -->
	</div>
	<script>
		document.title = "Blood Banks - Purulia Doctors Admin"
	</script>
	<?php include(footer); ?>