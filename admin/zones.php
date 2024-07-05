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
				<h4 class="mb-3 mb-md-0">Zones</h4>
			</div>
			<a href="./add_zone.php" class="btn btn-primary btn-icon-text mb-2 mb-md-0 float-right"><i data-feather="plus"></i> Add Zones</a>
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
										<th>Status</th>
										<th class="d-flex justify-content-center align-items-center">Options</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									$cats = "SELECT * FROM `zones`";
									$run_cats = $conn->query($cats);
									while ($res_cats = $run_cats->fetch_object()) {
									?>
										<tr>
											<td><?= $i ?></td>
											<td><?= $res_cats->name ?></td>
											<td><?= $res_cats->status == 1 ? "Active" : "Suspended" ?></td>
											<td class="d-flex justify-content-center align-items-center">
												<a href="./edit_zone.php?id=<?= $res_cats->id ?>" class="btn btn-primary btn-icon-text mb-2 mb-md-0" style="margin:0 5px 0 5px;"><i data-feather="edit-2"></i></a>
												<a href="./del_zone.php?id=<?= $res_cats->id ?>" class="btn btn-danger btn-icon-text mb-2 mb-md-0" style="margin:0 5px 0 5px;"><i data-feather="minus-circle"></i></a>
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
		document.title = "Zones - Purulia Doctors Admin"
	</script>
	<?php include(footer); ?>