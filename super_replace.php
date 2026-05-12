<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>字串尋找與取代工具 - 高級版</title>
    <style>
        /* --- 視覺與排版 CSS --- */
        body {
            font-family: "Microsoft JhengHei", Helvetica, Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }

        .main-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 600px;
        }

        h2 {
            color: #1a73e8;
            text-align: center;
            margin-top: 0;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #5f6368;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box; /* 確保 padding 不會撐破寬度 */
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #1a73e8;
            outline: none;
        }

        textarea {
            resize: vertical; /* 只允許垂直調整大小 */
            min-height: 120px;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .checkbox-group input {
            margin-right: 10px;
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        .button-group {
            display: flex;
            gap: 15px;
        }

        .btn {
            flex: 1;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.1s;
        }

        .btn:active {
            transform: scale(0.98);
        }

        .btn-submit {
            background-color: #1a73e8;
            color: white;
        }

        .btn-submit:hover {
            background-color: #1557b0;
        }

        .btn-reset {
            background-color: #f1f3f4;
            color: #5f6368;
        }

        .btn-reset:hover {
            background-color: #dadce0;
        }

        /* --- 結果區塊 CSS --- */
        .result-box {
            margin-top: 35px;
            padding: 25px;
            background-color: #e8f0fe;
            border-left: 5px solid #1a73e8;
            border-radius: 8px;
        }

        .result-box h3 {
            margin-top: 0;
            color: #1967d2;
        }

        .code-syntax {
            font-family: Consolas, "Courier New", monospace;
            background: #fff;
            padding: 10px;
            border-radius: 5px;
            display: block;
            margin: 15px 0;
            overflow-x: auto; /* 防止過長代碼撐破 */
        }

        .final-output {
            font-size: 18px;
            margin: 15px 0 0 0;
            white-space: pre-wrap; /* 保持輸出換行 */
        }
    </style>
</head>
<body>

<div class="main-card">
    <h2>字串取代工具</h2>
    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="form-group">
            <label for="str">原始字串：</label>
            <textarea name="str" id="str" required placeholder="請貼入您想處理的整段文字..."></textarea>
        </div>

        <div class="form-group">
            <label for="search">尋找字串：</label>
            <input type="text" name="search" id="search" required placeholder="要被取代的舊文字">
        </div>

        <div class="form-group">
            <label for="replace">取代為：</label>
            <input type="text" name="replace" id="replace" placeholder="要更換的新文字">
        </div>

        <div class="checkbox-group">
            <input type="checkbox" name="ignore_case" id="ignore_case">
            <label for="ignore_case" style="font-weight: normal; margin-bottom: 0;">尋找時忽略大小寫 (如 Apple = apple)</label>
        </div>

        <div class="button-group">
            <input type="reset" class="btn btn-reset" value="重設">
            <input type="submit" name="submit" class="btn btn-submit" value="送出並取代">
        </div>
    </form>

<?php
// --- 功能與邏輯 PHP ---
if (isset($_POST['str']) && isset($_POST['search']) && isset($_POST['replace'])) {
    
    // 1. 接收資料並進行基礎清理 (去除頭尾空白)
    $str = trim($_POST['str']);
    $search = trim($_POST['search']);
    $replace = $_POST['replace']; // 取代文字可能是空白，所以不 trim
    
    // 檢查大小寫勾選框狀態
    $ignoreCase = isset($_POST['ignore_case']);

    // 只有在必要資料不為空時才執行
    if ($str != '' && $search != '') {
        
        // 功能升級：使用第四個參數來接收「取代次數」
        $count = 0;
        
        // 功能升級：根據選項切換不同的 PHP 函數
        if ($ignoreCase) {
            // 使用「忽略大小寫」的函數 str_ireplace()
            $result = str_ireplace($search, $replace, $str, $count);
            $funcUsed = "str_ireplace";
        } else {
            // 使用「一般」的函數 str_replace()
            $result = str_replace($search, $replace, $str, $count);
            $funcUsed = "str_replace";
        }
        
        // --- 顯示結果區塊 ---
        echo "<div class='result-box'>";
        echo "<h3>執行結果</h3>";
        
        // 顯示使用的函數與參數
        echo "<span class='code-syntax'>";
        echo "<strong>語法：</strong> $funcUsed('$search', '$replace', '...原始字串...')";
        echo "</span>";
        
        // 顯示取代統計
        echo "<p>✓ 總共進行了 <strong>$count</strong> 次取代。</p>";
        echo "<hr style='border: 1px solid #cddcfc;'>";
        
        // 顯示最終輸出文字，並用 htmlspecialchars 防止使用者輸入的 HTML 語法破壞版面
        echo "<p class='final-output'>". htmlspecialchars($result) ."</p>";
        echo "</div>";
    }
}
?>
</div>

</body>
</html>