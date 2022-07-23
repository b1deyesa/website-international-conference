<?php session_start(); if (!isset($_SESSION['code'])) { header('location: index.php'); } ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no' />

    <title>Admin | International Conference</title>
    <link rel='stylesheet' href='style.css'>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.0.7/css/all.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
</head>
<body>
    <section class='jumbotron page-table'>
        <div class="title">
            <h2 class='color-light'>Participant Data</h2>
            <a class="button bg-light color-dark" href="https://drive.google.com/drive/folders/1GrLagpKQZzazOZbdXsc5KWzYKK3lCdgh?usp=sharing" target="_blank">Drive Article</a>
            <a class="button bg-light color-dark" href="https://drive.google.com/drive/folders/1WXz_L1Qo9ASvMwHeBipzcTl_zmil5xRw?usp=sharing" target="_blank">Drive Payment</a>
            <a id="back" class="color-light" href="gate.php?n=logout">< Back</a>
            <ul>
                <li class="color-light">Student : <?php $n=0; for($i = 0; $i < count($_SESSION['read']); $i++){ if($_SESSION['read'][$i][7] == 'Student'){ $n += 1; }} echo $n ?></li>
                <li class="color-light">Lecturer : <?php $n=0; for($i = 0; $i < count($_SESSION['read']); $i++){ if($_SESSION['read'][$i][7] == 'Lecturer'){ $n += 1; }} echo $n ?></li>
                <li class="color-light">Researcher : <?php $n=0; for($i = 0; $i < count($_SESSION['read']); $i++){ if($_SESSION['read'][$i][7] == 'Researcher'){ $n += 1; }} echo $n ?></li>
                <li class="color-light">General : <?php $n=0; for($i = 0; $i < count($_SESSION['read']); $i++){ if($_SESSION['read'][$i][7] == 'General'){ $n += 1; }} echo $n ?></li>
            </ul>
        </div>
        <div class='container color-light'>
            <div class="table">
                <table>
                    <tr>
                        <th rowspan="2">Access Code</th>
                        <th rowspan="2">Email</th>
                        <th rowspan="2">Name</th>
                        <th rowspan="2">Status</th>
                        <th rowspan="2">Phone Number</th>
                        <th rowspan="2">Article/Abstract</th>
                        <th colspan="3">Payment</th>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <th>Reciept</th>
                        <th>Confirm</th>
                    </tr>
                    <?php for ($i = 1; $i < count($_SESSION['read']); $i++) : ?>
                        <?php
                        $data = $_SESSION['read'][$i];
                        // Add data here -------------------------------
                        $time_add       = $data[0];
                        $time_update    = $data[1];
                        $code           = $data[2];
                        $email          = $data[3];
                        $name           = $data[4];
                        $phone          = $data[5];
                        $institution    = $data[6];
                        $status         = $data[7];
                        $payment        = $data[8];
                        $payment_status = $data[9];
                        $article        = $data[10];
                        ?>
                        <tr>
                            <td><?= $code ?></td>
                            <td style="text-align:left"><?= $email ?></td>
                            <td style="text-align:left"><?= $name ?></td>
                            <td><?= $status ?></td>
                            <td><?= $phone ?></td>

                            <?php if ($article != '') : ?>
                                <td><a class="link" href="<?= $article ?>" target="_blank">Link Download</a></td>
                            <?php else : ?>
                                <td></td>
                            <?php endif ?>

                            <?php if ($payment_status == 'paid') : ?>
                                <td class="color-success"><?= $payment_status ?></td>
                            <?php elseif ($payment_status == 'processing') : ?>
                                <td class="color-warning"><?= $payment_status ?></td>
                            <?php elseif ($payment_status == 'unpaid') : ?>
                                <td class="color-danger"><?= $payment_status ?></td>
                            <?php endif ?>

                            <?php if ($payment != '') : ?>
                                <td><a class="link" href="<?= $payment ?>" target="_blank">Link Image</a></td>
                            <?php else : ?>
                                <td></td>
                            <?php endif ?>

                            <?php if ($payment_status != 'paid' && $payment != '') : ?>
                                <td><a class="button bg-light color-dark" href="gate.php?n=confirm&code=<?= $code ?>" onclick="return confirm('[<?= $code ?>] Confirm payment?')">Confrim</a></td>
                            <?php else : ?>
                                <td></td>
                            <?php endif ?>
                        </tr>
                    <?php endfor ?>
                </table>
            </div>
        </div>
    </section>
    <section class='footer'>
        <p class='color-light'>Copyright 2022 by b1deyesa. All Rights Reserved</p>
    </section>
    <video src='img/video.mp4' muted autoplay loop></video>
</body>
</html>