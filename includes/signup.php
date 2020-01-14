<?php
// check user did not get to this page manually
if(isset($_POST['signup-submit'])){
  require 'dbh.php';

  $username = $_POST['uid'];
  $email = $_POST['mail'];
  $password = $_POST['pwd'];
  $passwordRepeat = $_POST['pwd-repeat'];

  // ERROR FUNCTIONS

  // Check if empty fields
  if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
    header("Location: ../signup.php?error=emptyfields&uid=".$username."&mail=".$email);
    exit();
  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
    header("Location: ../signup.php?error=invalidmailanduser");
    exit();
    // ensure legal email
  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    header("Location: ../signup.php?error=invalidmail&uid=".$username);
    exit();
    // ensure legal character usage for username
  } else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
    header("Location: ../signup.php?error=invaliduser&mail=".$email);
    exit();
    // Check password fields match
  } else if($password !== $passwordRepeat){
    header("Location: ../signup.php?error=passwordcheck&uid=".$username."&mail=".$email);
    exit();
    // Correct credentials
  } else{
    // SQL INSERT CHECK
    $sql = "SELECT userID FROM users WHERE userID=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
      header("Location: ../signup.php?error=sqlerror");
      exit();
    } else{
      mysqli_stmt_bind_param($stmt, "s", $username);
      mysqli_stmt_execute($stmt);
      // Check user does not already exist
      mysqli_stmt_store_result($stmt);
      $resultCheck = mysqli_stmt_num_rows($stmt);
      if($resultCheck > 0){
        header("Location: ../signup.php?error=userexists&mail=".$email);
        exit();
      } else{
        // placeholders to avoid SQL injection
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          header("Location: ../signup.php?error=sqlerror");
          exit();
        } else{
          // password hashing, PASSWORD_DEFAULT method is updated automatically
          $hashedPass = password_hash($password, PASSWORD_DEFAULT);

          mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPass);
          mysqli_stmt_execute($stmt);
          // Check user does not already exist
          mysqli_stmt_store_result($stmt);
          header("Location: ../signup.php?signup=success");
          exit();
        }
      }
    }
  }
  mysqli_stmt_close($stmt);
  mysqli_close($conn);
} else{
  header("Location: ../signup.php");
  exit();
}
