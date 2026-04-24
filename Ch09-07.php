<?php
include("mysql.inc.php");

//如果網頁表單的 name 與 qty 欄位都不是空字串
if (!empty($_POST['name']) && !empty($_POST['qty'])){
  $name = $_POST['name'];
  $qty = $_POST['qty'];
  
  // 先檢查書籍是否已存在
  $check_sql = "SELECT * FROM inventory WHERE 書籍名稱 = '{$name}'";
  $check_result = mysqli_query($conn, $check_sql);
  
  if (mysqli_num_rows($check_result) > 0) {
    // 如果書籍已存在，則更新數量（數量相加）
    $update_sql = "UPDATE inventory SET 數量 = 數量 + {$qty} WHERE 書籍名稱 = '{$name}'";
    mysqli_query($conn, $update_sql);
  } else {
    // 如果書籍不存在，則新增一筆記錄
    $insert_sql = "INSERT inventory (書籍名稱, 數量) VALUES ('{$name}','{$qty}')";
    mysqli_query($conn, $insert_sql);
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>書籍存貨管理系統</title>
</head>
<body>
<body>
  <form method="post" action="<?php $_SERVER["PHP_SELF"] ?>">
    書名: <input name="name">
    數量: <input name="qty" style="width: 73px">
    <input name="submit" type="submit" value="新增">
  </form>
<?php

//使用【書籍名稱】排序, 查詢 【inventory】 資料表的所有資料
$sql="SELECT * FROM inventory ORDER BY 書籍名稱 ASC";
$result=mysqli_query($conn, $sql);

//如果查到的記錄筆數大於 0, 便使用迴圈顯示所有資料
if (mysqli_num_rows($result) >0){
  echo "<hr><table border='1'>
        <tr><td>書籍名稱</td><td>數量</td></tr>";

  while ($row = mysqli_fetch_array($result)) {
    echo "<tr><td>{$row['書籍名稱']}</td>
              <td>{$row['數量']}</td>
              <td><a href='Ch09-07-01.php?del={$row['編號']}'>
                  刪除</a></td></tr>";
  }
  echo '</table>';
}
?>
</body>
</html>