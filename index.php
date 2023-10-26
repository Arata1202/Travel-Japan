<?php
require "db.php";

//セキュリティー対策
header('X-Frame-Options: SAMEORIGIN');
session_start();
session_regenerate_id();

//トークンの生成
$toke_byte = openssl_random_pseudo_bytes(16);
$csrf_token = bin2hex($toke_byte);
$_SESSION['csrf_token'] = $csrf_token;

//直接アクセスの禁止
if (!isset ($_SESSION['user'] )){
    header('Location:guest.php');
}

//SQL接続
$pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
$regist = $pdo->prepare("SELECT * FROM japantravel order by created_at DESC limit 50");
$regist->execute();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Japan !</title>
    <link rel="stylesheet" href="CSS/index.css">
    <script src="JS/index.js" async></script>
</head>
<body>
    <div class="loader-bg">
        <div class="loader"></div>
    </div>

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
                    <div class="like_many">

                        <!--いいね機能　フォーム-->
                        <form action="love.php" method="POST" name="like_btn">
                            <input class="submit" type="submit" value="いいね！">
                        </form>
                        <!--     セッションに保存     -->
                        <?php
                        if(isset($_POST['submit'])){
                            $_SESSION['id'] = "$id";

                        }
                        ?>
                    </div>
                 </div>
             <div class="message">&nbsp;<?php echo $loop['contents']?></div>
             <div class="contents">&nbsp;<?php echo $loop['tag']?></div>
             <div class="contents">&nbsp;<?php echo $loop['created_at']?></div>
             
             <!--コメントするボタン-->
             <div class="urls">
                <form action="recentcomment.php" method="POST">
                    <input class="btn_s" type="submit" name="btn_s" value="コメント欄">


                </form>
                <!--     セッションに保存     -->
                    <?php
                    if(isset($_POST['btn_s'])){
                        $_SESSION['id'] = "$id";
                        $_SESSION['name'] = "$name";
                        $_SESSION['filename'] = "$filename";

                    }
                    ?>
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

        


        
        
        
        
 