<?php
session_start();
date_default_timezone_set('UTC');

$seed = str_split('0123456789');
shuffle($seed);
$rand = '';
foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];

$postData = [
  "action" => "regist",
  "time_add" => date("Y-m-d H:i:s"),
  "time_update" => date("Y-m-d H:i:s"),
  "code" => "22IC".$rand,
  "name" => $_POST["name"],
  "email" => $_POST["email"]
];

$ch = curl_init($_SESSION['url']);
curl_setopt_array($ch, [
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POSTFIELDS => $postData
]);

$result = curl_exec($ch);
$result = json_decode($result, 1);

if ($result["status"] == "success") {
  $_SESSION['regist-success'] = 'Succesfully registed, now check your email to get access code';
  header("location: index.php");
} else {
  $_SESSION['regist-error'] = $result['message'];
  header("location: index.php");
}