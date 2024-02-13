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
    <link rel="stylesheet" href="CSS/contentscheck.css">
    <script src="JS/contentscheck.js"></script>
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
        $prefecture=h($_POST["prefecture"]);
        $place=h($_POST["place"]);
        $contents=h($_POST["contents"]);
        $tag=h($_POST["tag"]);
        $img=h($_POST["img"]);
        $num=h($_POST["num"]);
        $csrf_token=h($_POST["csrf_token"]);
    }else{
        header('Location:form.php');
    }
    ?>

    <h2 class="subtitle">＊編集＊</h2>

    <!--確認フォーム-->
    <form action="contentscomplete.php" method="POST">   
        <p class="smalltitle">以下の内容で投稿します<br>宜しければ変更してください。</p>
        <div class="box">
            <p><img src="images/<?php echo $img ?>"></p>
            
            <h3>都道府県</h3>
            <p><?php echo $prefecture ?><p>
            <input type="hidden" name="prefecture" value="<?php echo $prefecture ?>">
            
            <h3>観光地名称</h3>
            <p><?php echo $place ?><p>
            <input type="hidden" name="place" value="<?php echo $place ?>">
            
            <h3>コメント</h3>
            <p><?php echo $contents ?><p>
            <input type="hidden" name="contents" value="<?php echo $contents ?>">
            
            <input type="hidden" name="num" value="<?php echo $num ?>">
        </div>

        <div class="flex_box">
            <input class="btn_s" type="button" value="内容を修正する" onclick="history.back(-1)">
            <button class="submit" type="submit" name="add">変更</button>
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