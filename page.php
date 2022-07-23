<?php
session_start(); if (!isset($_SESSION['login-success'])) { header('location: index.php'); }
$dataLogin = $_SESSION['login-success'];
// Add data here -------------------------------
$time_add       = $dataLogin[0];
$time_update    = $dataLogin[1];
$code           = $dataLogin[2];
$email          = $dataLogin[3];
$name           = $dataLogin[4];
$phone          = $dataLogin[5];
$institution    = $dataLogin[6];
$status         = $dataLogin[7];
$payment        = $dataLogin[8];
$payment_status = $dataLogin[9];
$article        = $dataLogin[10];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />

  <title><?= $name ?> | International Conference</title>
  <link rel='stylesheet' href='style.css'>
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.7/css/all.css'>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
</head>
<body>
  <section class='jumbotron page-form'>
    <div class='container color-light'>
      <form id='uploadForm' method='POST' action='gate.php?n=update' onsubmit='loading()' enctype="multipart/form-data">
        <input type='hidden' name='code' value='<?= $code ?>'>
        <h2>Complate Your Data</h2>
        <?php if ($payment_status == 'unpaid') : ?>
          <div class='payment bg-danger alert'>
            <i class='fa fa-exclamation-circle color-white'></i>
            <small class='color-white'>
              <h4>Payment status: UNPAID</h4>
              <p id="p">Click, to upload yout reciept<span id="payment-name"></span></p>
            </small>
            <input type='file' name='payment' id='payment' value='asdsa'>
          </div>
        <?php elseif ($payment_status == 'processing') : ?>
          <div class='payment bg-warning alert'>
            <i class='fa fa-clock color-light'></i>
            <small class='color-light'>
              <h4>Payment status: PROCESSING</h4>
              <p>Please wait, information will sent to you mail</p>
            </small>
            <input type='hidden' name='payment' id='payment' value=''>
          </div>
        <?php elseif ($payment_status == 'paid') : ?>
          <div class='payment bg-success alert'>
            <i class='fa fa-check-circle color-white'></i>
            <small class='color-white'>
              <h4>Payment status: PAID</h4>
              <p>Lorem, ipsum dolor sm accusamus consequuntur, omnis sit eius dolor est perferendis! Deserunt atque commodi dolorem.</p>
            </small>
            <input type='hidden' name='payment' id='payment' value=''>
          </div>
        <?php endif ?>
        <?php if (isset($_SESSION['update-success'])) { ?>
          <div class='alert bg-success'>
            <i class='fa fa-check-circle'></i><?= $_SESSION['update-success'] ?>
          </div>
        <?php } unset($_SESSION['update-success']) ?>
        <?php if (isset($_SESSION['update-error'])) { ?>
          <div class='alert bg-danger'>
            <i class='fa fa-exclamation-circle'></i><?= $_SESSION['update-error'] ?>
          </div>
        <?php } unset($_SESSION['update-error']) ?>
        <ul>
          <!-- Email -->
          <li>
            <input disabled value='<?= $email ?>'>
            <label>Email <i class='color-danger'>(Not allow to change)</i></label>
          </li>
          <!-- Name -->
          <li>
            <input type='text' name='name' id='name' autocomplete='off' value='<?= $name ?>'>
            <label for='name'>Full Name</label>
          </li>
          <!-- Phone -->
          <li>
            <input type='text' name='phone' id='phone' autocomplete='off' value='<?= $phone ?>'>
            <label for='phone'>Phone Number</label>
          </li>
          <!-- Institution -->
          <li>
            <input type='text' name='institution' id='institution' autocomplete='off' value='<?= $institution ?>'>
            <label for='institution'>Institution</label>
          </li>
          <!-- Article -->
          <li id='textarea'>
            <?php if ($article != '') : ?>
              <a id="article-name" class="article-link" href="<?= $article ?>" target="_blank">Download Abstract</a>
            <?php endif ?>
            <input type='file' name='article' id='article' value=''>
            <label for='article'>Abstract</label>
          </li>
          <!-- Button -->
          <li id='textarea'>
            <a class='color-light' href='gate.php?n=logout'>Log out</a>
            <button id='btn-update' class='bg-light color-dark' type='submit'><i class='fa fa-spinner fa-spin'></i>Update Your Data</button>
          </li>
        </ul>
      </form>
      <script>
        const spinner = document.querySelectorAll('.fa-spinner');
        for (let i = 0; i < spinner.length; i++) { spinner[i].style.display = 'none' }
        function loading() {
          for (let i = 0; i < spinner.length; i++) { spinner[i].style.display = 'block' }
          document.getElementById('btn-update').classList.add('bg-secondary')
          document.getElementById('btn-update').classList.remove('bg-light')
        }
        document.getElementById('payment').onchange = (e) => { const [file] = e.target.files; document.getElementById('payment-name').innerHTML = ' : ' + '<span class=color-warning>' + file.name + '</span>' }
        document.getElementById('article').onchange = (e) => { 
          const [file] = e.target.files; 
          document.getElementById('article-name').innerHTML = '<span class=color-light>' + file.name + '</span>' 
          document.getElementById('article-name').href = '' 
          document.getElementById('article-name').target = '' 
        }
      </script>
    </div>
  </section>
  <section class='footer'>
    <p class='color-light'>Copyright 2022 by b1deyesa. All Rights Reserved</p>
  </section>
  <video src='img/video.mp4' muted autoplay loop></video>
</body>
</html>