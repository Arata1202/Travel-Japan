<?php
//セキュリティー対策・セッション　＊
header('X-Frame-Options: SAMEORIGIN');
session_start();
session_regenerate_id();

//トークンの生成
$toke_byte = openssl_random_pseudo_bytes(16);
$csrf_token = bin2hex($toke_byte);
$_SESSION['csrf_token'] = $csrf_token;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>login</title>
    <link rel="stylesheet" href="CSS/form.css">
    <link rel="manifest" href="manifest.webmanifest" />
    <link rel="apple-touch-icon" sizes="180x180" href="icon-192x192.png">
    <script src="JS/form.js" async></script>
    <script>
        window.addEventListener('load', function () {
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register("/sw.js")
                    .then(function (registration) {
                        console.log("serviceWorker registed.");
                    }).catch(function (error) {
                        console.warn("serviceWorker error.", error);
                    });
            }
        });
    </script>
</head>
<body>
    <!--ヘッダー周り-->
    <header>
        <h1 class="title">&nbsp;Travel Japan !</h1>
    </header>

    <h2 class="subtitle">＊ログイン＊</h2>
    
    <!--入力フォーム-->
    <div class="box">
        <form action="ok.php" method="post">
            
            <!--トークンの送信-->
            <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
            <div class="flex_box">
                <h3>会員ID</h3><p class="red">(*必須)</p>
            </div>
            <input type="text" name="user" required size="30" placeholder="xyz123" style="height:25px;">
            <div class="flex_box">
                <h3>パスワード</h3><p class="red">(*必須)</p>
            </div>
            <input type="password" name="password" required size="30" placeholder="Abc456" style="height:25px;">
            <br>
            <br><p><input class="submit" type="submit" value="ログイン"></p>
        </form>    
    </div>
    <div class="urls">
        <br><button onclick="location.href='submit.php'">新規会員登録はこちら</button>
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