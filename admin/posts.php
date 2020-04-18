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
				</div>
			<?php
			
			// Error Message 
    // error from the url GET
      if (isset($_GET['empty'])) {
        echo "<span class='label label-danger'>All Fields Are Required!</span>";
      } else if (isset($_GET['postAdded'])) {
        echo "<span class='label label-success'>Post Added Successfully!</span>";
      } else if (isset($_GET['edited'])) {
        echo "<span class='label label-success'>Post Edited Successfully!</span>";
      }	else if (isset($_GET['unApprovedDone'])) {
        echo "<span class='label label-success'>Post Status Updated To Unapproved</span>";
      } else if (isset($_GET['approvedDone'])) {
        echo "<span class='label label-success'>Post Status Updated To Approved</span>";
      }	else if (isset($_GET['deleteDone'])) {
        echo "<span class='label label-success'>Post Deleted</span>";
      }
			// End Error Message
		
			// Check Conditions 

				if (isset($_GET['source'])) {
					$source = $_GET['source'];
					switch ($source) {
						case 'viewPost':
								include 'viewPosts.php';
							break;

						case 'addPost':
								include 'addPosts.php';
							break;
						
						default:
								include 'viewPosts.php';
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
