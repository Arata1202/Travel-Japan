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

//トークンの一致確認
if (isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION['csrf_token']) {
    
    //エスケープ処理
    function h($str){
        return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
    }
    //変数定義
    date_default_timezone_set('Asia/Tokyo');
    $created_at=date("Y-m-d H:i:s");
    $id=h($_POST["id"]);
    $num=h($_POST["num"]);
    $comment=h($_POST['comment']);
    $filename=h($_POST["filename"]);
    $csrf_token=h($_POST["csrf_token"]);
}else{
    header('Location:form.php');
}
$name = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>comment</title>
    <link rel="stylesheet" href="CSS/searchcommentok.css">
    <script src="JS/searchcommentok.js" async></script>
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
    
    <!--サブタイトル-->
    <h2 class="subtitle">＊コメント＊</h2>
    <p>コメントを投稿しました。</p>
    
    <!--戻る用フォーム-->
    <form action="searchyourcomment.php" method="POST">
        <!--トークンの送信-->
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token;?>">
        
        <input type="hidden" name="num" value="<?php echo $num ?>">
        <input type="hidden" name="name" value="<?php echo $loop['name'] ?>">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="hidden" name="filename" value="<?php echo $filename ?>">
        <input class="submit" type="submit" value="コメントを見る">
    </form>
    <?php

    //SQL　コメント内容保存
    if (isset($_POST["comment"])) {
        $dbh = new PDO($dsn,$user,$password);
        $stmt = $dbh->prepare("INSERT INTO comment(id, name, comment, created_at) VALUES (:id,:name,:comment,:created_at)");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->execute();
    } 
    ?>
                
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