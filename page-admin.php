<?php
session_start();
if(!isset($_SESSION['read'])){ header('location: index.php'); }
?>
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
            <a id="refresh" class="color-warning" href="gate.php?n=read">Refresh</a>
            <a id="back" class="color-light" href="gate.php?n=logout">< Back</a>
        </div>
        <div class='container color-light'>
            <div class="table">
                <table>
                    <tr>
                        <th>Access Code</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Payment Reciept</th>
                        <th>Participant Status</th>
                        <th>Payment Status</th>
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
                            <td align='left'><?= $email ?></td>
                            <td align='left'><?= $name ?></td>
                            <td><?= $status ?></td>
                            <td><?= $payment_status ?></td>

                            <?php if ($payment != '') : ?>
                                <td><a class="color-warning" href="<?= $payment ?>">Image</a></td>
                            <?php else : ?>
                                <td><a class="color-danger" href="">No Image</a></td>
                            <?php endif ?>

                            <?php if ($payment_status != 'paid' && $payment != '') : ?>
                                <td><a class="bg-success color-dark" href="gate.php?n=confirm&code=<?= $code ?>">Confrim</a></td>
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