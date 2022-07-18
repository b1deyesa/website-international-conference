<?php 
session_start();
$_SESSION['url'] = "https://script.google.com/macros/s/AKfycbwuB5G3Ycu8DJ3Uc8GFeZMAwW0eis9f4xO3NCQQu9LzTq9WulzXVpKkBNdojKYLfJJ_4A/exec";
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
      <header>
        <img id="logo" src="img/logo.png">
        <h1 id="title">International Conference 2022</h1>
        <h4 id="topic">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, officia.</h4>
        <div id="time">
          <h2><i class="fa fa-calendar">&nbsp;&nbsp;</i>Monday, 1 March 2023</h2>
          <h2><i class="fa fa-clock">&nbsp;&nbsp;</i>12.00 PM</h2>
        </div>
        <h4 id="countdown">
          <script>
            var countDownDate = new Date("Mar 1, 2023 00:00:00").getTime();
            var x = setInterval(function() {
              var now = new Date().getTime();
              var distance = countDownDate - now;
              var days = Math.floor(distance / (1000 * 60 * 60 * 24));
              var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
              var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
              var seconds = Math.floor((distance % (1000 * 60)) / 1000);
              document.getElementById("countdown").innerHTML =
                "<span>" + days + "<br>days</span>" +
                "<span>" + hours + "<br>hrs</span>" +
                "<span>" + minutes + "<br>min</span>" +
                "<span>" + seconds + "<br>sec</span>";
              if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "Get Started";
              }
            }, 1000);
          </script>
        </h4>
      </header>
      <div class="form">
        <div class="toggle">
          <button id="toggle-regist-form" onclick="toggle('regist')">Registration</button>
          <button id="toggle-login-form" onclick="toggle('login')">Login</button>
        </div>
        <form id="form-regist" method="POST" action="gate_regist.php">
          <h3>Registration Now</h3>
          <small>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officia, id.</small>
          
          <?php if(isset($_SESSION['regist-success'])){ ?>
            <small id="alert-success">
              <i class="fa fa-check-circle"></i><?= $_SESSION['regist-success'] ?>
            </small>
          <?php } unset($_SESSION['regist-success']) ?>
          
          <?php if(isset($_SESSION['regist-error'])){ ?>
            <small id="alert-error">
              <i class="fa fa-exclamation-circle"></i><?= $_SESSION['regist-error'] ?>
            </small>
          <?php } unset($_SESSION['regist-error']) ?>

          <ul>
            <li>
              <input type="text" name="name" id="name" placeholder="your name" autocomplete="off" required>
              <label for="name">Full Name</label>
            </li>
            <li>
              <input type="email" name="email" id="email" placeholder="your email" autocomplete="off" required>
              <label for="email">Email</label>
            </li>
            <li>
              <button type="submit">Regist Now</button>
            </li>
          </ul>
        </form>
        <form id="form-login" method="POST" action="gate_login.php">
          <h3>Login</h3>
          <small>Login and complete your data to get a link to the online conference.</small>

          <?php if(isset($_SESSION['login-error'])){ ?>
            <small id="alert-error">
              <i class="fa fa-exclamation-circle"></i><?= $_SESSION['login-error'] ?>
            </small>
          <?php } unset($_SESSION['login-error']) ?>
          
          <ul>
            <li>
              <input type="text" name="access-code" id="access-code" placeholder="your access code" autocomplete="off" required>
              <label for="access-code">Access Code</label>
            </li>
            <li>
              <button type="submit">Login Now</button>
            </li>
          </ul>
        </form>
        <script>
          document.getElementById('toggle-regist-form').style.background = 'rgb(14, 95, 86)'
          document.getElementById('toggle-login-form').style.background = 'rgba(4, 87, 77, 0.5)'
          document.getElementById('form-login').style.display = 'none';

          function toggle(form) {
            if (form == 'regist') {
              document.getElementById('toggle-regist-form').style.background = 'rgb(14, 95, 86)';
              document.getElementById('toggle-login-form').style.background = 'rgba(4, 87, 77, 0.5)';
              document.getElementById('form-login').style.display = 'none';
              document.getElementById('form-regist').style.display = 'block';
            } else if (form == 'login') {
              document.getElementById('toggle-login-form').style.background = 'rgb(14, 95, 86)';
              document.getElementById('toggle-regist-form').style.background = 'rgba(4, 87, 77, 0.5)';
              document.getElementById('form-regist').style.display = 'none';
              document.getElementById('form-login').style.display = 'block';
            }
          }
        </script>
      </div>
    </div>
  </section>
  <section class="event-desc">
    <div class="container">
      <h2 id="title">WHAT IS THE INTERNATIONAL CONFERENCE ?</h2>
      <h4 id="sub-title">Organized by Fakultas Perikanan dan Ilmu<br>Kelautan Universitas Pattimura</h4>
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam velit asperiores molestias vel nobis
        temporibus? Minus hic est eos suscipit, fugiat similique, quidem voluptates veritatis libero ad et
        exercitationem distinctio ullam iusto tempore, vero quibusdam officia blanditiis consequatur omnis numquam.
        Officiis perferendis quam id impedit similique aliquid quaerat deleniti vel dolores soluta nostrum quos
        aspernatur facilis veniam, quod culpa delectus, beatae repellendus ullam repellat minima! Repellendus nostrum,
        voluptates, dicta, nobis laboriosam possimus voluptatibus sit at voluptatem facilis obcaecati perferendis
        exercitationem doloremque officia molestiae. Cupiditate, possimus? Recusandae eveniet ullam nobis doloremque.
        Velit iste quam a unde ratione, libero repellendus sequi eum.</p>
      <ul>
        <li>
          <i class="fa fa-paper-plane"></i>
          <span>
            <h3>Benefit</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. aliquam facere reiciendis</p>
          </span>
        </li>
        <li>
          <i class="fa fa-paper-plane"></i>
          <span>
            <h3>Benefit</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. aliquam facere reiciendis</p>
          </span>
        </li>
        <li>
          <i class="fa fa-paper-plane"></i>
          <span>
            <h3>Benefit</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. aliquam facere reiciendis</p>
          </span>
        </li>
        <li>
          <i class="fa fa-paper-plane"></i>
          <span>
            <h3>Benefit</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. aliquam facere reiciendis</p>
          </span>
        </li>
      </ul>
    </div>
  </section>
  <section class="speakers">
    <div class="container">
      <h2>SPEAKERS IN THIS CONVERENCE</h2>
      <h4 id="sub-title">Look Who's Speaking</h4>
      <div class="cards">
        <a href="#">
          <div id="description">
            <img src="img/flag-indonesia.png">
            <small>Lorem ipsum dolor sit amet pisicing elit. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, atque! totam, provident quibusdam ipsam sit consequuntur ab odio dignissimos?</small>
          </div>
          <h5 id="identity">Speaker's Name Lorem ipsum dolor sit amet.</h5>
          <img src="img/avatar.jpeg">
        </a>
        <a href="#">
          <div id="description">
            <img src="img/flag-indonesia.png">
            <small>Lorem ipsum dolor sit amet pisicing elit. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, atque! totam, provident quibusdam ipsam sit consequuntur ab odio dignissimos?</small>
          </div>
          <h5 id="identity">Speaker's Name Lorem ipsum dolor sit amet.</h5>
          <img src="img/avatar.jpeg">
        </a>
        <a href="#">
          <div id="description">
            <img src="img/flag-indonesia.png">
            <small>Lorem ipsum dolor sit amet pisicing elit. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, atque! totam, provident quibusdam ipsam sit consequuntur ab odio dignissimos?</small>
          </div>
          <h5 id="identity">Speaker's Name Lorem ipsum dolor sit amet.</h5>
          <img src="img/avatar.jpeg">
        </a>
        <a href="#">
          <div id="description">
            <img src="img/flag-indonesia.png">
            <small>Lorem ipsum dolor sit amet pisicing elit. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, atque! totam, provident quibusdam ipsam sit consequuntur ab odio dignissimos?</small>
          </div>
          <h5 id="identity">Speaker's Name Lorem ipsum dolor sit amet.</h5>
          <img src="img/avatar.jpeg">
        </a>
      </div>
    </div>
  </section>
  <section class="moderator">
    <div class="container">
      <h2>MODERATOR IN THIS CONVERENCE</h2>
      <h4 id="sub-title">Look Who's Moderator</h4>
      <div class="box">
        <img src="img/avatar.jpeg">
        <span>
          <h3>Moderator's Name</h3>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis consequuntur voluptates mollitia
            exceuptatum. Iste,quuntur aspernatur. Mollitia,
            aliquam, doloremque quo accusantium, alias dicta fugit expedita reiciendis asperiores totam fugiat
            deserunt ea nemo!</p>
        </span>
      </div>
      <div class="box">
        <img src="img/avatar.jpeg">
        <span>
          <h3>Moderator's Name</h3>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis consequuntur voluptates mollitia
            excepturi non eius vero quae nulla sunt incidunt a, soluta corrupti in fuga tempore qui suscipit officiis
            repellendus! Quia maiores deserunt, sed ate quod velit voluptatam fugiat
            deserunt ea nemo!</p>
        </span>
      </div>
    </div>
  </section>
  <section class="footer">
    <p>Copyright 2022 by b1deyesa. All Rights Reserved</p>
  </section>

  <video src="img/video.mp4" muted autoplay loop></video>
</body>
</html>