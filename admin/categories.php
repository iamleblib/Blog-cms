<?php include 'includes/header.php';?>

    <div id="wrapper">

        <!-- Navigation -->
       <?php include 'includes/navigation.php'; ?>


        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">

                        <h1 class="page-header">
                            Welcome to the Administration Panel
                        </h1>
					<div class="col-sm-6">
                   <div>
                   <?php 
                        if (isset($_GET['emptyFields'])) {
                            echo "<span class='label label-danger'>Please Enter a Category!</span>";
                        } else if (isset($_GET['is_numeric'])) {
                            echo "<span class='label label-danger'>Categories Must Be String Data!</span>";
                        } else if (isset($_GET['exist'])) {
                            echo "<span class='label label-danger'>Category Already Exists!</span>";
                        } else if (isset($_GET['addedSuccess'])) {
                            echo "<span class='label label-success'>Category Added!</span>";
                        } else if (isset($_GET['catUpdated'])) {
                            echo "<span class='label label-success'>Category Updated!</span>";
                        } else if (isset($_GET['catDeleted'])) {
                            echo "<span class='label label-success'>Category Deleted!</span>";
                        } 
                    ?>
                   </div>
                    &nbsp;
                    <?php 
                    // Display editable category
                        if (isset($_GET['editCatId'])) {
                        ?>
                        <form action="" method="post">
                            <div class="form-group">
                            <input type='text' value="<?php editCategories($catEditId); ?>" name='cat_name' placeholder='Category Title' class='form-control'>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="cat_edit" value="Edit" class="btn btn-primary">
                            </div>
                        </form>
                        <?php } else { ?>
                        <!-- Add New Category -->
                            <form action="" method="post">
                                <div class="form-group">
                                    <input type="text" name="cat_name" placeholder="Category Title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="cat_add" value="Add Category" class="btn btn-primary">
                                </div>
                            </form>
                        <?php } ?>
					</div>
               	<div class="col-sm-6">
                <div class="table table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <th>Category Name</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php getCategories(); ?>
                        </tbody>
                        <tfoot>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tfoot>
                    </table>
                </div>
						</div>
                <!-- /.row -->
            </div>
        </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
