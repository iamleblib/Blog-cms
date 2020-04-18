
<?php 

// ####################################################################################
// #                Admin Functions Logic                                              #
// ####################################################################################


  include 'dbh.php';
  
  // addCategories
  function addCategories($catName)  {
    global $conn;
    if (empty($catName)) {
       header("location: categories.php?emptyFields");
    } else if (is_numeric($catName)) {
      header("location: categories.php?is_numeric");
    } else {
      $checkDatabase = mysqli_query($conn, "SELECT * FROM categories WHERE cat_name = '$catName'");
      if (mysqli_num_rows($checkDatabase) > 0) {
        header("location: categories.php?exist");
      } else {
        // change to Sentence case 
          $catName = strtolower($catName);
          $catName = ucwords($catName);
        // insert to database
        $createCategory = mysqli_query($conn, "INSERT INTO categories (cat_name) VALUES ('$catName') ");
        if ($createCategory) {
          header("location: categories.php?addedSuccess");
        } else {
          return false;
        }
      }
    }
  }
  // End Adding Categories 

  // Fetching Category from database and displaying it to users
  function getCategories()  {
    global $conn;
    $getCategories = mysqli_query($conn, "SELECT * FROM categories");
    while ($row = mysqli_fetch_assoc($getCategories)) {
      $catId = $row['cat_id'];
      $catName = $row['cat_name'];
      // Show categories details
      echo "
      <tr>
        <td><b class='label label-info' style='font-size: 15px;'>$catName</b></td>
        <td>
          <a href='?deleteCatId=$catId' class='btn btn-danger btn-sm'>Delete</a>
          <a href='?editCatId=$catId' class='btn btn-primary btn-sm'>Edit</a>
        </td>
      </tr>
    ";
    }
  }
  // End Showing Categories 
// Get category for addPost Form
function getPostCategories()  {
  global $conn;
  $getCategories = mysqli_query($conn, "SELECT * FROM categories");
  while ($row = mysqli_fetch_assoc($getCategories)) {
    $catId = $row['cat_id'];
    $catName = $row['cat_name'];
    // Show categories details
    echo "<option value='$catName'>$catName</option>";
  }
}
// end
  // Show Categories For Edit
  function editCategories($catEditId)  {
    global $conn;
    $catDb = mysqli_query($conn, "SELECT * FROM categories WHERE cat_id = '$catEditId'");
    while ($getAllCat = mysqli_fetch_assoc($catDb)) {
      $cat = $getAllCat['cat_name'];
      echo $cat;
    }
  }

  // Edit
  function editCat($catEdit, $catId) {
    global $conn;
    if (empty($catEdit)) {
      header("location: categories.php?emptyFields");
    } else if (is_numeric($catEdit)) {
      header("location: categories.php?is_numeric");
    } else {
      $checkExist = mysqli_query($conn, "SELECT * FROM categories WHERE cat_name = '$catEdit'");
      if (mysqli_num_rows($checkExist) > 0) {
        header("location: categories.php?exist");
      } else {
        // change to Sentence case 
        $catEdit = strtolower($catEdit);
        $catEdit = ucwords($catEdit);

        // Update Category
        $updateCat = mysqli_query($conn, "UPDATE categories SET cat_name = '$catEdit' WHERE cat_id = '$catId'");
        if ($updateCat) {
          header("location: categories.php?catUpdated");
        }
      }
    }
  }
  // End Editing Category

  // Delete Category 

  function deleteCategory($catId) {
    global $conn; 
    $deleteCat = mysqli_query($conn, "DELETE FROM categories WHERE cat_id = '$catId'");
    if ($deleteCat) {
      header("location: categories.php?catDeleted");
    }
  }
// create Post
 function createPost($title, $categories, $file, $status, $body) {
   global $conn;
    if (isset($_POST['btnAddPost'])) {
      if (empty($title) || empty($categories) || empty($file) || empty($status) || empty($body)) {
        header("location: posts.php?source=addPost&empty");
      } else {
        // Upload Images
          // get information about file 
          $file = $_FILES['file'];
          // print_r($file);
          $fileName = $_FILES['file']['name'];
          $fileTmpName = $_FILES['file']['tmp_name'];
          $fileSize = $_FILES['file']['size'];
          $fileError = $_FILES['file']['error'];
          $fileType = $_FILES['file']['type'];
        
          // files to allow to be uploaded
          $fileExt = explode('.', $fileName);
          $fileActualExt = strtolower(end($fileExt));
          // Files to allow
          $allowed = ['jpg', 'jpeg', 'png', 'pdf'];
          // check if files has proper extentions
          if (in_array($fileActualExt, $allowed)) {
            // check if there was any kind of errors when uploading 
            if ($fileError === 0) {
              if ($fileSize < 100000000) {
                // give file proper unique name 
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = 'uploads/'.$fileNameNew;
                // create a function that upload the file
               $uploadImage =  move_uploaded_file($fileTmpName, $fileDestination);
                if ($uploadImage) {
                   // change to Sentence case 
                    $title = strtolower($title);
                    $title = ucwords($title);
                    // Insert to database 
                    $createPost = mysqli_query($conn, "INSERT INTO posts (title, category, body, status, image) VALUES ('$title', '$categories', '$body', '$status', '$fileNameNew') ");
                    if ($createPost) {
                      header("location: posts.php?source=addPost&postAdded");
                    } else {
                      return false;
                    }
                }
              } else {
                echo "File too Large";
              }
            } else {
              echo "There was an error uploading your file";
            }
          } else {
            echo "You Cannot Upload Files Of This Type";
          }
        
        // end Upload images
       
      }
    }
 }

//  View Posts

function viewPosts()  {
  global $conn;
  $getAllPosts = mysqli_query($conn, "SELECT * FROM posts ORDER BY id DESC");
  while ($postsRow = mysqli_fetch_assoc($getAllPosts)) {
    $postId = $postsRow['id'];
    $postTitle = $postsRow['title'];
    $postCategories = $postsRow['category'];
    $postViews = $postsRow['views'];
    $postBody = $postsRow['body'];
    $postStatus = $postsRow['status'];
    $postImage = $postsRow['image'];
    $postAuthor = $postsRow['author'];
    $postCreatedAt = $postsRow['created_at'];
    
    ?>
    <tr>
      <td><?php echo $postTitle; ?></td>
      <td><?php echo "<span class='label label-info'>".$postCategories."</span>"; ?></td>
      <td><?php  ($postViews > 0) ? "<span class='label label-success'>".$postViews."</span>" : "<span class='label label-danger'>".$postViews."</span>"; ?></td>
      <td><?php echo substr($postBody, 0, 40);  if(strlen($postBody) > 50){echo "...";} ?></td>
      <td><?php if ($postStatus == "publish") {echo "<span class='label label-success'>".$postStatus."</span>";} else {echo "<span class='label label-danger'>".$postStatus."</span>";} ?></td>

      <td><?php echo "<img height='50' width='60' src='uploads/$postImage.'>"; ?></td>
      <td><?php echo $postAuthor; ?></td>
      <td>
        <div>
          <a href='?source=viewPost?&deletePostId=<?php echo $postId; ?>' class="btn btn-danger btn-sm">Delete</a>
          <a href='?source=addPost&editId=<?php echo $postId; ?>' class="btn btn-primary btn-sm">Edit</a>
          <?php 
            if ($postStatus == "publish") {
              echo "<a href='?source=viewPost?&unApproveId=$postId' class='btn btn-info btn-sm'>Unapprove</a>";
            } else {
              echo "<a href='?source=viewPost?&approveId=$postId' class='btn btn-success btn-sm'>Approve</a>";
            }
          ?> 
        </div> 
      </td>
    </tr>
    <?php
  }
}

// Show Posts For Edit
function editPost($postEditId)  {
  global $conn;
  $postDb = mysqli_query($conn, "SELECT * FROM posts WHERE id = '$postEditId'");
  $getPost = mysqli_fetch_assoc($postDb);

  // all posts details from db
    $postId = $getPost['id'];
    $postTitle = $getPost['title'];
    $postCategories = $getPost['category'];
    $postViews = $getPost['views'];
    $postBody = $getPost['body'];
    $postStatus = $getPost['status'];
    $postImage = $getPost['image'];
    $postAuthor = $getPost['author'];
    $postCreatedAt = $getPost['created_at'];
    
    echo "
    <form method='post' enctype='multipart/form-data'>
    <div class='col-md-6'>
      <!-- post title -->
      <label for='title'>Title</label>
       <input value='$postTitle' title='Enter a Title' type='text' name='editTitle' placeholder='Enter Post Title' class='form-control' id=''  />
       
       <!-- Post Category -->
       <label for='categories'>Categories</label>
         <select title='Select Category' class='form-control' >
           <option value='$postCategories'>$postCategories</option>
           <?php getPostCategories(); ?>
         </select>
     </div>
     <div class='col-md-6'>
       <img src='uploads/$postImage' width='70' height='60' /> <br>
       <!-- Publish Posts Or Not -->
       <label for='status'>Status</label>
       <select title='Select Post Status' class='form-control'  required>
         <option value='$postStatus'>$postStatus</option>
         <option value='draft'>Save To Draft</option>
       </select>
     </div>
     <div class='col-md-12'>
       <!-- Post Body -->
       <label for='body'></label> 
       <textarea class='form-control' name='editBody' placeholder='Enter Your Blog Post' cols='30' rows='10' required>$postBody</textarea>
     </div>
     
     
     <div class='col-md-6 col-md-offset-3'> &nbsp;
         <button name='btnEditPost' type='submit' class='btn btn-primary btn-block'>Edit Post</button>
       </div>
     </form>
    ";
}

// Edit Post
function editPostContent($editPostContentId, $postTitle, $postBody) {
  global $conn;
   if (empty($postTitle) || empty($postBody)) {
    header("location: posts.php?source=viewPost");
   } else {
     // change to Sentence case 
     $postTitle = strtolower($postTitle);
     $postTitle = ucwords($postTitle);
    //  edit Post Content
    $editPostContent = mysqli_query($conn, "UPDATE posts SET title = '$postTitle', body = '$postBody' WHERE id = '$editPostContentId'");
    if ($editPostContent) {
      header("location: posts.php?source=viewPost&edited"); 
    }
   }
}

// Unapprove Post by setting status to draft
function unApprovePost($unApproveId) {
  global $conn;
  $unApproveId = mysqli_query($conn, "UPDATE posts SET status = 'draft' WHERE id = '$unApproveId'");
  if ($unApproveId) {
    header("location: posts.php?source=viewPost&unApprovedDone"); 
  }
}
// Unapprove Post by setting status to draft
function approvepost($approveId) {
  global $conn;
  $approveId = mysqli_query($conn, "UPDATE posts SET status = 'publish' WHERE id = '$approveId'");
  if ($approveId) {
    header("location: posts.php?source=viewPost&approvedDone"); 
  }
}
// Delete Post Function 
function deletePost($deletePostId) {
  global $conn;
    $deletePostId = mysqli_query($conn, "DELETE FROM posts WHERE id = '$deletePostId'");
    if ($deletePostId) {
      header("location: posts.php?source=viewPost&deleteDone"); 
    }
}

// ####################################################################################
// #                Users Functions Logic                                              #
// ####################################################################################

function userCategories()  {
  global $conn;
  $getCategories = mysqli_query($conn, "SELECT * FROM categories");
  while ($row = mysqli_fetch_assoc($getCategories)) {
    $catId = $row['cat_id'];
    $catName = $row['cat_name'];
    // Show categories details
    echo "
    <li class='nav-item'>
    <a class='nav-link active' href='/blog?cate=$catName'>$catName</a>
    </li>
  ";
  }
}

// Display Post To Users

function displayPost()  {
  global $conn;
  $getAllPosts = mysqli_query($conn, "SELECT * FROM posts WHERE status = 'publish' ORDER BY id DESC");
  while ($postsRow = mysqli_fetch_assoc($getAllPosts)) {
    $postId = $postsRow['id'];
    $postTitle = $postsRow['title'];
    $postCategories = $postsRow['category'];
    $postViews = $postsRow['views'];
    $postBody = $postsRow['body'];
    $postStatus = $postsRow['status'];
    $postImage = $postsRow['image'];
    $postAuthor = $postsRow['author'];
    $postCreatedAt = $postsRow['created_at'];
    
    ?>
    <div class="col-md-6">
      <a href='blog-single.php?blogId=<?php echo $postId; ?>&category=<?php echo $postCategories; ?>' class='blog-entry element-animate' data-animate-effect='fadeIn'>
        <img src='admin/uploads/<?php echo $postImage; ?>' alt='Image placeholder'>
        <div class='blog-content-body'>
          <div class='post-meta'>
            <span class='author mr-2'><img src='images/person_1.jpg' alt='Colorlib'> <?php echo $postAuthor; ?></span>&bullet;
            <span class='mr-2'><?php echo $postCreatedAt; ?> </span> &bullet;
            <span class='ml-2'><span class='fa fa-comments'></span> <?php echo $postViews; ?></span>
          </div>
          <h3><?php echo $postTitle; ?></h3>
          <p><?php echo substr($postBody, 0, 50);  if(strlen($postBody) > 50){echo "...";} ?></p>
        </div>
      </a>
     </div>
    <?php 
  }
}

// Display Recent Post
function recentPost()  {
  global $conn;
  $getAllPosts = mysqli_query($conn, "SELECT * FROM posts WHERE status = 'publish' ORDER BY id DESC LIMIT 5");
  while ($postsRow = mysqli_fetch_assoc($getAllPosts)) {
    $postId = $postsRow['id'];
    $postTitle = $postsRow['title'];
    $postCategories = $postsRow['category'];
    $postViews = $postsRow['views'];
    $postBody = $postsRow['body'];
    $postStatus = $postsRow['status'];
    $postImage = $postsRow['image'];
    $postAuthor = $postsRow['author'];
    $postCreatedAt = $postsRow['created_at'];
    
    ?>
    <li>
      <a href="blog-single.php?blogId=<?php echo $postId; ?>&category=<?php echo $postCategories; ?>">
        <img src="admin/uploads/<?php echo $postImage; ?>" alt="Image placeholder" class="mr-4">
        <div class="text">
          <h4><?php echo $postTitle; ?></h4>
          <div class="post-meta">
            <span class="mr-2"><?php echo $postCreatedAt; ?></span>
          </div>
        </div>
      </a>
    </li>
    <?php 
  }
}

// Get Post Based of ID
function fullPost($blogId)  {
  global $conn;
  $getSinglePost = mysqli_query($conn, "SELECT * FROM posts WHERE status = 'publish' AND id = '$blogId'");
  $postsRow = mysqli_fetch_assoc($getSinglePost);
    $postId = $postsRow['id'];
    $postTitle = $postsRow['title'];
    $postCategories = $postsRow['category'];
    $postViews = $postsRow['views'];
    $postBody = $postsRow['body'];
    $postStatus = $postsRow['status'];
    $postImage = $postsRow['image'];
    $postAuthor = $postsRow['author'];
    $postCreatedAt = $postsRow['created_at'];
    
    ?>
    <img src="admin/uploads/<?php echo $postImage; ?>" alt="Image" class="img-fluid mb-5">
    <div class="post-meta">
      <span class="author mr-2"><img src="images/person_1.jpg" alt="Colorlib" class="mr-2"> Colorlib</span>&bullet;
      <span class="mr-2"><?php echo $postCreatedAt; ?> </span> &bullet;
      <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
    </div>
    <h1 class="mb-4">
        
    <?php echo $postTitle; ?></h1>
    <a class="category mb-5" href="blog-single.php?blogId=<?php echo $postId; ?>&category=<?php echo $postCategories; ?>"><?php echo $postCategories; ?></a>
    <div class="post-content-body">
      <p><?php echo $postBody; ?></p>
    
    </div>
    <?php 
}


// Display Post To Users

function relatedPost($postCategory, $blogId)  {
  global $conn;
  $getRelatedPosts = mysqli_query($conn, "SELECT * FROM posts WHERE status = 'publish' AND category = '$postCategory' AND id != '$blogId' ORDER BY id DESC");
  while ($postsRelated = mysqli_fetch_assoc($getRelatedPosts)) {
    $postId = $postsRelated['id'];
    $postTitle = $postsRelated['title'];
    $postCategories = $postsRelated['category'];
    $postViews = $postsRelated['views'];
    $postBody = $postsRelated['body'];
    $postStatus = $postsRelated['status'];
    $postImage = $postsRelated['image'];
    $postAuthor = $postsRelated['author'];
    $postCreatedAt = $postsRelated['created_at'];
    ?>
    <div class="col-md-6 col-lg-4">
      <a href="blog-single.php?blogId=<?php echo $postId; ?>&category=<?php echo $postCategories; ?>" class="a-block sm d-flex align-items-center height-md" style="background-image: url('admin/uploads/<?php echo $postImage; ?>'); ">
        <div class="text">
          <div class="post-meta">
            <span class="category"><?php echo $postCategories; ?></span>
            <span class="mr-2"><?php echo $postCreatedAt; ?> </span> &bullet;
            <span class="ml-2"><span class="fa fa-comments"></span><?php echo $postViews; ?></span>
          </div>
          <h3><?php echo $postTitle; ?></h3>
        </div>
      </a>
    </div>
    <?php 
  }
}

// Display Post To Users

function relatedPosts($postCategory, $blogId)  {
  global $conn;
  $getRelatedPosts = mysqli_query($conn, "SELECT * FROM posts WHERE status = 'publish' AND category = '$postCategory' AND id != '$blogId' ORDER BY id DESC");
  while ($postsRelated = mysqli_fetch_assoc($getRelatedPosts)) {
    $postId = $postsRelated['id'];
    $postTitle = $postsRelated['title'];
    $postCategories = $postsRelated['category'];
    $postViews = $postsRelated['views'];
    $postBody = $postsRelated['body'];
    $postStatus = $postsRelated['status'];
    $postImage = $postsRelated['image'];
    $postAuthor = $postsRelated['author'];
    $postCreatedAt = $postsRelated['created_at'];
    ?>
    <li>
      <a href="blog-single.php?blogId=<?php echo $postId; ?>&category=<?php echo $postCategories; ?>">
    
        <img src="admin/uploads/<?php echo $postImage; ?>" alt="Image placeholder" class="mr-4">
        <div class="text">
          <h4><?php echo $postTitle; ?></h4>
          <div class="post-meta">
            <span class="mr-2"><?php echo $postCreatedAt; ?> </span> &bullet;
            <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
          </div>
        </div>
      </a>
    </li>
    <?php 
  }
}


function catPostDisplay($cate)  {
  global $conn;
  $catPostDisplay = mysqli_query($conn, "SELECT * FROM posts WHERE status = 'publish' AND category = '$cate' ORDER BY id DESC");
  while ($catPosts = mysqli_fetch_assoc($catPostDisplay)) {
    $postId = $catPosts['id'];
    $postTitle = $catPosts['title'];
    $postCategories = $catPosts['category'];
    $postViews = $catPosts['views'];
    $postBody = $catPosts['body'];
    $postStatus = $catPosts['status'];
    $postImage = $catPosts['image'];
    $postAuthor = $catPosts['author'];
    $postCreatedAt = $catPosts['created_at'];
    
    ?>
    <div class="col-md-6">
      <a href='blog-single.php?blogId=<?php echo $postId; ?>&category=<?php echo $postCategories; ?>' class='blog-entry element-animate' data-animate-effect='fadeIn'>
        <img src='admin/uploads/<?php echo $postImage; ?>' alt='Image placeholder'>
        <div class='blog-content-body'>
          <div class='post-meta'>
            <span class='author mr-2'><img src='images/person_1.jpg' alt='Colorlib'> <?php echo $postAuthor; ?></span>&bullet;
            <span class='mr-2'><?php echo $postCreatedAt; ?> </span> &bullet;
            <span class='ml-2'><span class='fa fa-comments'></span> <?php echo $postViews; ?></span>
          </div>
          <h3><?php echo $postTitle; ?></h3>
          <p><?php echo substr($postBody, 0, 50);  if(strlen($postBody) > 50){echo "...";} ?></p>
        </div>
      </a>
     </div>
    <?php 
  }
}

// searched function 
function searched($searched)  {
  global $conn;
  $searchedPost = mysqli_query($conn, "SELECT * FROM posts WHERE status = 'publish' AND body LIKE '%$searched%' ");
  while ($catPosts = mysqli_fetch_assoc($searchedPost)) {
    $postId = $catPosts['id'];
    $postTitle = $catPosts['title'];
    $postCategories = $catPosts['category'];
    $postViews = $catPosts['views'];
    $postBody = $catPosts['body'];
    $postStatus = $catPosts['status'];
    $postImage = $catPosts['image'];
    $postAuthor = $catPosts['author'];
    $postCreatedAt = $catPosts['created_at'];
    
    ?>

   <div class="col-md-6">
      <a href='blog-single.php?blogId=<?php echo $postId; ?>&category=<?php echo $postCategories; ?>' class='blog-entry element-animate' data-animate-effect='fadeIn'>
        <img src='admin/uploads/<?php echo $postImage; ?>' alt='Image placeholder'>
        <div class='blog-content-body'>
          <div class='post-meta'>
            <span class='author mr-2'><img src='images/person_1.jpg' alt='Colorlib'> <?php echo $postAuthor; ?></span>&bullet;
            <span class='mr-2'><?php echo $postCreatedAt; ?> </span> &bullet;
            <span class='ml-2'><span class='fa fa-comments'></span> <?php echo $postViews; ?></span>
          </div>
          <h3><?php echo $postTitle; ?></h3>
          <p><?php echo substr($postBody, 0, 50);  if(strlen($postBody) > 50){echo "...";} ?></p>
        </div>
      </a>
     </div>
    <?php 
  }
}

// Get all comments 

function getComments($blogId) {
  global $conn;
  $getAllComment = mysqli_query($conn, "SELECT * FROM comments WHERE status = 'approve' AND post_id = '$blogId'");
  while ($comments = mysqli_fetch_assoc($getAllComment)) {
    $name = $comments['name'];
    $message = $comments['message'];
    $countComment = mysqli_num_rows($getAllComment);
    ?>
      <li class="comment">
        <div class="vcard">
          <img src="images/person_1.jpg" alt="Image placeholder">
        </div>
        <div class="comment-body">
          <h3><?php echo $name; ?></h3>
          <p><?php echo $message; ?></p>
          <p><a href="#" class="reply rounded">Reply</a></p>
        </div>
      </li>
    <?php
  }
}

// Get all comments

function getAllComments() {
  global $conn;
  $getComment = mysqli_query($conn, "SELECT * FROM comments ORDER BY id DESC");
  while ($getComments = mysqli_fetch_assoc($getComment)) {
    $commentId = $getComments['id'];
    $commentName = $getComments['name'];
    $commentMessage = $getComments['message'];
    $commentStatus = $getComments['status'];
    ?>
    <tr>
      <td><?php echo $commentName; ?></td>
      <td><?php echo $commentMessage; ?></td>
      <td>
        <?php 
          if (($commentStatus == "pending") || ($commentStatus == "Pending")) {
            echo "<span class='label label-danger'>$commentStatus</span>";
          } else {
            echo "<span class='label label-success'>$commentStatus</span>";
          }
        ?>
      </td>

      <td>
        <a href='comment.php?view&delComment=<?php echo $commentId; ?>' class='btn btn-danger btn-sm'>Delete</a>
      </td>
      <td>
        <?php
          if ($commentStatus == "pending") {
            echo "
              <a href='comment.php?view&approveComment=$commentId' class='btn btn-success btn-sm'>Approve</a>
            ";
          } else {
            echo "
              <a href='comment.php?view&unApprComment=$commentId' class='btn btn-info btn-sm'>Unapprove</a>
            ";
          }
        ?>
      </td>
    </tr>
    <?php
  }
}

// get all users
function getAllUsers() {
  global $conn;
  $getComment = mysqli_query($conn, "SELECT * FROM users ORDER BY id DESC");
  while ($getUser = mysqli_fetch_assoc($getComment)) {
    $user_id = $getUser['id'];
    $username = $getUser['username'];
    $email = $getUser['email'];
    $phone = $getUser['phone'];
    $role = $getUser['role'];
    ?>
    <tr>
      <td><?php echo $username; ?></td>
      <td><?php echo $email; ?></td>
      <td><?php echo $phone; ?></td>
      <td><span class='label label-info'><?php echo $role; ?></span> </td>
      <td>
        <a href="?source=view_users&delUser=<?php echo $email; ?>" class="btn btn-danger btn-sm">Delete</a>
      
        <?php 
          if ($role == "Guest") {
            echo "<a href='?source=view_users&appr=$email' class='btn btn-success btn-sm'>Approve</a>";
          } else {
            echo "<a href='?source=view_users&unAppr=$email' class='btn btn-info btn-sm'>Unapprove</a>";
          }
        ?>
      </td>

    </tr>
    <?php
  }
}

// Approve, delete and un approve comment

function updateComment($request, $commentId) {
  global $conn;
  $updateComment = mysqli_query($conn, "UPDATE comments SET status = '$request' WHERE id = '$commentId'");
  if ($updateComment) {
    header("location: comment.php?view&updated");
  }
}

// Registeration

function registerUser($username, $email, $phone, $password, $passwordAgain) {
  global $conn;
  if (empty($username) || empty($email) || empty($phone) || empty($password) || empty($passwordAgain)) {
    header("location: cms-admin.php?emptyFields");
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("location: cms-admin.php?invalidEmail");
  } else if (is_numeric($username)) {
    header("location: cms-admin.php?numeric");
  } else if ($password != $passwordAgain) {
    header("location: cms-admin.php?incorrectPassword");
  } else if (strlen($password) < 6) {
    header("location: cms-admin.php?shortPassword");
  } else {
    $checkIfExist = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($checkIfExist) == 0) {
      // Create the user
       $password = password_hash($password, PASSWORD_DEFAULT);
      $createNewUser = mysqli_query($conn, "INSERT INTO users (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$password')");
      if ($createNewUser) {
        header("location: cms-admin.php?successUser");
      }
    }
  }
  
}

function addUser($username, $email, $phone, $password, $passwordAgain) {
  global $conn;
  if (empty($username) || empty($email) || empty($phone) || empty($password) || empty($passwordAgain)) {
    header("location: cms-admin.php?emptyFields");
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("location: ?invalidEmail");
  } else if (is_numeric($username)) {
    header("location: ?numeric");
  } else if ($password != $passwordAgain) {
    header("location: ?incorrectPassword");
  } else if (strlen($password) < 6) {
    header("location: ?shortPassword");
  } else {
    $checkIfExist = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
    if (mysqli_num_rows($checkIfExist) == 0) {
      // Create the user
       $password = password_hash($password, PASSWORD_DEFAULT);
       $role = "Admin";
      $createNewUser = mysqli_query($conn, "INSERT INTO users (username, email, phone, password) VALUES ('$username', '$email', '$phone', '$password')");
      if ($createNewUser) {
        mysqli_query($conn, "UPDATE users SET role = '$role' WHERE email = '$email'");
        header("location: ?source=view_users&successUser");
      }
    }
  }
  
}

// Update users profile
function updateProfile($profName, $profPhone) {
  global $conn;
  $updateUser = mysqli_query($conn, "UPDATE users SET username = '$profName', phone = '$profPhone'");
  if ($updateUser) {
    header("location: profile.php?updated");
  }
}

// Delete user function 
function delUser($userDelEmail) {
  global $conn;
  $deleteUser = mysqli_query($conn, "DELETE FROM users WHERE email = '$userDelEmail'");
  if ($deleteUser) {
    header("location: users.php?source=view_users&deletedUser");
  }
}