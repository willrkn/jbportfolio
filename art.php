<?php
// start login session
  session_start();
?>

<!DOCTYPE html>

<head>
  <title>Home | Jess Bolam Art</title>
  <link rel="shortcut icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <?php
    if(isset($_SESSION['username'])){
      echo '<p>If you see this message, you are successfully logged in as a site contributor.</p>';
    }
  ?>
<!-- Banner Image: not header as needs to be size of window-->
  <div class="banner-image"></div>
  <!-- Nav Bar -->
    <ul class="nav">
      <li class="active"><a href="index.php" class="active">Home</a></li>
      <li><a href="art.php">Art & Illustration</a></li>
      <li><a href="animation.php">Animation Design</a></li>
      <li><a href="contact.html">Contact</a></li>
      <li><a href="about.html">About</a></li>
      <li><a href="cv.html">CV</a></li>
    </ul>
  <main>
    <div class="title">
        <img src="images\titles\art-and-illu.png" alt="Art & Illustration"/ >
    </div>
    <!-- UPLOAD -->
    <?php
    // check if logged in
    if(isset($_SESSION['username'])){
      echo '<div class="image-upload">
        <form action="includes/art-and-illu-upload.php" method="post" enctype="multipart/form-data">
          <input type="text" name="filename" placeholder="file name.."/>
          <input type="text" name="filetitle" placeholder="image title.."/>
          <input type="text" name="filedesc" placeholder="image caption.."/>
          <input type="file" name="file"/>
          <button type="submit" name="submit">UPLOAD</button> <p>At the moment, there must be multiples of 3 results for it to work properly, however I will shortly change this.</p>
        </form>
      </div>';
    }
    ?>
<!-- Photo Grid -->
    <div class="row">
<!-- Column 1 -->
      <div class="column">
        <?php
        include_once 'includes/dbh.php';
        $sql = "SELECT * FROM art_and_illu WHERE ((imageOrder + 1) %3 = 1) ORDER BY imageOrder + 0 DESC;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          echo "SQL statement failed";
        } else{
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          // loop
          while($row = mysqli_fetch_assoc($result)){
            echo '
              <div class="image">
                <img src="images/media/'.$row["fileName"].'" />
                <div class="text">
                  '.$row["description"].'
                </div>
              </div>
            ';
          }
        }
        ?>
      </div>
<!-- Column 2 -->
      <div class="column">
        <?php
        include_once 'includes/dbh.php';
        $sql = "SELECT * FROM art_and_illu WHERE ((imageOrder + 2) %3 = 1) ORDER BY imageOrder + 0 DESC;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          echo "SQL statement failed";
        } else{
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          // loop
          while($row = mysqli_fetch_assoc($result)){
            echo '
              <div class="image">
                <img src="images/media/'.$row["fileName"].'" />
                <div class="text">
                  '.$row["description"].'
                </div>
              </div>
            ';
          }
        }
        ?>
      </div>
<!-- Column 3 -->
      <div class="column">
        <?php
        include_once 'includes/dbh.php';
        $sql = "SELECT * FROM art_and_illu WHERE (imageOrder %3 = 1) ORDER BY imageOrder + 0 DESC;";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
          echo "SQL statement failed";
        } else{
          mysqli_stmt_execute($stmt);
          $result = mysqli_stmt_get_result($stmt);
          // loop
          while($row = mysqli_fetch_assoc($result)){
            echo '
              <div class="image">
                <img src="images/media/'.$row["fileName"].'" />
                <div class="text">
                  '.$row["description"].'
                </div>
              </div>
            ';
          }
        }
        ?>
      </div>
    </div>
  </main>
  <footer>
  <!-- Social Media Links -->
    <ul class="social">
      <li><a href="http://instagram.com/jessbolamart"><img border="0" alt="Instagram" src="icons/instagram.png" width="30" height="30"></a></li>
      <li><a href="https://www.facebook.com/jessbolamart/"><img border="0" alt="Facebook" src="icons/facebook.png" width="30" height="30"></a></li>
      <li><a href="https://twitter.com/jessmarybolam"><img border="0" alt="Twitter" src="icons/twitter.png" width="30" height="30"></a></li>
      <li><a href="https://www.pinterest.co.uk/jessbolam/"><img border="0" alt="Pinterest" src="icons/pinterest.png" width="30" height="30"></a></li>
      <li><a href="https://www.linkedin.com/in/jessica-bolam/"><img border="0" alt="LinkedIn" src="icons/linkedin.png" width="30" height="30"></a></li>
    </ul>
    <a href="mailto:jess.bolam@hotmail.co.uk" target="_top">jess.bolam@hotmail.co.uk</a>  |  animation artist and illustrator  |  Buckinghamshire, UK
    <div>
      Website made by <a href="http://github.com/willrkn">willrkn</a>
    </div>
  </footer>
</body>
