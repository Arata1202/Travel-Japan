<?php
//セキュリティー対策・セッション　＊
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
    <title>change</title>
    <link rel="stylesheet" href="CSS/changecheck.css">
    <script src="JS/changecheck.js" async></script>
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
    <?php

    //トークンの一致確認
    if (isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION['csrf_token']) {
        
        //エスケープ処理
        function h($str){
            return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
        }
        $name=h($_POST["name"]);
        $id=h($_POST["id"]);
        $address=h($_POST["address"]);
        $tel=h($_POST["tel"]);
        $password=h($_POST["password"]);
        $csrf_token=h($_POST["csrf_token"]);
    }else{
        header('Location:form.php');
    }
    ?>
    <h2 class="subtitle">＊登録情報変更＊</h2>

    <!--確認フォーム-->
    <form action="changecomplete.php" method="post">   
        <p>内容をご確認の上、<br>宜しければ登録してください。</p>
        <div class="box">
            <h3>氏名</h3>
            <p><?php echo $name ?><p>
            <h3>メールアドレス</h3>
            <p><?php echo $address ?><p>
            <h3>会員ID</h3>
            <p><?php echo $id ?><p>
            <h3>パスワード</h3>
            <p>表示されません<p>
            <h3>電話番号</h3>
           <p><?php echo $tel ?><p>
        </div>

        <!--ボタン-->
        <div class="flex_box">
            <input class="btn_s" type="button" value="内容を修正する" onclick="history.back(-1)">
            <button class="submit" type="submit" name="add">登録する</button>
        </div>
        
        <!--トークンの送信-->
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token;?>">

        <input type="hidden" name="name" value="<?php echo $name;?>">
        <input type="hidden" name="password" value="<?php echo $password;?>">
        <input type="hidden" name="address" value="<?php echo $address;?>">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <input type="hidden" name="tel" value="<?php echo $tel;?>">
    </form>
    
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