<?php
// 資料庫連線參數
$host = 'localhost';
$user = 'root';
$password = ''; // XAMPP 預設密碼通常為空字串
$database = 'ch09';

// 建立連線
$conn = mysqli_connect($host, $user, $password, $database);

// 檢查連線是否成功，若失敗則顯示錯誤訊息並停止執行
if (!$conn) {
    die("資料庫連線失敗：" . mysqli_connect_error());
}

// 設定通訊編碼為 utf8，確保中文顯示正常
mysqli_query($conn, "SET NAMES utf8");
?>