<?php 
  include 'includes/header.php';
  include 'admin/config/callFn.php';
         
  $checkIfAdminExist = mysqli_query($conn, "SELECT * FROM users");
  
  if (mysqli_num_rows($checkIfAdminExist) == 0) {
    include 'registerUser.php';
  } else {
    include 'login.php';
  }