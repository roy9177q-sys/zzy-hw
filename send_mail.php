<?php
//---------------- 設定相關變數 ------------------------
// 定義 $err_msg 變數，用以存放錯誤訊息
$err_msg = '';

// 設定收件者、標題 (請改成你自己的信箱來測試，或者維持預設)
$to = 'service@flag.com.tw';
$subject = ' 使用者來函 ';

// 將標題以 UTF-8 編碼
mb_internal_encoding("UTF-8");
$subject = mb_encode_mimeheader($subject, 'UTF-8');

//---------------- 檢查表單各欄位是否已經輸入 ----------------
// 1. 檢查 name 欄位
$name = trim($_POST['name']);
if ( !empty($name) ) {
    $name = htmlspecialchars($name);
} else {
    $err_msg .= ' 您忘記輸入名字 <br>';
}

// 2. 檢查 telephone 欄位
$tel = trim($_POST['telephone']);
if ( !empty($tel) ) {
    $telephone = htmlspecialchars($tel);
} else {
    $err_msg .= ' 您忘記輸入電話 <br>';
}

// 3. 檢查 email 欄位
$email = trim($_POST['email']);
if ( !empty($email) ) {
    $email = htmlspecialchars($email);
} else {
    $err_msg .= ' 您忘記輸入電子郵件 <br>';
}

// 4. 檢查 message 欄位
$msg = trim($_POST['message']);
if ( empty($msg) ) {
    $err_msg .= ' 您忘記輸入留言 <br>';
}

//---------------- 發送電子郵件 ------------------------
// 若 $err_msg 是空字串，表示沒有錯誤發生，可以開始寄送
if ($err_msg == '') {
    
    // 設定信件的內文
    $body = "姓名： $name\n電話： $telephone\n留言： $msg";

    // 檢查 email 欄位中是否包含換行字元 (防止安全漏洞)
    if (preg_match("/\r|\n/", $email)) {
        die(" 請勿輸入換行字元 ");
    }

    // 設定標頭、格式與寄件者
    $header = 'Content-type: text/plain; charset=UTF-8';
    $header .= "\nFrom: $email";

    // 執行寄信動作
    if ( mail($to, $subject, $body, $header) ) {
        echo '<h3 style="color: green;">信件傳送成功，我們會儘快回覆您，謝謝！</h3>';
        echo '<a href="contact.html">回填寫表單</a>';
    } else {
        echo '<h3 style="color: red;">傳送失敗！您的本機環境可能尚未設定 SMTP 伺服器。</h3>';
        echo '<a href="javascript:history.back()">回上一頁</a>';
    }

} else {
    // 如果有錯誤訊息，顯示出來並提供「回上一頁」的連結
    echo "<div style='color: red; font-weight: bold;'>$err_msg</div>";
    echo '<br><a href="' . $_SERVER['HTTP_REFERER'] . '">回上一頁重新填寫</a>';
}
?>