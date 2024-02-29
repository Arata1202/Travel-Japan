<?php
//セキュリティー対策
header('X-Frame-Options: SAMEORIGIN');
session_start();
session_regenerate_id();

$toke_byte = openssl_random_pseudo_bytes(30);
$csrf_token = bin2hex($toke_byte);
$_SESSION['csrf_token'] = $csrf_token;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>contact</title>
    <link rel="stylesheet" href="CSS/contact-1.css">
</head>
<body>
    <?php require "../../Layouts/header.php" ?>
    <h2 class="subtitle">＊お問い合わせ＊</h2>
    <div class="box">
        <form action="contact-2.php" method="post">
            <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
            <div class="box_first">    
                <div class="require">
                    <h3>氏名</h3><p class="red">(*必須)</p>
                </div>
                <input type="text" name="name" value="" required size="30" placeholder="東洋　太郎" style="height:25px;">
                <div class="require">
                <h3>性別</h3><p class="red">(*必須)</p>
            </div>
            <input type="radio" name="sex" value="男性" required> 男性
            <input type="radio" name="sex" value="女性" required> 女性
            <input type="radio" name="sex" value="その他" required> その他
            <div class="box_first"> 
                <div class="require">
                    <h3>メールアドレス</h3><p class="red">(*必須)</p>
                </div>
                <input type="text" name="email" value="" required size="30" placeholder="example@example.jp" size="50" style="height:25px;">
                <div class="require">
                    <h3>題名</h3><p class="red">(*必須)</p>
                </div>
                <input type="text" name="title" value="" required size="30" placeholder="題名を記入" style="height:25px;">
                <div class="require">
                    <h3>お問い合わせ内容</h3><p class="red">(*必須)</p>
                </div>
                <textarea name="contact_body" value="" required rows="7"  cols="30" placeholder="具体的な内容を記入"></textarea>
            </div>
            <p><input class="submit" type="submit" name="submit" value="確認画面へ"></p>
        </form>
    </div>     
    <?php require "../../Layouts/footer.php" ?>
    <script src="JS/contact-1.js"></script>
</body>
</html>