<?php
session_start(); 
$event_date = 'Friday, 2 October 2023';
$event_time = '12.00 PM';
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />

  <title>International Conference</title>
  <link rel='stylesheet' href='style.css'>
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.7/css/all.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
</head>
<body>
  <section class='jumbotron'>
    <div class='container color-light'>
      <header>
        <img id='logo' src='img/logo.png'>
        <h1>International Conference 2022</h1>
        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus, officia.</h3>
        <h2 class='color-warning'>
          <i class='fa fa-calendar'>&nbsp;&nbsp;</i><?= $event_date ?><br>
          <i class='fa fa-clock'>&nbsp;&nbsp;</i><?= $event_time ?>
        </h2>
        <h3 id='countdown'>
          <script>
            var countDownDate = new Date('<?= $event_date ?>').getTime();
            var x = setInterval(function() {
              var now = new Date().getTime();
              var distance = countDownDate - now;
              var days     = Math.floor(distance / (1000 * 60 * 60 * 24));
              var hours    = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
              var minutes  = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
              var seconds  = Math.floor((distance % (1000 * 60)) / 1000);
              document.getElementById('countdown').innerHTML =
                '<span>' + days    + '<br>days</span>' +
                '<span>' + hours   + '<br>hrs</span>' +
                '<span>' + minutes + '<br>min</span>' +
                '<span>' + seconds + '<br>sec</span>';
              if (distance < 0) {
                clearInterval(x);
                document.getElementById('countdown').innerHTML = '<span>Get Started</span>';
              }
            }, 1000);
          </script>
        </h3>
      </header>
      <div id='form' class='form'>
        <div class='toggle'>
          <button class='toggle-regist-form color-light' onclick='toggle("regist")'>Registration</button>
          <button class='toggle-login-form color-light' onclick='toggle("login")'>Login</button>
        </div>
        <form class='form-regist bg-third' method='POST' action='gate.php?n=regist' onsubmit='loading()'>
          <h3>Register Now</h3>
          <small>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Officia, id.</small>
          <?php if(isset($_SESSION['regist-success'])){ ?>
            <div class='alert bg-success'>
              <i class='fa fa-check-circle'></i><?= $_SESSION['regist-success'] ?>
            </div>
          <?php } unset($_SESSION['regist-success']) ?>
          <?php if(isset($_SESSION['regist-error'])){ ?>
            <div class='alert bg-danger'>
              <i class='fa fa-exclamation-circle'></i><?= $_SESSION['regist-error'] ?>
            </div>
          <?php } unset($_SESSION['regist-error']) ?>
          <ul>
            <li>
              <input type='text' name='name' id='name' placeholder='your name' autocomplete='off' required>
              <label for='name'>Full Name</label>
            </li>
            <li>
              <input type='email' name='email' id='email' placeholder='your email' autocomplete='off' required>
              <label for='email'>Email</label>
            </li>
            <li>
              <select name="status" id="status" autocomplete="off" required>
                <option value=''>your status</option>
                <option value='Student'>Student</option>
                <option value='Lecturer'>Lecturer</option>
                <option value='Researcher'>Researcher</option>
                <option value='General'>General</option>
              </select>
              <label for='status'>Status</label>
            </li>
            <li>
              <button id='btn-regist' class='bg-light color-dark' type='submit'><i class='fa fa-spinner fa-spin'></i>Regist Now</button>
            </li>
          </ul>
        </form>
        <form class='form-login bg-third' method='POST' action='gate.php?n=login' onsubmit='loading()'>
          <h3>Login Now</h3>
          <small>Login and complete your data to get a link to the online conference.</small>
          <?php if(isset($_SESSION['login-error'])){ ?>
            <div class='alert bg-danger'>
              <i class='fa fa-exclamation-circle'></i><?= $_SESSION['login-error'] ?>
            </div>
          <?php } ?>
          <ul>
            <li>
              <input type='text' name='code' id='code' placeholder='your access code' autocomplete='off' value='<?php if(isset($_SESSION['login-success'])) { echo $_SESSION['login-success'][2]; } ?><?php if(isset($_SESSION['code'])) { echo $_SESSION['code']; } ?>' required>
              <label for='code'>Access Code</label>
            </li>
            <li>
              <button id='btn-login' class='bg-light color-dark' type='submit'><i class='fa fa-spinner fa-spin'></i>Login Now</button>
            </li>
          </ul>
        </form>
        <script>
          document.querySelector('.toggle-regist-form').classList.add('bg-third')
          document.querySelector('.form-login').style.display = 'none'
          <?php if(isset($_SESSION['login-error'])) { ?>
            document.querySelector('.toggle-login-form').classList.add('bg-third')
            document.querySelector('.form-regist').style.display = 'none'
            document.querySelector('.toggle-regist-form').classList.remove('bg-third')
            document.querySelector('.form-login').style.display = 'block'
          <?php } unset($_SESSION['login-error']) ?>
          function toggle(form) {
            if (form == 'regist') {
              document.querySelector('.toggle-regist-form').classList.add('bg-third')
              document.querySelector('.toggle-login-form').classList.remove('bg-third')
              document.querySelector('.form-regist').style.display = 'block'
              document.querySelector('.form-login').style.display = 'none'
            } else if (form == 'login') {
              document.querySelector('.toggle-login-form').classList.add('bg-third')
              document.querySelector('.toggle-regist-form').classList.remove('bg-third')
              document.querySelector('.form-login').style.display = 'block'
              document.querySelector('.form-regist').style.display = 'none'
            }
          }
          
          const spinner = document.querySelectorAll('.fa-spinner');
          for (let i = 0; i < spinner.length; i++) { spinner[i].style.display = 'none' }
          function loading() {
            for (let i = 0; i < spinner.length; i++) { spinner[i].style.display = 'block' }
            document.getElementById('btn-regist').classList.add('bg-secondary')
            document.getElementById('btn-regist').classList.remove('bg-light')
            document.getElementById('btn-login').classList.add('bg-secondary')
            document.getElementById('btn-login').classList.remove('bg-light')
          }
        </script>
      </div>
    </div>
  </section>
  <section class='event-desc bg-light'>
    <div class='container'>
      <h2 class='color-third'>WHAT'S THE INTERNATIONAL CONFERENCE ?</h2>
      <h4 class='color-secondary'>Organized by Fakultas Perikanan dan Ilmu Kelautan Universitas Pattimura</h4><br>
      <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquam velit asperiores molestias vel nobis
        temporibus? Minus hic est eos suscipit, fugiat similique, quidem voluptates veritatis libero ad et
        exercitationem distinctus voluptatibus sit at voluptatem facilis obcaecati perferendis
        exercitationem doloremque officia molestiae. Cupiditate, possimus? Recusandae eveniet ullam nobis doloremque.
        Velit iste quam a unde ratione, libero repellendus sequi eum.</p>
      <ul>
        <li>
          <i class='fa fa-paper-plane bg-third color-light'></i>
          <span>
            <h3>Benefit</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. aliquam facere reiciendis</p>
          </span>
        </li>
        <li>
          <i class='fa fa-paper-plane bg-third color-light'></i>
          <span>
            <h3>Benefit</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. aliquam facere reiciendis</p>
          </span>
        </li>
        <li>
          <i class='fa fa-paper-plane bg-third color-light'></i>
          <span>
            <h3>Benefit</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. aliquam facere reiciendis</p>
          </span>
        </li>
        <li>
          <i class='fa fa-paper-plane bg-third color-light'></i>
          <span>
            <h3>Benefit</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. aliquam facere reiciendis</p>
          </span>
        </li>
      </ul>
    </div>
  </section>
  <section class='speakers'>
    <div class='container'>
      <h2 class='color-dark'>SPEAKERS IN THIS CONFERENCE</h2>
      <h4 class='color-third'>Look Who's Speaking</h4><br>
      <div class='cards'>
        <a>
          <div id='description'>
            <img src='img/flag-indonesia.png'>
            <small>Lorem ipsum dolor sit amet pisicing elit. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, atque! totam, provident quibusdam ipsam sit consequuntur ab odio dignissimos?</small>
          </div>
          <h5 id='identity'>Speaker's Name</h5>
          <img src='img/avatar.jpeg'>
        </a>
        <a>
          <div id='description'>
            <img src='img/flag-indonesia.png'>
            <small>Lorem ipsum dolor sit amet pisicing elit. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, atque! totam, provident quibusdam ipsam sit consequuntur ab odio dignissimos?</small>
          </div>
          <h5 id='identity'>Speaker's Name</h5>
          <img src='img/avatar.jpeg'>
        </a>
        <a>
          <div id='description'>
            <img src='img/flag-indonesia.png'>
            <small>Lorem ipsum dolor sit amet pisicing elit. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, atque! totam, provident quibusdam ipsam sit consequuntur ab odio dignissimos?</small>
          </div>
          <h5 id='identity'>Speaker's Name</h5>
          <img src='img/avatar.jpeg'>
        </a>
        <a>
          <div id='description'>
            <img src='img/flag-indonesia.png'>
            <small>Lorem ipsum dolor sit amet pisicing elit. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, atque! totam, provident quibusdam ipsam sit consequuntur ab odio dignissimos?</small>
          </div>
          <h5 id='identity'>Speaker's Name</h5>
          <img src='img/avatar.jpeg'>
        </a>
      </div>
    </div>
  </section>
  <section class='moderator bg-primary'>
    <div class='container'>
      <h2 class='color-third'>MODERATOR IN THIS CONFERENCE</h2>
      <h4 class='color-secondary'>Look Who's Moderating</h4><br>
      <div class='box'>
        <img src='img/avatar.jpeg'>
        <span>
          <h3>Moderator's Name</h3>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Debitis consequuntur voluptates mollitia
            exceuptatum. Iste,quuntur aspernatur. Mollitia,
            aliquam, doloremque quo accusantium, alias dicta fugit expedita reiciendis asperiores totam fugiat
            deserunt ea nemo!</p>
        </span>
      </div>
      <div class='box'>
        <img src='img/avatar.jpeg'>
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
  <section class='footer bg-third'>
    <p class=' color-light'>Copyright 2022 by b1deyesa. All Rights Reserved</p>
  </section>
  <video src='img/video.mp4' muted autoplay loop></video>
</body>
</html>