<?php

if(isset($_POST['submit'])){
  $newPreviewFileName = $_POST['previewfilename'];
  $newPopupFileName = $_POST['popupfilename'];
  if(empty($newPreviewFileName)){
    // @@@@@@@@@@@@@@@@@@@@@@@@@@@
    // FILE NAME
    // @@@@@@@@@@@@@@@@@@@@@@@@@@@
    $newPreviewFileName = 'animation-preview';
  } else if(empty($newPopupFileName)){
    // @@@@@@@@@@@@@@@@@@@@@@@@@@@
    // FILE NAME
    // @@@@@@@@@@@@@@@@@@@@@@@@@@@
    $newPreviewFileName = 'animation-popup';
  } else{
    $newPreviewFileName = strtolower(str_replace(" ", "-", $newPreviewFileName));
    $newPopupFileName = strtolower(str_replace(" ", "-", $newPopupFileName));
  }

  $postTitle = $_POST['title'];
  $previewDesc = $_POST['previewfiledesc'];
  $popupDesc = $_POST['popupfiledesc'];

  $previewFile = $_FILES['previewfile'];
  $popupFile = $_FILES['popupfile'];

  // preview file
  $previewFileName = $previewFile['name'];
  $previewFileType = $previewFile['type'];
  $previewFileTemp = $previewFile['tmp_name'];
  $previewFileError = $previewFile['error'];
  $previewFileSize = $previewFile['size'];

  // popup file
  $popupFileName = $popupFile['name'];
  $popupFileType = $popupFile['type'];
  $popupFileTemp = $popupFile['tmp_name'];
  $popupFileError = $popupFile['error'];
  $popupFileSize = $popupFile['size'];

  // get extension
  $previewFileExt = explode(".", $previewFileName);
  $previewFileActExt = strtolower(end($previewFileExt));
  $popupFileExt = explode(".", $popupFileName);
  $popupFileActExt = strtolower(end($popupFileExt));
  // types allowed
  $allowed = array("jpg", "jpeg", "png");

  // POPUP

  if(in_array($popupFileActExt, $allowed)){
    if($popupFileError == 0){
      // max file size in kb
      if($popupFileSize < 20000000){

        // PREVIEW

        if(in_array($previewFileActExt, $allowed)){
          if($previewFileError == 0){
            // max file size in kb
            if($previewFileSize < 20000000){

              // CODE

              // create new file name with unique ID
              $popupImageFullName = $newPopupFileName . "." . uniqid("", true) . "." . $popupFileActExt;
              $popupFileDest = "../images/media/" . $popupImageFullName;

              $previewImageFullName = $newPreviewFileName . "." . uniqid("", true) . "." . $previewFileActExt;
              $previewFileDest = "../images/media/" . $previewImageFullName;

              // database connection
              include_once "dbh.php";
              if(empty($popupDesc) || empty($previewDesc) || empty($postTitle)){
                header("Location: ../art.php?upload=empty");
                exit();
              } else{
                // @@@@@@@@@@@@@@@@@@@@@@@@@@@
                // SQL SELECT TABLE QUERY
                // @@@@@@@@@@@@@@@@@@@@@@@@@@@
                $sql = "SELECT * FROM animation;";
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
                  // @@@@@@@@@@@@@@@@@@@@@@@@@@@
                  // SQL INSERT TABLE QUERY
                  // @@@@@@@@@@@@@@@@@@@@@@@@@@@
                  $sql = "INSERT INTO animation (title, previewFileDesc, previewFileName, popupFileDesc, popupFileName, imageOrder) VALUES (?, ?, ?, ?);";
                  if(!mysqli_stmt_prepare($stmt, $sql)){
                    echo "SQL statement failed";
                  } else{
                    mysqli_stmt_bind_param($stmt, "ssss", $imageTitle, $previewDesc, $previewImageFullName, $popupDesc, $popupImageFullName, $setImageOrder);
                    mysqli_stmt_execute($stmt);
                    // upload images
                    move_uploaded_file($previewFileTemp, $previewFileDest);
                    move_uploaded_file($popupFileTemp, $popupFileDest);

                    header("Location: ../art.php?upload=success");
                  }
                }
              }

            } else{
              echo "Preview: The file size is too big. Max size: 20MB";
              exit();
            }
          } else{
            echo "Preview: Unexpected Error";
            exit();
          }
        } else{
          echo "Preview: Only .jpg .jpeg and .png files allowed.";
          exit();
        }
      } else{
        echo "Popup: The file size is too big. Max size: 20MB";
        exit();
      }
    } else{
      echo "Popup: Unexpected Error";
      exit();
    }
  } else{
    echo "Popup: Only .jpg .jpeg and .png files allowed.";
    exit();
  }
}
