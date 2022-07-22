<?php
session_start();
date_default_timezone_set('UTC');

if($_GET['n'] == 'logout') { logout(); }
elseif($_GET['n'] == 'login') { login(); }
elseif($_GET['n'] == 'regist') { regist(); }
elseif($_GET['n'] == 'update') { update(); }
elseif($_GET['n'] == 'read') { read(); }
elseif($_GET['n'] == 'confirm') { paymentConfirm(); }
else { header('location: index.php'); }

function sendRequest($postData) {
  $scriptGoogle = curl_init('https://script.google.com/macros/s/AKfycbxDD_Svl0fVUN0d95s7xaRUkcfzdn4WMNBkkEvd4QdogSit_ezRwCKjjZC5ndmTwlU89w/exec');
  curl_setopt_array($scriptGoogle, [
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => $postData
  ]);
  $result = curl_exec($scriptGoogle);
  $result = json_decode($result, 1);

  return $result;
}
function logout() {
  session_destroy();
  header('location: index.php');
}
function login() {
  if(strtoupper($_POST['code']) == '#IC22FPIK19') { read(); die; }
  $postData = [
    'action' => 'login',
    'code' => strtoupper($_POST['code']),
  ];
  $result = sendRequest($postData);
  if ($result['status'] == 'success') {
    $_SESSION['login-success'] = $result['data'];
    header('location: page.php');
  } else {
    $_SESSION['login-error'] = $result['message'];
    header('location: index.php#form');
  }
} 
function regist() {
  $seed = str_split('0123456789'); shuffle($seed); $rand = ''; foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];
  $postData = [
    'action' => 'regist',
    'time_add' => date('Y-m-d H:i:s'),
    'time_update' => date('Y-m-d H:i:s'),
    'code' => '22IC' . $rand,
    'email' => $_POST['email'],
    'name' => $_POST['name'],
    'status' => $_POST['status'],
    'payment_status' => 'unpaid'
  ];
  $result = sendRequest($postData);
  if ($result['status'] == 'success') {
    $_SESSION['regist-success'] = 'Succesfully registed, now check your email to get access code';
    header('location: index.php#form');
  } else {
    $_SESSION['regist-error'] = $result['message'];
    header('location: index.php#form');
  }
} 
function read() {
  $postData = [
    'action' => 'read',
  ];
  $_SESSION['read'] = sendRequest($postData);
  header('location: page-admin.php');
}
function update() {
  $paymentName = '';
  $paymentFile = '';
  $articleName = '';
  $articleFile = '';
  if($_FILES["payment"]['name'] != '') { $paymentName = $_POST['code']. '_' .$_POST["name"]; $paymentFile = fileData('payment'); }  
  if($_FILES["article"]['name'] != '') { $articleName = $_POST['code']. '_' .$_FILES["article"]['name']; $articleFile = fileData('article'); }
  $postData = [
    'action' => 'update',
    'time_update' => date('Y-m-d H:i:s'),
    'code' => $_POST['code'],
    'name' => $_POST['name'],
    'phone' => $_POST['phone'],
    'institution' => $_POST['institution'],
    "paymentName" => $paymentName,
    "paymentFile" => $paymentFile,
    "articleName" => $articleName,
    "articleFile" => $articleFile,
  ];
  $result = sendRequest($postData);
  if ($result['status'] == 'success') {
    $_SESSION['update-success'] = 'Succesfully Update';
    login();
  } else {
    $_SESSION['update-error'] = $result['message'];
    header('location: page.php');
  }
}
function paymentConfirm() {
  $postData = [
    'action' => 'paymentConfirm',
    'code' => $_GET['code'],
  ];
  var_dump(sendRequest($postData));
  read();
}
function fileData($n) {
  return 'data:' . $_FILES[$n]['type'] . ';base64,' . base64_encode(file_get_contents($_FILES[$n]['tmp_name']));
}