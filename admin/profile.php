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

        <h3>User Profile</h3> <hr>

        <?php 
          if (isset($_GET['updated'])) {
            echo "<span class='label label-success'>Profile Updated!</span>";
          }
        ?>

        <form method="post">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="username">Username</label>
                <input value="<?php echo $username; ?>" type="text" name="username" class="form-control">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="email">E-mail</label>
                <input value="<?php echo $email; ?>" type="text" disabled class="form-control">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="phone">Phone Number</label>
                <input value="<?php echo $phone; ?>" type="text" name="phone" class="form-control">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="role">Role</label>
                <input value="<?php echo $role; ?>" type="text" disabled class="form-control">
              </div>
            </div>
            <div>
              <button type="submit" name="updateProfile" class="btn btn-sm btn-primary btn-block ">Update Profile</button>
            </div>
          </div>
        </form>

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
