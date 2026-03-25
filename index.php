<?php
//---------------- 設定相關變數 ------------------------
// 定義 $err_msg 變數，用以存放錯誤訊息
$err_msg = '';

// 設定收件者、標題
$to = 'service@flag.com.tw';
$subject = ' 使用者來函 ';

// 將標題以 UTF-8 編碼 (避免信件標題變亂碼)
mb_internal_encoding("UTF-8");
$subject = mb_encode_mimeheader($subject, 'UTF-8');

//---------------- 檢查表單各欄位是否已經輸入 ----------------
// 1. 檢查表單的 name 欄位是否已經輸入
$name = trim($_POST['name']);
if ( !empty($name) ) {
    $name = htmlspecialchars($name);
} else {
    $err_msg .= ' 您忘記輸入名字 <br>';
}

// 2. 檢查表單的 telephone 欄位是否已經輸入
$tel = trim($_POST['telephone']);
if ( !empty($tel) ) {
    $telephone = htmlspecialchars($tel);
} else {
    $err_msg .= ' 您忘記輸入電話 <br>';
}

// 3. 檢查表單的 email 欄位是否已經輸入
$email = trim($_POST['email']);
if ( !empty($email) ) {
    $email = htmlspecialchars($email);
} else {
    $err_msg .= ' 您忘記輸入電子郵件 <br>';
}

// 4. 檢查表單的 message 欄位是否已經輸入
$msg = trim($_POST['message']);
if ( empty($msg) ) {
    $err_msg .= ' 您忘記輸入留言 <br>';
}

//---------------- 發送電子郵件 ------------------------
// 若 $err_msg 是空字串，表示沒有錯誤發生，可以開始寄送電子郵件
if ($err_msg == '') {
    
    // 設定信件的內文
    $body = " 姓名： $name\n 電話： $telephone\n 留言： $msg";

    // 因為程式只有採用使用者輸入的 email 欄位做為參數，
    // 所以只需檢查 email 欄位中是否包含換行字元 (防止 Email 標頭注入攻擊)
    if (preg_match("/\r|\n/", $email)) {
        die(" 請勿輸入換行字元 ");
    }

    // 在電子郵件標頭設定信件內文為純文字格式，編碼為 UTF-8
    $header = 'Content-type: text/plain; charset=UTF-8';
    // 在電子郵件標頭中加上寄件者
    $header .= "\nFrom: $email";

    // 執行寄信動作
    if ( mail($to, $subject, $body, $header) ) {
        echo '<p> 信件傳送成功，我們會儘快回覆您，謝謝 </p>';
    } else {
        echo '<p> 傳送失敗！</p>';
    }

} else {
    // 如果有錯誤訊息，顯示出來並提供「回上一頁」的連結
    echo $err_msg . '<a href="' . $_SERVER['HTTP_REFERER'] . '"> 回上一頁 </a>';
}
?>