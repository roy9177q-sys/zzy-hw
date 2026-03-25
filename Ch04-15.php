<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>BMI 資料輸入</title>
    <style>
        /* --- 保持風格一致 --- */
        body {
            font-family: "Microsoft JhengHei", sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .welcome-card {
            background-color: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .welcome-text {
            color: #27ae60;
            font-size: 1.2em;
            font-weight: bold;
            margin-bottom: 25px;
            padding: 10px;
            background-color: #e8f5e9;
            border-radius: 5px;
        }

        .input-form h3 { color: #333; margin-top: 0; }
        
        .form-row { margin-bottom: 15px; text-align: left; }
        .form-row label { display: block; margin-bottom: 5px; font-weight: bold; }
        
        /* 統一輸入框風格 */
        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 16px;
            box-sizing: border-box;
        }

        /* 統一按鈕風格 */
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #3498db; /* 換成藍色按鈕區分 */
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 17px;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        input[type="submit"]:hover { background-color: #2980b9; }

        .error-msg { color: #e74c3c; font-weight: bold; text-align: center; }
        .back-link { display: inline-block; margin-top: 15px; color: #7f8c8d; text-decoration: none; }
    </style>
</head>
<body>

<div class="welcome-card">
<?php
//（保持原本的登入驗證邏輯）
$userpass = array('zzy' => '12345', 'tony'  => '54321');

if ( !isset($_POST['uname']) || !isset($_POST['upass']) || $_POST['uname'] == '' || $_POST['upass'] == '' ){
    echo "<div class='error-msg'>[錯誤] 請先從登入頁面輸入帳號密碼!</div>";
    echo "<a href='Ch04-14.html' class='back-link'>⬅ 回登入頁</a>";
} else {
    $username = $_POST['uname'];
    $password = $_POST['upass'];

    if ( array_key_exists($username, $userpass) && $userpass[$username] == $password ) {
        
        // 登入成功後的美化內容
        echo "<div class='welcome-text'>$username 您好，登入成功！</div>";
        echo "<div class='input-form'>";
        echo "<h3>請填寫健康資料</h3>";
        echo "<form action='bmi.php' method='POST'>";
        echo "<div class='form-row'><label>身高 (m)</label><input type='text' name='height' required placeholder='例如：1.70'></div>";
        echo "<div class='form-row'><label>體重 (kg)</label><input type='text' name='weight' required placeholder='例如：65'></div>";
        echo "<input type='submit' value='計算我的 BMI'> ";
        echo "</form>";
        echo "</div>";
    } else {
        echo "<div class='error-msg'>[錯誤] 帳號或密碼錯誤</div>";
        echo "<a href='javascript:history.back()' class='back-link'>⬅ 重試</a>";
    }
} 
?>
</div>

</body>
</html>