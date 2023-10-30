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
    <title>submit</title>
    <link rel="stylesheet" href="CSS/submit.css">
    <link rel="manifest" href="manifest.webmanifest" />
    <link rel="apple-touch-icon" sizes="180x180" href="icon-192x192.png">
    <script src="JS/submit.js" async></script>
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
    <header>
        
        <!--タイトル-->
        <h1 class="title">&nbsp;Travel Japan !</h1>
    </header> 

    <!--メイン-->
    <h2 class="subtitle">＊新規会員登録＊</h2>
    <div class="box">
        <form action="answer.php" method="post">
            <div class="flex_box">    
                <div class="require">
                    <h3>氏名</h3><p class="black">(*任意)</p>
                </div>
                <input type="text" name="name" value="" size="30" placeholder="東洋　太郎" style="height:25px;">
                <div class="require">
                    <h3>メールアドレス</h3><p class="black">(*任意)</p>
                </div>
                <input type="email" name="address" value="" size="30" placeholder="example@example.jp" size="50" style="height:25px;">
                <div class="require">
                    <h3>会員ID</h3><p class="red">(*必須)</p>
                </div>
                <input type="text" name="id" value="" required size="30" placeholder="example1234" size="50" style="height:25px;">
                <div class="require">
                    <h3>パスワード</h3><p class="red">(*必須)</p>
                </div>
                <input type="password" name="password" value="" required size="30" placeholder="Example1234" size="50" style="height:25px;">
                <div class="require">
                    <h3>電話番号</h3><p class="black">(*任意)</p>
                </div>
                <input type="tel" name="tel" value="" size="30" placeholder="0120999888" size="50" style="height:25px;">
                <p><input class="submit" type="submit" name="submit" value="確認画面へ"></p>

                <!--トークンの送信-->
                <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
            </div>
        </form>
        <div class="urls">
            <br><button onclick="location.href='form.php'">既にアカウントをお持ちの方はこちら</button>
        </div>
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