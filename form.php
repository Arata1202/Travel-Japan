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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="CSS/form.css">
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
            <p><input type="text" name="user" required size="30" placeholder="xyz123" style="height:25px;"></p>
            <div class="flex_box">
                <h3>パスワード</h3><p class="red">(*必須)</p>
            </div>
            <p><input type="password" name="password" required size="30" placeholder="Abc456" style="height:25px;"></p>
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