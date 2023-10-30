<?php
require "db.php";

//セキュリティー対策
header('X-Frame-Options: SAMEORIGIN');
session_start();
session_regenerate_id();

//直接アクセスの禁止
if (!isset ($_SESSION['user'] )){
    header('Location:home.php');
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>add</title>
    <link rel="stylesheet" href="CSS/confirm.css">
    <script src="JS/confirm.js" async></script>
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
            <script>
                'use strict'
                const btn = document.querySelector('.btn');
                const block = document.querySelector('.block');
                btn.addEventListener('click', () => {
                    btn.classList.toggle('active');
                    block.classList.toggle('active');
                });
            </script>
        </div>
        <!--タイトル-->
        <h1 class="title">&nbsp;Travel Japan !</h1>
    </header>

    <!--画面表示部分-->
    <h2 class="subtitle">＊新規投稿＊</h2>
    <section class="box">
         <p>投稿ありがとうございます。</p><br>
         <button class="submit" onclick="location.href='index.php'">ホームに戻る</button>
    </section>
    
    <?php

    //ファイルチェック
    if(!empty($_FILES)){

        //トークンの一致確認
        if (isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION['csrf_token']) {
            $filename = $_FILES['upload_image']['name'];
            $uploaded_path = 'images/'.$filename;
            $result = move_uploaded_file($_FILES['upload_image']['tmp_name'],$uploaded_path);
        }else{
            header('Location:form.php');
        }
        if($result){
            $MSG = 'images'.$filename;
            $img_path = $uploaded_path;
        }else{
            $MSG = 'アップロード失敗！エラーコード：'.$_FILES['upload_image']['error'];
        }
    }else{
        $MSG = '画像を選択してください';
    }
    
    //エスケープ処理
    function h($str){
        return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
    }
    //変数代入
    date_default_timezone_set('Asia/Tokyo');
    $created_at = date("Y-m-d H:i:s");
    $id = null;
    $name = h($_POST["name"]);
    $contents = h($_POST["contents"]);
    $tag = h($_POST["tag"]);
    $place = h($_POST["place"]);
    $prefecture = h($_POST["prefecture"]);
    
    //MySQL接続
    $pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
    $regist = $pdo->prepare("INSERT INTO japantravel(id, name, contents, created_at, tag, place, prefecture, filename) VALUES (:id,:name,:contents,:created_at,:tag,:place,:prefecture,:filename)");
    $regist->bindParam(":id", $id);
    $regist->bindParam(":name", $name);
    $regist->bindParam(":contents", $contents);
    $regist->bindParam(":tag", $tag);
    $regist->bindParam(":place", $place);
    $regist->bindParam(":prefecture", $prefecture);
    $regist->bindParam(":created_at", $created_at);
    $regist->bindParam(":filename", $filename);
    $regist->execute();
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