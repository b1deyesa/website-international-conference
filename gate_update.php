<?php
session_start();
date_default_timezone_set('UTC');

$postData = [
  "action" => "update",
  "time_update" => date("Y-m-d H:i:s"),
  "code" => $_POST["code"],
  "name" => $_POST["name"],
  "article" => $_POST["article"]
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
  $_SESSION['update-success'] = 'Succesfully Update';
  header("location: page.php");
} else {
  $_SESSION['update-error'] = $result['message'];
  header("location: page.php");
}