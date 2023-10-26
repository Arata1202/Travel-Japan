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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search</title>
    <link rel="stylesheet" href="CSS/searchdetail.css">
    <script src="JS/searchdetail.js" async></script>
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
    
    //投稿番号
    $_SESSION['num'] = $_POST['num'];
    $num = $_SESSION['num'] ;

    //SQL SELECT
    if (isset($_POST["num"])) {
        $pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
        $stmt = $pdo->prepare("SELECT * FROM japantravel WHERE id = '$num'");
        $stmt->execute();
    } else {    
        echo "error";
    }
    ?>

    <!--詳細画面の表示-->
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
             
             <!--いいね機能 フォーム-->
             <div class="iine">
                 <div class="many">&nbsp;いいね！ : <?php echo $loop['likes']?>件</div>
                    <div class="like_many">

                        <!--いいね機能　フォーム-->
                        <form action="searchlove.php" method="POST" name="like_btn">
                            <input type="hidden" name="id" value="<?php echo $loop['id']; ?>">
                            <input class="submit" type="submit" value="いいね！">
                        </form>
                    </div>
                 </div>
             <div class="message">&nbsp;<?php echo $loop['contents']?></div>
             <p class="contents">&nbsp;<?php echo $loop['tag']?></div>
             <p class="contents">&nbsp;<?php echo $loop['created_at']?></div>
             <div class="urls">
                 <div class="urls">
                     <button onclick="location.href='search.php'">戻る</button>
                    <form action="searchcomment.php" method="POST">
                    
                        <!--トークンの送信-->
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token;?>">
                        <input type="hidden" name="id" value="<?php echo $loop['id']; ?>">
                        <input type="hidden" name="name" value="<?php echo $loop['name']; ?>">
                        <input type="hidden" name="filename" value="<?php echo $loop['filename']; ?>">
                        <input class="btn-s" type="submit" value="コメント欄">
                    </form>
                </div>
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