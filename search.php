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

//MySQL接続
$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//エスケープ処理
function h($str){
    return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}

//検索処理
if (isset($_POST["search"])) {
    if (isset($_POST["prefecture"])){
        $name = h($_POST["name"]);
    }
    if (isset($_POST["prefecture"]) && empty($_POST["place"])){
        $prefecture = h($_POST["prefecture"]);
        $place = '';
    }
    if (empty($_POST["prefecture"]) && isset($_POST["place"])){
        $prefecture = '';
        $place = h($_POST["place"]);
    }
    if (isset($_POST["prefecture"]) && isset($_POST["place"])){
        $prefecture = h($_POST["prefecture"]);
        $place = h($_POST["place"]);
    }

    //MySQL　セレクト文
    $sql="SELECT * FROM japantravel WHERE prefecture like '%{$prefecture}%' and place like '%{$place}%' and name like'%{$name}%'";
    $rec = $dbh->prepare($sql);
    $rec->execute();
    $rec_list = $rec->fetchAll(PDO::FETCH_ASSOC);
}else{

    $sql='SELECT * FROM japantravel WHERE 1';
    $rec = $dbh->prepare($sql);
    $rec->execute();
    $rec_list = $rec->fetchAll(PDO::FETCH_ASSOC);
}?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search</title>
    <link rel="stylesheet" href="CSS/search.css">
    <script src="JS/search.js" async></script>
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

        <h2 class="subtitle">＊検索＊</h2>

        <!--検索フォーム-->
        <div class="searchbox">
            <form action="" method="post">
                <h3>都道府県で検索</h3>
                <p><input type="text" name="prefecture" placeholder="例 : 岐阜県" size="30" style="height:25px;"></p>
                <h3>観光地で検索</h3>
                <p><input type="text" name="place" placeholder="例 : 下呂温泉" size="30" style="height:25px;"></p>
                <h3>ユーザー名で検索</h3>
                <p><input type="text" name="name" placeholder="例 : user" size="30" style="height:25px;"></p>
                <p><input class="btn_t" type="submit" name="search" value="検索" style="height:25px;"></p>
            </form>
        </div>
            
    
    <!--投稿内容の表示-->
    <section class="box">
        
        <?php foreach($rec_list as $loop):
        $pic_num =  $loop['id'];
        ?>

        <table>
            <tr>
                <td width="42%"><img src="images/<?php echo $loop['filename']?>" alt="" width="100%"></td>
                <td width="40%"><?php echo $loop['name']?><br><?php echo $loop['prefecture']?><br><?php echo $loop['place']?><br>いいね : <?php echo $loop['likes']?>件<br><?php echo $loop['created_at']?></td>
            
            <form action="searchdetail.php" method="POST">
                <!--トークンの送信-->
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token;?>">
                
                <input type="hidden" name="num" value="<?php echo $loop['id']; ?>">
                <td width="18%"><input class="submit" type="submit" name="submit" value="詳細"></td>
            </form>
        </tr>
        </table>
        <hr>
        <?php endforeach;?>
    </section>

    <!--投稿内容の表示-->
    <section class="pcbox">
		<?php foreach($rec_list as $loop):?>
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
                            <input type="hidden" name="id" value="<?php echo $loop['id']; ?>">
                            <input class="submit" type="submit" value="いいね！">
                        </form>
                    </div>
                 </div>
             <div class="message">&nbsp;<?php echo $loop['contents']?></div>
             <div class="contents">&nbsp;<?php echo $loop['tag']?></div>
             <div class="contents">&nbsp;<?php echo $loop['created_at']?></div>
             
             <!--コメントボタン-->
             <div class="urls">
                 <form action="searchdetail.php" method="POST">
                    <!--トークンの送信-->
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token;?>">

                    <input type="hidden" name="num" value="<?php echo $loop['id']; ?>">
                    <td width="18%"><input class="btn_t" type="submit" name="submit" value="詳細"></td>
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