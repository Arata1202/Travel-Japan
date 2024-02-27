<?php
require "../../Config/db.php";

//セキュリティー対策・セッション　＊
header('X-Frame-Options: SAMEORIGIN');
session_start();
session_regenerate_id();

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
    <link rel="stylesheet" href="CSS/change-1.css">
</head>
<body>
    
    <?php require "../../Layouts/header.php" ?>

    <h2 class="subtitle">＊登録情報変更＊</h2>
    
    <!--情報の表示　フォーム-->
    <form action="change-2.php" method="POST">
        
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

    <script src="JS/change-1.js"></script>
</body>
</html>