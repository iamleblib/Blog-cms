<?php 
// connect to database 
include 'dbh.php';
// Process Creating Category
if (isset($_POST['cat_add'])) {
  $catName = mysqli_real_escape_string($conn, $_POST['cat_name']);
  addCategories($catName);
}

// Edit Category
if (isset($_GET['editCatId'])) {
  $catEditId = $_GET['editCatId'];
   editCategories($catEditId);

  // edit category
  if (isset($_GET['editCatId'])) {
    // get cat id
    $catId = $_GET['editCatId'];
    // use id to edit category
    if (isset($_POST['cat_edit'])) {
      $catEdit = mysqli_real_escape_string($conn, $_POST['cat_name']);
     editCat($catEdit, $catId);
   }
  }
}

// Delete Category
if (isset($_GET['deleteCatId'])) {
  $catId = $_GET['deleteCatId'];
  deleteCategory($catId);
}

if (isset($_POST['btnAddPost'])) {
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $categories = mysqli_real_escape_string($conn, $_POST['categories']);
  $file = $_FILES['file'];
  $status = mysqli_real_escape_string($conn, $_POST['status']);
  $body = mysqli_real_escape_string($conn, $_POST['body']);
  createPost($title, $categories, $file, $status, $body);
}

// edit Post 
if (isset($_GET['editId'])) {
  $editPostContentId = $_GET['editId'];
  if (isset($_POST['btnEditPost'])) {
     $postTitle = mysqli_real_escape_string($conn, $_POST['editTitle']);
     $postBody = mysqli_real_escape_string($conn, $_POST['editBody']);
     editPostContent($editPostContentId, $postTitle, $postBody);
  }
}

// Unapprove Post
if (isset($_GET['unApproveId'])) {
   $unApproveId = $_GET['unApproveId'];
unApprovePost($unApproveId);
}
// Approve Post
if (isset($_GET['approveId'])) {
  $approveId = $_GET['approveId'];
  approvepost($approveId);
}
// Delete Post
if (isset($_GET['deletePostId'])) {
  $deletePostId = $_GET['deletePostId'];
  deletePost($deletePostId);
}

// Query Post
$getAllPost = mysqli_query($conn, "SELECT * FROM posts");
// Query Categories
$getAllCategories = mysqli_query($conn, "SELECT * FROM posts");

// Get Related Post
if (isset($_GET['blogId'])) {
   $blogId = $_GET['blogId'];
   $postCategory = $_GET['category'];

   if (isset($_POST['addComment'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    
    if (empty($name) || empty($message)) {
      header("location: blog-single.php?blogId=$blogId&category=$postCategory&emptyFields#comment");
    } else {
      $addComment = mysqli_query($conn, "INSERT INTO comments (post_id, name, message) VALUES ('$blogId', '$name', '$message') ");
      header("location: blog-single.php?blogId=$blogId&category=$category&commentSuccess#commentAdded");
    }
  }
}


// handle comment actions

		if (isset($_GET['unApprComment'])) {
			$commentId = $_GET['unApprComment'];
			$request = "pending";
			updateComment($request, $commentId);
		} else if (isset($_GET['approveComment'])) {
			$commentId = $_GET['approveComment'];
			$request = "Approve";
			updateComment($request, $commentId);
    }
    
    // end handling comment action

    // delete comment

    if (isset($_GET['delComment'])) {
      $delComment = $_GET['delComment'];
      $del = mysqli_query($conn, "DELETE FROM comments WHERE id = '$delComment'");
      if (del) {
        header("location: comment.php?view&delSuccess");
      }
    }


    // 

    if (isset($_POST['registerUser'])) {
     $username = $_POST['username'];
     $email = $_POST['email'];
     $phone = $_POST['phone'];
     $password = $_POST['password'];
     $passwordAgain = $_POST['passwordAgain'];
      registerUser($username, $email, $phone, $password, $passwordAgain);
    }
    // add user again from admin side
    if (isset($_POST['addUser'])) {
      $username = $_POST['username'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $password = $_POST['password'];
      $passwordAgain = $_POST['passwordAgain'];
       addUser($username, $email, $phone, $password, $passwordAgain);
     }

    // LOGIN 
    
    if (isset($_POST['loginUser'])) {
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      
      if (empty($email) || empty($password)) {
        header("location: cms-admin.php?emptyFields");
      } else {
        $checkMatch = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
        $dbUser = mysqli_fetch_assoc($checkMatch);
    
        $dbEmail = $dbUser['email'];
        $dbPass = $dbUser['password'];
        
        if (($dbEmail == $email) && password_verify($password, $dbPass)) {
          if (empty($email) || empty($password)) {
            header("location: cms-admin.php?emptyFields");
          } else {
            $checkMatch = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
            $dbUser = mysqli_fetch_assoc($checkMatch);
        
            $dbEmail = $dbUser['email'];
            $dbPass = $dbUser['password'];
            
            if (($dbEmail == $email) && password_verify($password, $dbPass)) {
              session_start();
              $_SESSION['email'] = $email;
              header("location: admin/");
            } else {
            header("location: cms-admin.php?incorrect");
            }
          }
        } else {
        header("location: cms-admin.php?incorrect");
        }
      }

    }

    // Get All Users
    if (isset($_SESSION['email'])) {
      $email = $_SESSION['email'];
      $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
      $user = mysqli_fetch_assoc($query);
      $username = $user['username'];
      $phone = $user['phone'];
      $role = $user['role'];
  }
    
    
  // update users profile
  if (isset($_POST['updateProfile'])) {
    $profName = mysqli_real_escape_string($conn, $_POST['username']);
    $profPhone = mysqli_real_escape_string($conn, $_POST['phone']);
    updateProfile($profName, $profPhone);
  }

  // Logout user
  if (isset($_GET['logout'])) {
    session_destroy();
    header("location: ../login.php");
  }

  // Delete User
  if (isset($_GET['delUser'])) {
    $userDelEmail = $_GET['delUser'];
    // Delete the user 
    delUser($userDelEmail);
  }

  // change user role

  if (isset($_GET['unAppr'])) {
    $request = $_GET['unAppr'];
    mysqli_query($conn, "UPDATE users SET role = 'Guest' WHERE email = '$request'");
  } else if (isset($_GET['appr'])) {
    $request = $_GET['appr'];
    mysqli_query($conn, "UPDATE users SET role = 'Admin' WHERE email = '$request'");
  }