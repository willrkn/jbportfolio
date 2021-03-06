<?php
// start login session
  session_start();
?>

<!DOCTYPE html>

<head>
  <title>Home | Jess Bolam Art</title>
  <link rel="shortcut icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" type="text/css" href="animation.css">
  <script src="overlay.js"></script>
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
          <img src="images\titles\animation.png" alt="Animation"/ />
      </div>
    <!-- UPLOAD -->
    <?php
    // check if logged in
    if(isset($_SESSION['username'])){
      echo '<div class="image-upload">
        <form action="includes/animation-upload.php" method="post" enctype="multipart/form-data">
          <input type="text" name="title" placeholder="post title.."/>
          <input type="file" name="previewfile"/>
          <input type="text" name="previewfilename" placeholder="preview file name..."/>
          <input type="text" name="previewfiledesc" placeholder="Preview rollover caption.."/>
          <input type="file" name="popupfile"/>
          <input type="text" name="popupfilename" placeholder="popup file name..."/>
          <input type="text" name="popupfiledesc" placeholder="Long popup project description.."/>
          <button type="submit" name="submit">UPLOAD</button>
        </form>
      </div>';
    }
    ?>
<!-- Work Portfolio Grid -->
    <div class="row">
<!-- Column 1 -->
      <div class="column">



        <?php
        include_once 'includes/dbh.php';
        $sql = "SELECT * FROM animation ORDER BY imageOrder + 0 DESC;";
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
                <img src="images/media/'.$row["previewFileName"].'" />
                <div class="text">
                  '.$row["previewFileDesc"].'
                </div>
              </div>
            ';
          }
        }
        ?>




        <div class="image">
          <img src="images\AnimationDesign\marks-cover.png" alt="St Mark's Meals MK"/>
          <div class="imagetitle">
            <h2>Project 5</h2>
          </div>
          <div class="text">
            I worked as a clean-up artist for Rocket Cow on a video for St Mark’s Meals MK, a charity providing meal kits to families in need.
          </div>
        </div>
      </div>
<!-- Column 2 -->
      <div class="column">
        <div class="image">
          <img src="images\AnimationDesign\frosts-cover.png" alt="Frosts"/>
          <div class="imagetitle">
            <h2>Project 2</h2>
          </div>
          <div class="text">
            In 2019, I had the opportunity to work as a background painter on Frost’s ‘Elf Academy’ Christmas advert. This video currently has over 22,000 views to date.”
          </div>
        </div>
        <div class="image">
          <img src="images\AnimationDesign\bpha-cover.png" alt="BPHA"/>
          <div class="imagetitle">
            <h2>Project 6</h2>
          </div>
          <div class="text">
            My first freelance project was a ‘Help to Buy’ video for BPHA, working as the production design and background artist for Wise Guys.
          </div>
        </div>
      </div>
<!-- Column 3 -->
      <div class="column">
        <div class="image">
          <img src="images\AnimationDesign\wickes-cover.png" alt="Hitchhikers guide to the galaxy cover mockup"/>
          <div class="imagetitle">
            <h2>Project 3</h2>
          </div>
          <div class="text">
            I have worked as a background artist on two informational videos for Wickes, in 2018 and 2019.
          </div>
        </div>
        <div class="image">
          <img src="images\AnimationDesign\onion-cover.jpg" alt="Whispering Onion Cover"/>
          <div class="imagetitle">
            <h2>Project 7</h2>
          </div>
          <div class="text">
            During my final year of university, I co-directed and co-produced ‘Whispering Onion’, a surrealist short film. I was also the production designer and lead background artist on the film. ‘Whispering Onion’ has gone on to screen at festivals including ANIMAKOM Festival, Zlin Film Festival and the KuanDu International Animation Festival, winning the ‘President of the Jury’ award at the Early Bird International Student Film Festival.
          </div>
        </div>
      </div>
<!-- Column 4 -->
    <div class="column">
      <div class="image">
        <img src="images\AnimationDesign\wickes-cover.png" alt="Hitchhikers guide to the galaxy cover mockup"/>
        <div class="imagetitle">
          <h2>Project 4</h2>
        </div>
        <div class="text">
          I have worked as a background artist on two informational videos for Wickes, in 2018 and 2019.
          <button onclick="on()">View Info</button>
        </div>
      </div>
      <div class="image">
        <img src="images\AnimationDesign\onion-cover.jpg" alt="Whispering Onion Cover"/>
        <div class="imagetitle">
          <h2>Project 8</h2>
        </div>
        <div class="text">
          During my final year of university, I co-directed and co-produced ‘Whispering Onion’, a surrealist short film. I was also the production designer and lead background artist on the film. ‘Whispering Onion’ has gone on to screen at festivals including ANIMAKOM Festival, Zlin Film Festival and the KuanDu International Animation Festival, winning the ‘President of the Jury’ award at the Early Bird International Student Film Festival.
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
    <a href="mailto:jess.bolam@hotmail.co.uk" target="_top">jess.bolam@hotmail.co.uk</a>  |  animation artist and illustrator  |  Buckinghamshire, UK
    <div>
      Website made by <a href="http://github.com/willrkn">willrkn</a>
    </div>
  </footer>
</body>

<div id="overlay" onclick="off()">
  <div id="info">
    This is where the project info will be
    <img src="images\AnimationDesign\onion-cover.jpg" alt="Whispering Onion Cover"/>
  </div>
</div>
