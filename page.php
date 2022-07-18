<?php 
session_start();
if(!isset($_SESSION['login-success'])){ header("location: index.php"); }

$time_add = $_SESSION['login-success'][0];
$time_update = $_SESSION['login-success'][1];
$code = $_SESSION['login-success'][2];
$email = $_SESSION['login-success'][3];
$name = $_SESSION['login-success'][4];
$article = $_SESSION['login-success'][5];
?>
<!DOCTYPE html>
<html>
<head>
  <title>International Conference</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
</head>
<body>
  <section class="jumbotron">
    <div class="container">
      <form id="page-form" method="POST" action="gate_update.php">
        <h2>Complate Your Data</h2>
        <small>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officia, id. Lorem ipsum dolor sit amet consectetur adipisicing elit. In nostrum aspernatur corrupti, tenetur sequi harum id, fuga voluptatem accusamus consequuntur, omnis sit eius dolor est perferendis! Deserunt atque commodi dolorem.</small>
        
        <?php if(isset($_SESSION['update-success'])){ ?>
            <small id="alert-success">
              <i class="fa fa-check-circle"></i><?= $_SESSION['update-success'] ?>
            </small>
          <?php } unset($_SESSION['update-success']) ?>
          
          <?php if(isset($_SESSION['update-error'])){ ?>
            <small id="alert-error">
              <i class="fa fa-exclamation-circle"></i><?= $_SESSION['update-error'] ?>
            </small>
          <?php } unset($_SESSION['update-error']) ?>
        
        <ul>
          <input type="hidden" name="code" value="<?= $code ?>">
          <li>
            <input disabled value="<?= $email ?>">
            <label>Email</label>
          </li>
          <li>
            <input type="text" name="name" id="name" placeholder="your name" value="<?= $name ?>">
            <label for="name">Full Name</label>
          </li>
          <li class="text-box">
            <textarea name="article" id="article" placeholder="Send your article"><?= $article ?></textarea>
            <label for="article">Article</label>
          </li>
          <li>
            <a href="gate_logout.php">Log out</a>
            <button type="submit">Update Your Data</button>
          </li>
        </ul>
      </form>
    </div>
  </section>
  <section class="footer">
    <p>Copyright 2022 by b1deyesa. All Rights Reserved</p>
  </section>

  <video src="img/video.mp4" muted autoplay loop></video>
</body>
</html>