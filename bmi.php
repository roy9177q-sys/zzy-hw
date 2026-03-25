<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <title>您的 BMI 結果與體重建議</title>
    <style>
        /* --- 視覺美化 CSS --- */
        body {
            font-family: "Microsoft JhengHei", Arial, sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .result-card {
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 450px; /* 稍微加寬以容納建議文字 */
            text-align: center;
        }

        h2 { color: #333; margin-top: 0; }
        
        /* 狀態色塊 CSS */
        .status-box {
            font-size: 24px;
            font-weight: bold;
            padding: 15px;
            border-radius: 8px;
            margin: 20px 0;
            color: white;
        }
        
        .underweight { background-color: #3498db; box-shadow: 0 4px #2980b9; } 
        .normal { background-color: #2ecc71; box-shadow: 0 4px #27ae60; }      
        .overweight { background-color: #e74c3c; box-shadow: 0 4px #c0392b; }  
        
        /* 💡 新增：建議區塊的樣式 */
        .advice-box {
            background-color: #fcf8e3; /* 淺黃底色 */
            border-left: 6px solid #f1c40f; /* 左側黃色粗邊框 */
            padding: 15px;
            margin-top: 25px;
            border-radius: 5px;
            text-align: left; /* 文字靠左對齊方便閱讀 */
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }

        .back-btn { 
            margin-top: 25px; 
            display: inline-block; 
            padding: 12px 25px; 
            background-color: #f1f3f4; 
            color: #555; 
            text-decoration: none; 
            border-radius: 8px; 
            font-weight: bold; 
            transition: background-color 0.3s; 
        }
        .back-btn:hover { background-color: #e2e6ea; }
        .error-msg { color: #e74c3c; }
    </style>
</head>
<body>

<div class="result-card">
<?php
// 接收表單資料
$h = isset($_POST['height']) ? $_POST['height'] : null;
$w = isset($_POST['weight']) ? $_POST['weight'] : null;

if ( is_numeric($h) && is_numeric($w) && $h > 0 ) {
    
    // 1. 計算 BMI (取到小數第二位)
    $bmi = round($w / ($h * $h), 2);

    echo "<h2>您的計算結果</h2>";
    echo "<p style='font-size: 1.2em; color:#555;'>身高：<strong>{$h}</strong> m ｜ 體重：<strong>{$w}</strong> kg</p>";
    echo "<hr style='border: 1px solid #eee;'>";
    echo "<div style='margin-top: 15px;'>您的 BMI 值為：<strong style='font-size:2em; color:#2c3e50;'>$bmi</strong></div>";

    // 2. 邏輯判斷、狀態美化與【增減體重計算】
    if ( $bmi < 18.5 ) {
        echo "<div class='status-box underweight'>[ 體重過輕 ]</div>";
        
        // 算出達到 18.5 需要的體重，並扣掉目前體重
        $target_weight = 18.5 * ($h * $h);
        $need_to_gain = round($target_weight - $w, 1); 
        
        echo "<div class='advice-box'>";
        echo "<strong style='color: #d35400;'>💡 貼心建議：</strong><br>";
        echo "您的體重過輕了！為了健康，建議您需要再增重大約 <strong style='color:#e74c3c; font-size:1.3em;'>{$need_to_gain}</strong> 公斤，才能達到標準下限喔！";
        echo "</div>";

    } elseif ( $bmi > 23 ) {
        echo "<div class='status-box overweight'>[ 體重過重 ]</div>";
        
        // 算出降到 23 需要的體重，並用目前體重去扣
        $target_weight = 23 * ($h * $h);
        $need_to_lose = round($w - $target_weight, 1); 
        
        echo "<div class='advice-box'>";
        echo "<strong style='color: #c0392b;'>💡 貼心建議：</strong><br>";
        echo "您的體重超標囉！為了減輕身體負擔，建議您需要減去大約 <strong style='color:#e74c3c; font-size:1.3em;'>{$need_to_lose}</strong> 公斤，才能回到標準上限喔！";
        echo "</div>";

    } else {
        echo "<div class='status-box normal'>[ 體重正常 ]</div>";
        
        // 正常狀態的專屬樣式 (綠色系)
        echo "<div class='advice-box' style='border-left-color: #2ecc71; background-color: #eafaf1;'>";
        echo "<strong style='color: #27ae60;'>💡 貼心建議：</strong><br>";
        echo "太棒了！您的體態非常標準，請繼續保持目前的飲食與運動習慣！";
        echo "</div>";
    }

} else {
    echo "<div class='error-msg'><h3>⚠️ 錯誤</h3><p>請確認從上一頁正確輸入身高與體重數值！</p></div>";
}
?>
    <a href="javascript:history.back()" class="back-btn">⬅ 返回重新計算</a>
</div>

</body>
</html>