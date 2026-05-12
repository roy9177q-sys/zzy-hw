<?php
header('Content-Type: text/html; charset=utf-8');
include("mysql.inc.php");

// 查詢【books】資料表中價格大於 400 的書籍
// 之【書籍名稱】與【價格】欄位
$sql = "SELECT 書籍名稱,價格 FROM books WHERE 價格 > 400";
$result = mysqli_query($conn, $sql);

//使用表格顯示資料
echo '以下是價格大於 400 的書籍<br />
      <table border="1"><tr><th>書籍名稱</th><th>價格</th></tr>';

//使用迴圈逐筆讀取記錄
while ($row = mysqli_fetch_array($result)) {
  echo "<tr><td> $row[0] </td><td> $row[1] </td></tr>";
}

echo '</table>';
?>
