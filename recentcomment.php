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


//エスケープ処理
function h($str){
    return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}
//変数定義
$id=h($_POST["id"]);
$name=h($_POST["name"]);
$filename=h($_POST["filename"]);
$csrf_token=h($_POST["csrf_token"]);
$name = $_SESSION['user'];

    
//SQL接続　自分のコメント
$pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
$stmt = $pdo->prepare("SELECT * FROM comment WHERE id = '$id' && name = '$name' order by created_at DESC limit 50");
$stmt->execute();

//SQL接続　全体のコメント
$pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
$regist = $pdo->prepare("SELECT * FROM comment WHERE id = '$id' order by created_at DESC limit 50");
$regist->execute();
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>comment</title>
    <link rel="stylesheet" href="CSS/recentcomment.css">
    <script src="JS/recentcomment.js" async></script>
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
    
    <div class="box">
        <!--サブタイトル-->
        <h2 class="subtitle">＊コメント＊</h2>
        <img src="images/<?php echo $filename; ?>" alt="" style="width:100%;">
        
        <!--コメント用フォーム-->
        <h3>コメントする</h3>
        <form action="commentok.php" method="POST">
            
            <!--トークンの送信-->
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token;?>">

            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="filename" value="<?php echo $filename; ?>">
            <input type="text" name="comment" value="" required size="30" style="height:25px;">
            <input class="submit" type="submit" value="投稿">
        </form>
        
        <!--あなたの投稿　表示-->
        <h3>あなたのコメント</h3>
        <?php foreach ($stmt as $loop): ?>
            <?php $comment = $loop['comment']; ?>
            <table>
                <tr>
                    <td class="first"><?php echo $loop['name']; ?></td>
                    <td class="second">&nbsp;<?php echo $loop['created_at']; ?></td>
                    <td class="third">

                        <!--削除フォーム-->
                        <form action="recentdelete.php" method="post">
                            <!--トークンの送信-->
                            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token;?>">

                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="name" value="<?php echo $name; ?>">
                            <input type="hidden" name="comment" value="<?php echo $comment; ?>">
                            <input type="hidden" name="filename" value="<?php echo $filename; ?>">
                            <input class="ok" type="submit" value="削除">
                        </form>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><?php echo $loop['comment']; ?></td>
                </tr>
                <hr>
            </table>
        <?php endforeach ?>  
        <hr>
        <?php
        if (!isset ($comment )){
            echo "<p>コメントはまだありません</p>";
            echo "<hr>";
        }
        ?>

        <!--みんなの投稿　表示-->
        <h3>みんなのコメント</h3>       
        <?php foreach ($regist as $loop): ?>
            <?php $comment_s = $loop['comment']; ?>
            <table>
                <tr>
                    <td class="first"><?php echo $loop['name']; ?></td>
                    <td class="second">&nbsp;<?php echo $loop['created_at']; ?></td>
                    <td class="third"></td>
                </tr>
                <tr>
                    <td colspan="3"><?php echo $loop['comment']; ?></td>
                </tr>
                <hr>
            </table>
        <?php endforeach ?>
        <hr>
        <?php
        if (!isset ($comment_s)){
            echo "<p>コメントはまだありません</p>";
            echo "<hr>";
        }
        ?>

        <!--ボタン-->
        <div class="urls">
            <button class="btn-s" onclick="location.href='index.php#n<?php echo $id ?>'">戻る</button>
        </div>    
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