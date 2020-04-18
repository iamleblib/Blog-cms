<?php include 'includes/header.php'; ?>

<div id="wrapper">

	<!-- Navigation -->
	<?php include 'includes/navigation.php'; ?>


	<div id="page-wrapper">

		<div class="container-fluid">

			<!-- Page Heading -->
			<div class="row">

					<h1 class="page-header">
						Welcome to the Administration Panel
					</h1>

				</div>
        <!-- Comment tables -->

        <div class="table-responsive">
				<?php 
					if (isset($_GET['delSuccess'])) {
						echo "<span class='label label-success'>Comment Deleted</span>";
					} else if (isset($_GET['updated'])) {
						echo "<span class='label label-success'>Status Updated</span>";
					}
				?>
	 <hr>

				<table class="table table-hover">
					<thead>
						<th>Name</th>
						<th>Message</th>
            <th>Status</th>
            <th>Action</th>
						</thead>
					<tbody>
						<?php getAllComments(); ?>
					</tbody>
					<tfoot>
						<th>Name</th>
						<th>Message</th>
            <th>Status</th>
            <th>Action</th>
						</tfoot>
				</table>
			</div>

      <!-- End of comment table -->

			</div>

			<!-- /.row -->

		</div>
		<!-- /.container-fluid -->

	</div>
	<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="bootstrap/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>

</html>
