<?php

if(isset($_POST['submit'])){
  $newFileName = $_POST['filename'];
  if (empty($newFileName)){
    $newFileName = 'commision';
  } else{
    // replace spaces in filename with dashes and also make all lowercase
    $newFileName = strtolower(str_replace(" ", "-", $newFileName));
  }

  $imageTitle = $_POST['filetitle'];
  $imageDesc = $_POST['filedesc'];

  $file = $_FILES['file'];

  $fileName = $file['name'];
  $fileType = $file['type'];
  $fileTemp = $file['tmp_name'];
  $fileError = $file['error'];
  $fileSize = $file['size'];

  // file types
  // get extension
  $fileExt = explode(".", $fileName);
  $fileActExt = strtolower(end($fileExt));
  // types allowed
  $allowed = array("jpg", "jpeg", "png");

// TODO: ADD COMPRESSION

  if(in_array($fileActExt, $allowed)){
    if($fileError == 0){
      // max file size in kb
      if($fileSize < 20000000){
        // create new file name with unique ID
        $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileActExt;
        $fileDest = "../commisions/" . $imageFullName;
        // database connection
        include_once "dbh.php";
        if(empty($imageTitle) || empty($imageDesc)){
          header("Location: ../index.php?upload=empty");
          exit();
        } else{
          $sql = "SELECT * FROM gallery;";
          // grab prepared statement
          $stmt = mysqli_stmt_init($conn);
          if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "SQL statement failed";
          } else{
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            // get row count
            $rowCount = mysqli_num_rows($result);
            $setImageOrder = $rowCount + 1;
            // insert
            $sql = "INSERT INTO gallery (title, description, fileName, imageOrder) VALUES (?, ?, ?, ?);";
            if(!mysqli_stmt_prepare($stmt, $sql)){
              echo "SQL statement failed";
            } else{
              mysqli_stmt_bind_param($stmt, "ssss", $imageTitle, $imageDesc, $imageFullName, $setImageOrder);
              mysqli_stmt_execute($stmt);
              // upload image
              move_uploaded_file($fileTemp, $fileDest);

              header("Location: ../index.php?upload=success");
            }
          }
        }
      } else{
        echo "The file size is too big. Max size: 20MB";
        exit();
      }
    } else{
      echo "Unexpected Error";
      exit();
    }
  } else{
    echo "Only .jpg .jpeg and .png files allowed.";
    exit();
  }
}
