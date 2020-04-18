<div class="row">
  <div class="col-md-12">
    <div class="form-group">
    
    <div class="text-right"><a href="posts.php?source=viewPost" class="btn btn-success">View Posts</a></div>
    <hr>
    <?php 
      if (isset($_GET['editId'])) {
        $postEditId = $_GET['editId'];
        editPost($postEditId);
      } else {
        ?>

       
      <form method="post" enctype="multipart/form-data">
     <div class="col-md-6">
       <!-- post title -->
       <label for="title">Title</label>
        <input title="Enter a Title" type="text" name="title" placeholder="Enter Post Title" class="form-control" id="" required />
        
        <!-- Post Category -->
        <label for="categories">Categories</label>
          <select title="Select Category" class="form-control" name="categories">
            <option value="uncategorised">Uncategorised</option>
            <?php getPostCategories(); ?>
          </select>
      </div>
      <div class="col-md-6">
        <!-- Upload Post Images -->
        <label for="file">Image</label>
        <input title="Optional" type="file" name="file" class="form-control" id="" >

        <!-- Publish Posts Or Not -->
        <label for="status">Status</label>
        <select title="Select Post Status" class="form-control" name="status" required>
          <option value=""> - Select Post Status - </option>
          <option value="publish">Publish to Public</option>
          <option value="draft">Save To Draft</option>
        </select>
      </div>
      <div class="col-md-12">
        <!-- Post Body -->
        <label for="body"></label> 
        <textarea class="form-control" name="body" placeholder="Enter Your Blog Post" cols="30" rows="10" required></textarea>
      </div>
      
      
      <div class="col-md-6 col-md-offset-3"> &nbsp;
          <button name="btnAddPost" type="submit" class="btn btn-primary btn-block">Create Post</button>
        </div>
      </form>
      <?php } ?>
    </div>
  </div>
</div>