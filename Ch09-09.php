<?php
include("mysql.inc.php");

$myTable='surl';                //設定程式使用的資料表名稱
$myHost=$_SERVER['HTTP_HOST'];  //取得程式所在的網址
$myUri=$_SERVER['PHP_SELF'];    //取得程式的檔案名稱 
$shortUrl="";                   //定義存放短網址的變數

//---------------- 取得 longUrl 與 id 參數 --------------
//如果以 POST 方式傳遞過來的 longUrl 參數不是空字串
//便將傳遞過來的參數值設定給變數 $longUrl
if (isset($_POST['longUrl']))	$longUrl=$_POST['longUrl'];
else                            $longUrl="";

//如果以 GET 方式傳遞過來的 id 參數不是空字串,
//便將 id 參數內的編號設定給變數 $id
if ( isset($_GET['id']) )	$id=$_GET['id'];
else                        $id="";

//---------------- 縮短網址 -----------------------------
//如果 $longUrl 變數不是空字串, 表示使用者想要縮短網址
if ($longUrl != "") {
  //準備查詢, 後續動作都要用到傳回值 $stmt
  $stmt = mysqli_prepare($conn, 
               "INSERT $myTable (url) VALUES (?)");
  // 繫結參數
  mysqli_stmt_bind_param($stmt, 's', $longUrl); 

  // 執行查詢, 將長網址新增至資料庫中
  mysqli_stmt_execute($stmt);
  
  // 取得剛才新增資料的編號
  $id=mysqli_insert_id($conn);
  
  // 設定短網址
  $shortUrl="http://$myHost$myUri?id=$id";
}

//---------------- 連線長網址 ---------------------------
//如果 $id 變數不是空字串, 表示要使用短網址連線長網址
elseif ($id != "") {
  //準備查詢, 後續動作都要用到傳回值 $stmt
  $stmt = mysqli_prepare($conn, 
               "SELECT url FROM $myTable WHERE id=?");
  // 繫結參數
  mysqli_stmt_bind_param($stmt, 'd', $id); 

  // 執行查詢, 依照編號取得資料庫中的長網址
  mysqli_stmt_execute($stmt);
  
  // 將結果繫結至變數 $url 
  mysqli_stmt_bind_result ($stmt, $url);
  
  // 取得查詢結果
  mysqli_stmt_fetch($stmt);
  
  //將使用者轉向到長網址
  header("Location: ". $url);
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>短網址網站</title>
  <link href="Ch09.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="wrapper">
  <div id="title">
    <img id="title_img" src="logo.jpg">
    <h1>短網址網站</h1>
  </div>
  <div id="maintext">
<?php
//---------------- 顯示短網址 ---------------------------
//如果 $shortUrl 變數不是空字串, 表示程式已經將網址縮短,
//所以顯示 $shortUrl 變數內的短網址
if ( $shortUrl != "") {
  echo "
  您的網址: <a href='$longUrl'>$longUrl</a><br>
  已經縮短為: <a href='$shortUrl'>$shortUrl</a>";
}
//---------------- 顯示輸入長網址的表單 -----------------
//若 $shortUrl 變數是空字串, 表示此為第一次連線,
//所以顯示表單讓使用者輸入長網址
else {
  echo '
  <form method="post" action="'.$myUri.'" name="addurl">
    請輸入想要縮短的網址：<br>
    <input maxlength="128" size="50" name="longUrl" required>
    <br><input name="submit" value="送出" type="submit">
  </form>';
}
?>
  </div>
<div>
</body>
</html>