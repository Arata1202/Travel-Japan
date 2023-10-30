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
    <title>submit</title>
    <link rel="stylesheet" href="CSS/complete.css">
    <link rel="manifest" href="manifest.webmanifest" />
    <link rel="apple-touch-icon" sizes="180x180" href="icon-192x192.png">
    <script src="JS/complete.js" async></script>
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

    <?php
    //トークン一致確認
    if (isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION['csrf_token']) {

        //エスケープ処理
        function h($str){
            return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
        }
        $id = h($_POST["id"]);
        $name = h($_POST["name"]);
        $pass = h($_POST["password"]);
        $address = h($_POST["address"]);
        $tel = h($_POST["tel"]);
        
        //MySQL接続
        $pdo = new PDO($dsn_s,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
        $regist = $pdo->prepare("INSERT INTO user(id, name, password, address, tel) VALUES (:id,:name,:password,:address,:tel)");
        $regist->bindParam(":id", $id);
        $regist->bindParam(":name", $name);
        $regist->bindParam(":password", $pass);
        $regist->bindParam(":address", $address);
        $regist->bindParam(":tel", $tel);
        $regist->execute();
    }else{
        header('Location:submit.php');
    }
    ?>

    <h2 class="subtitle">＊新規会員登録＊</h2>
        <p class="smalltitle">新規会員登録完了。<br>ログインページより、ログインしてください。</p>
        <div class="urls">
            <br><button onclick="location.href='form.php'">ログインページ</button>
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