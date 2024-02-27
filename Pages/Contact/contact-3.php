<?php
//セキュリティー対策
header('X-Frame-Options: SAMEORIGIN');
session_start();
session_regenerate_id();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>contact</title>
    <link rel="stylesheet" href="CSS/contact-3.css">
</head>
<body>
    
    <?php require "../../Layouts/header.php" ?>

    <!--メイン-->
    <h2 class="subtitle">＊お問い合わせ＊</h2>
    <p>
    お問い合わせありがとうございます。<br>
    内容を確認の上、ご連絡をさせていただきます。<br><br>
    ※メールが届かない場合はお手数ですが、<br>
    迷惑メールリストをご確認ください。
    </p>
    <div class="urls">
        <button onclick="location.href='../Index/home.php'">ホームに戻る</button>
    </div>

    <?php require "../../Layouts/footer.php" ?>

    <script src="JS/contact-3.js"></script>
</body>
</html>