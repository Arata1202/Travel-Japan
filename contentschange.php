<?php
require "db.php";

//セキュリティー対策・セッション　＊
header('X-Frame-Options: SAMEORIGIN');
session_start();
session_regenerate_id();

//直接アクセスの禁止
if (!isset ($_SESSION['user'] )){
    header('Location:home.php');
}

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
    <title>change</title>
    <link rel="stylesheet" href="CSS/contentschange.css">
    <script src="JS/contentschange.js" async></script>
    <link rel="manifest" href="manifest.webmanifest" />
    <link rel="apple-touch-icon" sizes="180x180" href="icon-192x192.png">
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
        <!--ハンバーガーメニュー-->
        <div class="humberger">
            <div class="btn">
                <i></i>
                <i></i>
                <i></i>
            </div>
            <div class="block">
                <div class="list">
                    <ul>
                        <li style="color:deepskyblue;"><h5>＊<?php echo $_SESSION['user'] ?>様,ようこそ＊</h5></li>
                        <br>
                        <li><h5><a href="about.php">＊Travel Japan ! とは</a></h5></li>
                        <li><h5><a href="mypage.php">＊マイページ</a></h5></li>
                        <li><h5><a href="ranking.php">＊ランキング</a></h5></li>
                        <li><h5><a href="privacy.php">＊プライバシーポリシー</a></h5></li>
                        <li><h5><a href="contactform.php">＊お問い合わせ</a></h5></li>
                    </ul>
                </div>
            </div>
        </div>

        <!--タイトル-->
        <h1 class="title">&nbsp;Travel Japan !</h1>
    </header> 

    <h2 class="subtitle">＊編集＊</h2>
    <?php

    //投稿番号
    $num = $_SESSION['num'];
    
    //SQL接続　SELECT
    if (isset($_SESSION["num"])) {
        $pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
        $stmt = $pdo->prepare("SELECT * FROM japantravel WHERE id = '$num'");
        $stmt->execute();
    } else {    
        echo "error";
    }
    ?>
    <div class="box">
        <form action="contentscheck.php" method="POST">
            <!--トークンの送信-->
            <input type="hidden" name="csrf_token" value="<?=$csrf_token?>">
            
            <!--投稿番号-->
            <input type="hidden" name="num" value="<?php echo $num ?>">
    
            <!--変更フォーム-->
            <?php foreach($stmt as $loop):?>
    
            <p><img src="images/<?php echo $loop['filename'];?>"></p>
            <h3>都道府県</h3>
            <p><input type="text" name="prefecture" value="<?php echo $loop['prefecture']?>" required size="30" style="height:25px;"></p>
            <h3>観光地名称</h3>
            <p><input type="text" name="place" value="<?php echo $loop['place']?>" required size="30" style="height:25px;"></p>
            <h3>コメント</h3>
            <p><textarea name="contents" rows="5" cols="30"><?php echo $loop['contents']?></textarea></p>
            <h3>タグ</h3>
            <p><input type="text" name="tag" value="<?php echo $loop['tag']?>" required size="30" style="height:25px;"></p>
            <input type="hidden" name="img" value="<?php echo $loop['filename']?>">
            
            <div class="urls">
                <button class="submit" type="submit">編集</button>
            </div>
    
            <?php endforeach;?>
    
        </form>
    </div>
        
    <!--ボトムメニュー-->
    <footer>
        <ul class="under_menu">
            <li><a href="index.php">ホーム</a></li>
            <li><a href="add.php">投稿する</a></li>
            <li><a href="search.php">検索</a></li>
        </ul>
    </footer>
</body>
</html>