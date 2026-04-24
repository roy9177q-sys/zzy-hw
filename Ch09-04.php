<?php
include("mysql.inc.php");
$perpage=7; // 每頁顯示 7 筆

//查詢【books】資料表的記錄
$sql = "SELECT `書籍編號`,`書籍名稱`,`價格` FROM `books`";
$result=mysqli_query($conn, $sql);

//取得查詢結果的筆數
$totalrow=mysqli_num_rows($result);
$totalpage=ceil($totalrow/$perpage); // 計算總頁數

// 將全部資料都存到 $data 陣列中
$data=mysqli_fetch_all($result, MYSQLI_ASSOC);

// 根據 $_GET['page'] 參數值決定從第幾頁開始顯示
// 代表頁次的變數 $page 由 1 起算
if(empty($_GET['page']) || !is_numeric($_GET['page'])
|| $_GET['page']<1 || $_GET['page']>$totalpage )
$page=1;
else
$page=$_GET['page'];
?>
<!DOCTYPE html>
<html>
<head>
<title>分頁顯示資料</title>
<meta charset="UTF-8">
<style>
table {border:1px solid black; width:450px;
text-align:center}
.grey {background-color:lightgrey}
.narrow {width:20%}
</style>
</head>
<body>
<table>
<tr>
<th class="narrow">書籍編號</th>
<th>書籍名稱</th>
<th class="narrow">價格</th>
</tr>
<?php
// 用迴圈輸出目前頁次的資料
for($i=0;$i<$perpage;$i++){
// 根據頁碼計算要顯示第幾筆資料
$index = ($page-1) * $perpage + $i;
if($index>=count($data)) break; //索引超出範圍即跳出迴圈

if($i%2==0) echo '<tr class="grey">'; // 雙數行加灰底
else echo '<tr>';
echo "<td>{$data[$index]['書籍編號']}</td>";
echo "<td>{$data[$index]['書籍名稱']}</td>";
echo "<td>{$data[$index]['價格']}</td>";
echo '</tr>';
}
echo '</table>';

// 輸出直接跳頁的連線
for($i=1;$i<=$totalpage;$i++){
if($i!=1) echo "&nbsp;";
if($i==$page) echo $i;
else
echo sprintf('<a href="%s?page=%d">%d</a>',
$_SERVER['PHP_SELF'], $i , $i);
}
?>
</body>
</html>