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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>
    <link rel="stylesheet" href="CSS/gcontactcomplete.css">
</head>
<body>
    <header>
        <!--タイトル-->
        <h1 class="title"><a href="">&nbsp;Travel Japan !</a></h1>
    </header> 

    <!--メイン-->
    <h2 class="subtitle">＊お問い合わせ＊</h2>
    <p>
    お問い合わせありがとうございます。<br>
    内容を確認の上、ご連絡をさせていただきます。<br><br>
    ※メールが届かない場合はお手数ですが、<br>
    迷惑メールリストをご確認ください。
    </p>
    <div class="urls">
        <button onclick="location.href='guest.php'">ホームに戻る</button>
    </div>

    <!--ボトムメニュー-->
    <footer>
        <ul class="under_menu">
            <li><a href="guest.php">ホーム</a></li>
            <li><a href="form.php">ログイン</a></li>
            <li><a href="gcontactform.php">お問い合わせ</a></li>
        </ul>
    </footer>
</body>
</html>