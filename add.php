<?php
//セキュリティー対策
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
    <title>add</title>
    <link rel="stylesheet" href="CSS/add.css">
    <script src="JS/add.js" async></script>
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
        <!--ハンバーガー-->
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

    <h2 class="subtitle">＊新規投稿＊</h2>
        
    <!--入力フォーム-->
    <div class="box">
        <form action="confirm.php" method="post" enctype="multipart/form-data">
             <input type="hidden" name="name" value="<?php echo $_SESSION['user'] ?>" ><br>
             <h3>都道府県</h3>
             <input type="text" name="prefecture" value="" placeholder="例 : 神奈川県" size="30" required style="height:25px;"><br>
             <h3>観光地名称</h3>
             <input type="text" name="place" value="" placeholder="例 : 箱根温泉" size="30" required style="height:25px;"><br>
             <h3>コメント</h3>
             <textarea name="contents" value="" placeholder="例 : 箱根温泉へ行きました。" rows="5" cols="30"></textarea><br>
             <br>
             <input type="file" name="upload_image" size="30" required style="height:25px;">
             <br>

             <!--トークンの送信-->
             <input type="hidden" name="csrf_token" value="<?php echo $csrf_token;?>">
             <button class="submit" type="submit">投稿</button>
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