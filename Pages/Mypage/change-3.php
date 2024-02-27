<?php
require "../../Config/db.php";

//セキュリティー対策・セッション　＊
header('X-Frame-Options: SAMEORIGIN');
session_start();
session_regenerate_id();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>change</title>
    <link rel="stylesheet" href="CSS/change-3.css">
</head>
<body>
    
    <?php require "../../Layouts/header.php" ?>

    <?php
        
        //エスケープ処理
        function h($str){
            return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
        }  
        $id = h($_POST["id"]);
        $name = h($_POST["name"]);
        $pass = h($_POST["password"]);
        $address = h($_POST["address"]);
        $tel = h($_POST["tel"]);

        //MySQL接続 UPDATE
        $pdo = new PDO($dsn_s,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
        $regist = $pdo->prepare("UPDATE user SET id = '$id', name = '$name', password = '$pass', address = '$address', tel = '$tel'  WHERE id = '$id'");
        $regist->bindParam(":id", $id);
        $regist->bindParam(":name", $name);
        $regist->bindParam(":password", $pass);
        $regist->bindParam(":address", $address);
        $regist->bindParam(":tel", $tel);
        $regist->execute();
    ?>
        
    <!--タイトル-->
    <h1 class="title">&nbsp;Travel Japan !</h1>
    </header> 

    <!--メイン-->
    <h2 class="subtitle">＊登録情報変更＊</h2>
    <p>登録情報の変更が完了しました。</p>

    <!--ボタン-->
    <div class="urls">
        <br><br><button onclick="location.href='mypage.php'">マイページへ戻る</button>
    </div>

    <?php require "../../Layouts/footer.php" ?>

    <script src="JS/change-3.js"></script>
</body>
</html>