<?php
// start login session
  session_start();
?>

<!DOCTYPE html>

<head>
  <title>Home | Jess Bolam Art</title>
  <link rel="shortcut icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" type="text/css" href="homepage.css">
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
    <!-- New HomePage Design -->
    <div class="row">
      <div class="column">
        <div class="showcase">
          <img src="images\titles\latest-project.png" alt="Latest Project"/>
          <?php
          include_once 'includes/dbh.php';
          $sql = "SELECT * FROM projects ORDER BY imageOrder DESC LIMIT 1;";
          $stmt = mysqli_stmt_init($conn);
          if(!mysqli_stmt_prepare($stmt, $sql)){
            echo "SQL statement failed";
          } else{
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            // loop
            while($row = mysqli_fetch_assoc($result)){
              echo '
                <img src="images/media/'.$row["fileName"].'" />
                <h2>'.$row['title'].'</h2>
                <p>'.$row["description"].'</p>
                ';
            }
          }
          ?>
          <?php
          // check if logged in
          if(isset($_SESSION['username'])){
            echo '<div class="projects-upload">
              <form action="includes/latest-project-upload.php" method="post" enctype="multipart/form-data">
                <input type="text" name="filename" placeholder="file name.."/>
                <input type="text" name="filetitle" placeholder="image title.."/>
                <input type="text" name="filedesc" placeholder="image caption.."/>
                <input type="file" name="file"/>
                <button type="submit" name="submit">UPLOAD</button>
              </form>
            </div>';
          }
          ?>
        </div>
      </div>
      <div class="column" style="background-color: #F7EAB3;
      border-radius: 40px;">
        <div class="title">
          <img src="images\Portrait.png" alt="Portrait"/>
          <p>
            I am a quirky animation artist and illustrator from the UK, with a passion for colour and storytelling. I mainly work digitally, and aim to communicate story and emotion in every piece I create. I am a self employed freelance artist, allowing me to work with a number of varied and exciting clients!
          </p>
        </div>
        <div class="row">
          <div class="column">
            <h2>Commissions</h2>
              <?php
              include_once 'includes/dbh.php';
              $sql = "SELECT * FROM homepage_commissions ORDER BY imageOrder DESC LIMIT 3;";
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
            <h2>
              <a href="contact.html">Click Here For Your Own Commission! >></a>
            </h2>

            <!-- UPLOAD -->
            <?php
            // check if logged in
            if(isset($_SESSION['username'])){
              echo '<div class="image-upload">
                <form action="includes/homepage-commissions-upload.php" method="post" enctype="multipart/form-data">
                  <input type="text" name="filename" placeholder="file name.."/>
                  <input type="text" name="filetitle" placeholder="image title.."/>
                  <input type="text" name="filedesc" placeholder="image caption.."/>
                  <input type="file" name="file"/>
                  <button type="submit" name="submit">UPLOAD</button>
                </form>
              </div>';
            }
            ?>

          </div>
          <div class="column">
            <h2>Instagram</h2>
            <script src="https://apps.elfsight.com/p/platform.js" defer></script>
            <div class="elfsight-app-97fbd8d1-bb99-4564-b9f2-9cf96950b8c4">Instagram Feed</div>
          </div>
        </div>
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
    <a href="mailto:jess.bolam@hotmail.co.uk" target="_top">jess.bolam@hotmail.co.uk</a>  |  <a href="login.php">animation artist and illustrator</a>  |  Buckinghamshire, UK
    <div>
      Website made by <a href="http://github.com/willrkn">willrkn</a>
    </div>
  </footer>
  </body>
