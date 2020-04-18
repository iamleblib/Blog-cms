<?php

    include 'config/callFn.php';
if (isset($_POST['btnAddPost'])) {
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
        move_uploaded_file($fileTmpName, $fileDestination);
        header("location: posts.php?uploadSuccess");
      } else {
        echo "File too Large";
      }
    } else {
      echo "There was an error uploading your file";
    }
  } else {
    echo "You Cannot Upload Files Of This Type";
  }
}