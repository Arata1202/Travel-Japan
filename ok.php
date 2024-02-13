<?php
require "db.php";

//セキュリティー対策・セッション　＊
header('X-Frame-Options: SAMEORIGIN');
session_start();
session_regenerate_id();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>login</title>
    <link rel="stylesheet" href="CSS/ok.css">
    <link rel="manifest" href="manifest.webmanifest" />
    <link rel="apple-touch-icon" sizes="180x180" href="icon-192x192.png">
    <script src="JS/ok.js" async></script>
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
        <h1 class="title"><a href="guest.php">&nbsp;Travel Japan !</a></h1>
    </header>

    <!--エスケープ処理-->
    <?php
    function h($str){
        return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
    }
    $member=h($_POST["user"]);
    $pass=h($_POST["password"]);

    //MySQL接続
    if(isset($member)) {
        
        //トークンの一致チェック
        if (isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION['csrf_token']) {
            $dbh = new PDO($dsn_s,$user,$password);
            $stmt = $dbh->prepare("SELECT * FROM user WHERE id=:user");
            $stmt->bindParam(':user', $member);
            $stmt->execute();
        }else{
            header('Location:form.php');
        }
        if($rows = $stmt->fetch()) {
            if($rows["password"] ==  $pass) {
                header('Location:index.php');
                $_SESSION['user'] = $member;
            }else {
                print "<h2>＊ログイン＊</h2><h3>IDまたはパスワードが間違っています。<br>もう一度ログインしてください。</h3>";
            }
        }else {
            print "<h2>＊ログイン＊</h2><h3>IDまたはパスワードが間違っています。<br>もう一度ログインしてください。</h3>";
        }
    }
    ?>
    <div class="urls">
        <br><br><button onclick="location.href='form.php'">ログインページに戻る</button>
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