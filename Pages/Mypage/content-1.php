<?php
require "../../Config/db.php";

//セキュリティー対策・セッション　＊
header('X-Frame-Options: SAMEORIGIN');
session_start();
session_regenerate_id();

//トークンの生成
$toke_byte = openssl_random_pseudo_bytes(16);
$csrf_token = bin2hex($toke_byte);
$_SESSION['csrf_token'] = $csrf_token;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>change</title>
    <link rel="stylesheet" href="CSS/content-1.css">
</head>
<body>
    
    <?php require "../../Layouts/header.php" ?>

    <h2 class="subtitle">＊編集＊</h2>
    <?php

    //投稿番号
    $num = $_SESSION['num'];
    
    //SQL接続　SELECT
    if (isset($_SESSION["num"])) {
        $pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
        $stmt = $pdo->prepare("SELECT * FROM japantravel WHERE id = '$num'");
        $stmt->execute();
    } else {    
        echo "error";
    }
    ?>
    <div class="box">
        <form action="content-2.php" method="POST">
            <!--投稿番号-->
            <input type="hidden" name="num" value="<?php echo $num ?>">
    
            <!--変更フォーム-->
            <?php foreach($stmt as $loop):?>
    
            <p><img src="images/<?php echo $loop['filename'];?>"></p>
            <h3>都道府県</h3>
            <p><input type="text" name="prefecture" value="<?php echo $loop['prefecture']?>" required size="30" style="height:25px;"></p>
            <h3>観光地名称</h3>
            <p><input type="text" name="place" value="<?php echo $loop['place']?>" required size="30" style="height:25px;"></p>
            <h3>コメント</h3>
            <p><textarea name="contents" rows="5" cols="30"><?php echo $loop['contents']?></textarea></p>
            <input type="hidden" name="img" value="<?php echo $loop['filename']?>">
            
            <div class="urls">
                <button class="submit" type="submit">編集</button>
            </div>
    
            <?php endforeach;?>
    
        </form>
    </div>
        
    <?php require "../../Layouts/footer.php" ?>

    <script src="JS/content-1.js"></script>
</body>
</html>