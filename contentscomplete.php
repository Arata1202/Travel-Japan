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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>change</title>
    <link rel="stylesheet" href="CSS/contentscomplete.css">
    <script src="JS/contentscomplete.js"></script>
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
    <?php
        
    //トークン一致確認
    if (isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION['csrf_token']) {
        
        //エスケープ処理
        function h($str){
            return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
        }
        $prefecture = h($_POST["prefecture"]);
        $place = h($_POST["place"]);
        $contents = h($_POST["contents"]);
        $tag = h($_POST["tag"]);
        $num=h($_POST["num"]);

        //MySQL接続 UPDATE
        $pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
        $regist = $pdo->prepare("UPDATE japantravel SET prefecture = '$prefecture', place = '$place', contents = '$contents', tag = '$tag' WHERE id = '$num'");
        $regist->bindParam(":prefecture", $prefecture);
        $regist->bindParam(":place", $place);
        $regist->bindParam(":contents", $contents);
        $regist->bindParam(":tag", $tag);
        $regist->execute();
    }else{
        header('Location:form.php');
    }
    ?>

    <!--メイン-->
    <h2 class="subtitle">＊編集＊</h2>
    <p>投稿内容の編集が完了しました。</p>

    <div class="urls">
        <br><br><button onclick="location.href='mypage.php'">マイページへ戻る</button>
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