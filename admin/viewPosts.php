<div class="table-responsive">
	<?php 
		
	?>
<div class="text-right"><a href="posts.php?source=addPost" class="btn btn-primary">Create New Posts</a></div> <hr>
				<table class="table table-hover">
					<thead>
						<th>Title</th>
						<th>Category</th>
						<th>Views</th>
						<th>Body</th>
						<th>Status</th>
						<th>Image</th>
						<th>Author</th>
						<th>Action</th>
					</thead>
					<tbody>
						<?php viewPosts(); ?>
					</tbody>
					<tfoot>
						<th>Title</th>
						<th>Category</th>
						<th>Views</th>
						<th>Body</th>
						<th>Status</th>
						<th>Image</th>
						<th>Author</th>
						<th>Action</th>
					</tfoot>
				</table>
			</div>