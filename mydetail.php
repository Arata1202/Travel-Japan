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
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>mypage</title>
    <link rel="stylesheet" href="CSS/mydetail.css">
    <script src="JS/mydetail.js" async></script>
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

    <h2 class="subtitle">＊詳細＊</h2>
        
    <?php 
    //エスケープ処理
    function h($str){
        return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
    }
    //投稿番号
    $num = $_POST['num'];
    $_SESSION['num'] = $num;
    
    if (isset($_POST["num"])) {
        
        //SQL接続　SELECT
        $pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
        $stmt = $pdo->prepare("SELECT * FROM japantravel WHERE id = '$num'");
        $stmt->execute();
    } else {    
        echo "error";
    }
    ?>
    <!--投稿内容の表示-->
    <section class="box">
		<?php foreach($stmt as $loop):?>
            <div class="spot">
                 <p class="name"><b>&nbsp;<?php echo $loop['name']?></b></p>
                 <div class="prefecture">
                     <p><?php echo $loop['prefecture']?></p>
                     <p>&nbsp;<?php echo $loop['place']?>&nbsp;</p>
                 </div>
             </div>
             <img src="images/<?php echo $loop['filename']?>" alt="" style="width:100%;">
             
             <!--いいね機能-->
             <div class="iine">
                <div class="many">&nbsp;いいね！ : <?php echo $loop['likes']?>件</div>
            </div>       
             <div class="message">&nbsp;<?php echo $loop['contents']?></div>
             <div class="contents">&nbsp;<?php echo $loop['created_at']?></div>
             
             <!--コメントボタン-->
             <div class="urls">
                <button onclick="history.back(-1)">戻る</button>
                <button class="submit" onclick="location.href='contentschange.php'">編集</button>
                <button class="delete" onclick="location.href='delete.php'">削除</button>
            </div>
             </div>
             <hr>
		<?php endforeach;?>
    </section>

    <!--投稿内容の表示-->
    <section class="box">
		<?php foreach($stmt as $loop):?>
            
        <div class="spot">
            <p class="name"><b>&nbsp;<?php echo $loop['name']?></b></p>
            <div class="prefecture">
                <p><?php echo $loop['prefecture']?></p>
                <p>&nbsp;<?php echo $loop['place']?>&nbsp;</p>
            </div>
        </div>
 
        <img src="images/<?php echo $loop['filename']?>" alt="" style="width:100%;">
        
        <div class="iine">
           <div>いいね : <?php echo $loop['likes']?>件</div>
        </div>
        <div class="message"><?php echo $loop['contents']?></div>
        <div class="contents">&nbsp;<?php echo $loop['tag']?></div>
        <div class="contents">&nbsp;<?php echo $loop['created_at']?></div>
        
        <div class="urls">
            <button onclick="history.back(-1)">戻る</button>
            <button class="submit" onclick="location.href='contentschange.php'">編集</button>
            <button class="delete" onclick="location.href='delete.php'">削除</button>
        </div>
        <hr>
       
        <?php endforeach;?>
    </section>

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