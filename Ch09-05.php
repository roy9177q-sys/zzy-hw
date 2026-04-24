<?php
include("mysql.inc.php");
$perpage=7;  // 每頁顯示 7 筆
$sql="SELECT count(書籍編號) FROM books";
$result=mysqli_query($conn, $sql);

//取得查詢結果的筆數
$totalrow=mysqli_fetch_array($result)[0];
$totalpage=ceil($totalrow/$perpage);  // 計算總頁數

// 根據 $_GET['page'] 參數值決定從第幾頁開始顯示
// 代表頁次的變數 $page 由 1 起算
if(empty($_GET['page']) || !is_numeric($_GET['page'])
    ||  $_GET['page']<1 || $_GET['page']>$totalpage ) 
	$page=1;
else 
	$page=$_GET['page'];

// 根據 $_GET['order'] 參數值決定排序方式
if(empty($_GET['order']) || !is_numeric($_GET['order'])
    ||  $_GET['order']<1 || $_GET['order']>2 ) {
	$field='書籍編號'; // SQL 查詢時的排序參數 
	$order=0;          // 建立頁次連結時使用的參數
}
else if($_GET['order']==1) {
	$field='書籍名稱';
	$order=1;
}
else if($_GET['order']==2) {
    $field='價格';
	$order=2;
}

// 設定查詢 LIMIT 子句的第 1 個參數
$start=($page-1)*$perpage;  	
	
//查詢【books】資料表的記錄
$sql = "SELECT 書籍編號,書籍名稱,價格 FROM books ORDER BY $field ".
       "LIMIT $start, $perpage";
$result=mysqli_query($conn, $sql);

//取得查詢結果
while($row=mysqli_fetch_array($result)) $data[]=$row;
?>
<!DOCTYPE html>
<html>
<head>
  <title>分頁與排序</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      padding: 40px 20px;
    }
    
    .container {
      max-width: 600px;
      margin: 0 auto;
      background: white;
      border-radius: 12px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      overflow: hidden;
    }
    
    .header {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      padding: 30px;
      text-align: center;
    }
    
    .header h1 {
      font-size: 28px;
      margin-bottom: 8px;
      font-weight: 600;
    }
    
    .header p {
      font-size: 14px;
      opacity: 0.9;
    }
    
    .content {
      padding: 30px;
    }
    
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 30px;
    }
    
    table th {
      background-color: #f8f9fa;
      padding: 15px;
      text-align: center;
      font-weight: 600;
      color: #2c3e50;
      border-bottom: 2px solid #e0e0e0;
    }
    
    table th a {
      color: #667eea;
      text-decoration: none;
      transition: all 0.3s ease;
      display: inline-block;
      padding: 5px 10px;
      border-radius: 4px;
    }
    
    table th a:hover {
      color: #764ba2;
      background-color: rgba(102, 126, 234, 0.1);
      text-decoration: underline;
    }
    
    table td {
      padding: 14px 15px;
      text-align: center;
      color: #34495e;
      border-bottom: 1px solid #ecf0f1;
    }
    
    table tr:hover {
      background-color: #f8f9fa;
      transition: background-color 0.2s ease;
    }
    
    table tr:nth-child(even) {
      background-color: #f9fafb;
    }
    
    table tr:nth-child(even):hover {
      background-color: #f0f2ff;
    }
    
    table #h1,
    table #h3 {
      width: 25%;
    }
    
    .pagination {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      gap: 8px;
      margin-top: 30px;
      padding-top: 20px;
      border-top: 1px solid #ecf0f1;
    }
    
    .page-info {
      font-size: 14px;
      color: #7f8c8d;
      margin-right: 10px;
    }
    
    .pagination a {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      padding: 8px;
      background-color: #f8f9fa;
      color: #667eea;
      text-decoration: none;
      border: 1px solid #e0e0e0;
      border-radius: 6px;
      transition: all 0.3s ease;
      font-weight: 500;
      font-size: 14px;
      cursor: pointer;
    }
    
    .pagination a:hover {
      background-color: #667eea;
      color: white;
      border-color: #667eea;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
    
    .pagination .current-page {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      font-size: 14px;
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
    }
    
    .footer {
      background-color: #f8f9fa;
      padding: 15px 30px;
      text-align: center;
      font-size: 12px;
      color: #95a5a6;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="header">
    <h1>📚 書籍管理系統</h1>
    <p>共 <?php echo $totalrow; ?> 筆書籍資料</p>
  </div>
  
  <div class="content">
    <table>
      <thead>
        <tr>
          <th id="h1"><a href="Ch09-05.php?order=0">書籍編號</a></th>
          <th><a href="Ch09-05.php?order=1">書籍名稱</a></th>
          <th id="h3"><a href="Ch09-05.php?order=2">價格</a></th>
        </tr>
      </thead>
      <tbody>
        <?php
        // 用迴圈輸出目前頁次的資料
        for($i=0;$i<$perpage;$i++){
          if(isset($data[$i])){
            echo '<tr>';
            echo "<td>{$data[$i]['書籍編號']}</td>";
            echo "<td>{$data[$i]['書籍名稱']}</td>";
            echo "<td>\${$data[$i]['價格']}</td>";
            echo '</tr>';
          }
        }
        ?>
      </tbody>
    </table>

    <div class="pagination">
      <span class="page-info">第 <?php echo $page; ?> / <?php echo $totalpage; ?> 頁</span>
      <?php
      // 輸出直接跳頁的連線
      for($i=1;$i<=$totalpage;$i++){
        if($i==$page) 
          echo "<span class='current-page'>$i</span>";
        else
          echo sprintf('<a href="%s?page=%d&order=%d">%d</a>',
                       $_SERVER['PHP_SELF'], $i , $order, $i);  
      }
      ?>
    </div>
  </div>
  
  <div class="footer">
    💡 點擊表頭進行排序 | 點擊頁碼進行跳頁
  </div>
</div>
</body>
</html>