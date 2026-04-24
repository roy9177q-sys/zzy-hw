<?php
header('Content-Type: text/html; charset=utf-8');
$conn = @mysqli_connect("localhost","root", "wrongpass", "Ch09");

if (mysqli_connect_errno())
  die("無法連線資料庫伺服器, 請聯絡系統管理員 mis@php.flag.com.tw");
?>
