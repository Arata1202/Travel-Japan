<?php
require "db.php";

//セキュリティー対策
header('X-Frame-Options: SAMEORIGIN');
session_start();
session_regenerate_id();

//SQL接続
$pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
$regist = $pdo->prepare("SELECT * FROM japantravel order by created_at DESC limit 50");
$regist->execute();
?>
 
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>guest</title>
    <link rel="stylesheet" href="CSS/guest.css">
    <link rel="manifest" href="manifest.webmanifest" />
    <link rel="apple-touch-icon" sizes="180x180" href="icon-192x192.png">
    <script src="JS/guest.js" async></script>
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
        <h1 class="title"><a href="">&nbsp;Travel Japan !</a></h1>
    </header> 
        
    <h2 class="subtitle">＊最新の投稿＊</h2>
           
    <!--投稿内容の表示-->
    <section class="box">
        <?php foreach($regist as $loop):?>
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
         <div class="contents">&nbsp;<?php echo $loop['tag']?></div>
         <div class="contents">&nbsp;<?php echo $loop['created_at']?></div>
         <hr>
        <?php endforeach ?>
    </section>
      
    <!--ボトムメニュー-->
    <footer>
        <ul class="under_menu">
            <li><a href="guest.php">ホーム</a></li>
            <li><a href="form.php">ログイン</a></li>
            <li><a href="gcontactform.php">お問い合わせ</a></li>           
        </ul>
    </footer>

    <!--     jQuery     -->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript">

        $(function(){
            $(window).on('load',function(){
                $('.loader').delay(500).fadeOut(500);
                $('.loader-bg').delay(800).fadeOut(700);
            });
            setTimeout(function(){
                $('.loader-bg').fadeOut(500);
            },5000);
        });
    </script>
</body>
</html>