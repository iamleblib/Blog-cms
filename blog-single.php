<?php 
  if (isset($_GET['blogId'])) {
    $blogId = $_GET['blogId'];
    if (!is_numeric($blogId)) {
       header("location: ./");
    } 
  }
?>
<?php include 'includes/header.php'; ?>

    <div class="wrap">

      <?php include 'includes/navigation.php'; ?>
      
      <!-- END header -->

    <section class="site-section py-lg">
      <div class="container">
        
        <div class="row blog-entries element-animate">

          <div class="col-md-12 col-lg-8 main-content">
            <?php fullPost($blogId); ?>
            
            <?php 
                if (isset($_GET['commentSuccess'])) {
                  echo "<span class='alert alert-success'> Comment Added Waiting To Be Approved By Admin</span>";
                }

                $getAllComment = mysqli_query($conn, "SELECT * FROM comments WHERE status = 'approve' AND post_id = '$blogId'");
                $countComment = mysqli_num_rows($getAllComment);
              ?>
          <a name="commentAdded"></a>
            <div class="pt-5">
              <h3 class="mb-5"><?php echo  $countComment; ?> Comments</h3>
              <ul class="comment-list">
                <?php
                  if ($countComment == 0) {
                    echo "<span class='alert alert-default'>Be The First To Leave A Comment</span>";
                  } else {
                    getComments($blogId);
                  }
                ?>
              </ul>
              
              <!-- END comment-list -->
              
              <div class="comment-form-wrap pt-5">
              
              <a name="comment"></a>
                <h3 class="mb-5">Leave a comment</h3>
                
                <form method="POST" class="p-5 bg-light">
                
                <?php 
                if (isset($_GET['emptyFields'])) {
                  echo "<span class='alert alert-danger'> All Comment Fields Are Required</span>";
                }
              ?>
              <hr> 
                  <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" name="name" class="form-control" id="name">
                  </div>
                  <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" name="addComment" value="Post Comment" class="btn btn-primary">
                  </div>

                </form>
              </div>
            </div>

          </div>

          <!-- END main-content -->

          <div class="col-md-12 col-lg-4 sidebar">
            <div class="sidebar-box search-form-wrap">
              <form action="#" class="search-form">
                <div class="form-group">
                  <span class="icon fa fa-search"></span>
                  <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
                </div>
              </form>
            </div>
            <!-- END sidebar-box -->
            <div class="sidebar-box">
              <div class="bio text-center">
                <img src="images/person_2.jpg" alt="Image Placeholder" class="img-fluid">
                <div class="bio-body">
                  <h2>Caleb Joseph</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus.</p>
                  <p><a href="" class="btn btn-primary btn-sm rounded">Read my bio</a></p>
                  <p class="social">
                    <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-youtube-play"></span></a>
                  </p>
                </div>
              </div>
            </div>
            <!-- END sidebar-box -->  
            
            <?php include 'includes/sidebar.php'; ?>
            <!-- END sidebar-box -->

            <?php include 'includes/category.php'; ?>

            <!-- END sidebar-box -->
          </div>
          <!-- END sidebar -->

        </div>
      </div>
    </section>

    <section class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="mb-3 ">Related Post</h2>
          </div>
        </div>
        <div class="row">
          <?php  relatedPost($postCategory, $blogId); ?>
        </div>
      </div>

    </section>
    <!-- END section -->
  
    <footer class="site-footer">
        <div class="container">
          <div class="row mb-5">
            <div class="col-md-4">
              <p class="mb-4">
                <img width="250" src="images/leblib-removebg-preview.png" alt="Image placeholder" class="img-fluid">
              </p>
            </div>
            <div class="col-md-6 ml-auto">
              <div class="row">
                <div class="col-md-10">
                  <h3>Latest Post</h3>
                  <div class="post-entry-sidebar">
                    <ul>
                      <?php relatedPosts($postCategory, $blogId); ?>
                    </ul>
                  </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Hic, quia animi magni et quos corrupti sunt id veritatis aspernatur quae perspiciatis deleniti consequuntur molestias assumenda expedita quas omnis, at ducimus quidem error. Perspiciatis, architecto consequatur aliquid provident illum laudantium voluptas eaque doloribus explicabo incidunt amet et cumque dignissimos nam consequuntur.
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facilis nesciunt doloribus, repudiandae quisquam odit placeat amet delectus expedita sapiente dicta a ut. Dicta, iusto amet modi reprehenderit odio culpa cum.</p>
              <p class="small">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy; <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All Rights Reserved | This template is made with <i class="fa fa-heart text-danger" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Leblib</a>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
            </div>
          </div>
        </div>
      </footer>
      <!-- END footer -->

    </div>
    
    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>

    
    <script src="js/main.js"></script>
  </body>
</html>