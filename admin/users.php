
<?php include 'includes/header.php'; ?>
<?php 
	if ($role == "Guest") {
		header("location: ./");
	}
?>
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
					<?php 
						if (isset($_GET['deletedUser'])) {
							echo "<span class='label label-success'>User Deleted</span>";
						}
					?>
				</div>
			<?php 
				if (isset($_GET['source'])) {
					$location = $_GET['source'];

						switch ($location) {
							case 'add_user':
								include 'addUser.php';
								break;
							case 'view_user':
								include 'viewUser.php';
								break;
							
							default:
							include 'viewUser.php';
								break;
						}
				}
			?>

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
