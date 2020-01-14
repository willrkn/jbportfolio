<!DOCTYPE html>

<head>
  <title>Contact | Jess Bolam Art</title>
  <link rel="shortcut icon" type="image/png" href="icons/favicon.png">
  <link rel="stylesheet" type="text/css" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<!-- Banner Image: not header as needs to be size of window-->
  <div class="banner-image"></div>
  <!-- Nav Bar -->
      <ul class="nav">
        <li><a href="index.php" class="active">Home</a></li>
        <li><a href="art.html">Art & Illustration</a></li>
        <li><a href="animation.html">Animation Design</a></li>
        <li class="active"><a href="contact.html">Contact</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="cv.html">CV</a></li>
      </ul>
  <main>
    <h1>Contributor Login</h1>
<!-- Contact Form -->

    <div class = "form">
      <!-- Login -->
      <form method="post" action="includes/login.php">
        <label for="mailuid">Your name: *</label>
        <input type="text" name="mailuid" placeholder="Username/Email.." />
        <label for="pwd">Your password: *</label>
        <input type="password" name="pwd" placeholder="Password.." />
        <button type="submit" name="login-submit">LOGIN</button>
      </form>
      <a href="signup.php">Add a new user</a>
      <form action="includes/logout.php" method="post">
        <button type="submit" name="logout-submit">Logout</button>
      </form>
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
