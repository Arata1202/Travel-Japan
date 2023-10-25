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

$sessionid = $_SESSION['user'];

//SQL接続
$pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
$regist = $pdo->prepare("SELECT * FROM japantravel WHERE name = '$sessionid' order by created_at DESC limit 50");
$regist->execute();

//SQL接続
$stmt = $pdo->prepare("SELECT * FROM japantravel WHERE name = '$sessionid' order by created_at DESC limit 50");
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mypage</title>
    <link rel="stylesheet" href="CSS/mypage.css">
    <script src="JS/mypage.js" async></script>
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
                        <li><h5><a href="favorite.php">＊お気に入り</a></h5></li>
                        <li><h5><a href="privacy.php">＊プライバシーポリシー</a></h5></li>
                        <li><h5><a href="contactform.php">＊お問い合わせ</a></h5></li>
                    </ul>
                </div>
            </div>
        </div>

        <!--タイトル-->
        <h1 class="title">&nbsp;Travel Japan !</h1>
    </header> 

    <h2 class="subtitle">＊マイページ＊</h2>
    
    <!--サブタイトル　ボタン-->
    <div class="top">
        <h2 style="color:deepskyblue;">ログイン中 : <?php echo $_SESSION['user'] ?></h2>
        <div class="urls">
            <br><br><button onclick="location.href='mymember.php'">登録情報</button>
            <button class="out" onclick="location.href='outconfirm.php'">ログアウト</button>
        </div>
    </div>

    <!--投稿内容の表示-->
    <section class="box">
        <br><h3>投稿一覧</h3>

        <?php foreach($regist as $loop):
        $pic_num =  $loop['id'];
        ?>
        <table>
            <tr>
                <td width="40%"><img src="images/<?php echo $loop['filename']?>" alt="" width="100%"></td>
                <td width="45%"><?php echo $loop['prefecture']?><br><?php echo $loop['place']?><br>いいね : <?php echo $loop['likes']?>件<br><?php echo $loop['created_at']?></td>
           
            <form action="mydetail.php" method="POST">
                <input type="hidden" name="num" value="<?php echo $loop['id']; ?>">
                <td width="20%"><input class="submit" type="submit" name="submit" value="詳細"></td>
            </form>
        </tr>
        </table>
        <hr>
        <?php endforeach;?>
    </section>

    <!--投稿内容の表示-->    
    <section class="pcbox">       
        <h3>投稿一覧</h3>
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
             </div>
             <div class="message">&nbsp;<?php echo $loop['contents']?></div>
             <div class="contents">&nbsp;<?php echo $loop['tag']?></div>
             <div class="contents">&nbsp;<?php echo $loop['created_at']?></div>
             <div class="urls">
                <form action="mydetail.php" method="POST">
                    <input type="hidden" name="num" value="<?php echo $loop['id']; ?>">
                    <input class="submit" type="submit" name="submit" value="詳細">
                </form>
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