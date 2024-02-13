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

//ユーザーネーム　変数
$session_user = $_SESSION['user'];

//SQL接続　SELECT
$pdo = new PDO($dsn_s,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
$stmt = $pdo->prepare("SELECT * FROM user WHERE id = '$session_user'");
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>change</title>
    <link rel="stylesheet" href="CSS/changedata.css">
    <script src="JS/changedata.js" async></script>
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
                        <li><h5><a href="privacy.php">＊プライバシーポリシー</a></h5></li>
                        <li><h5><a href="contactform.php">＊お問い合わせ</a></h5></li>
                        
                    </ul>
                </div>
            </div>
        </div>

        <!--タイトル-->
        <h1 class="title">&nbsp;Travel Japan !</h1>
    </header> 

    <h2 class="subtitle">＊登録情報変更＊</h2>
    
    <!--情報の表示　フォーム-->
    <form action="changecheck.php" method="POST">
        
        <!--トークンの送信-->
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token;?>">
        <?php foreach($stmt as $loop):?>
            
            <h3>氏名</h3>
            <input type="text" name="name" value="<?php echo $loop['name']?>" size="30" style="height:25px;">
            <h3>メールアドレス</h3>
            <input type="text" name="address" value="<?php echo $loop['address']?>" size="30" style="height:25px;">
            <h3>会員ID (変更不可)</h3>
            <?php echo $loop['id']?><input type="hidden" name="id" value="<?php echo $loop['id']?>">
            <h3>パスワード</h3>
            <input type="text" name="password" value="" required size="30" style="height:25px;">
            <h3>電話番号</h3>
            <input type="int" name="tel" value="<?php echo $loop['tel']?>" size="30" style="height:25px;">
            <div class="urls">
                <button class="btn_s" type="button" onclick="history.back(-1)">戻る</button>
                <input class="submit" type="submit" value="確認画面">
            </div>           
    </form>
    <?php endforeach;?>

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