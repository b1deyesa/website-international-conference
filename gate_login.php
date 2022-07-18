<?php
session_start();

$postData = [
  "action" => "login",
  "code" => strtoupper($_POST["access-code"]),
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
  $_SESSION['login-success'] = $result['data'];
  header("location: page.php");
} else {
  $_SESSION['login-error'] = $result['message'];
  header("location: index.php");
}