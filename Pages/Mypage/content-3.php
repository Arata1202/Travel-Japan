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
    <link rel="stylesheet" href="CSS/content-3.css">
</head>
<body>
    
    <?php require "../../Layouts/header.php" ?>

    <?php
        
        //エスケープ処理
        function h($str){
            return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
        }
        $prefecture = h($_POST["prefecture"]);
        $place = h($_POST["place"]);
        $contents = h($_POST["contents"]);
        $num=h($_POST["num"]);

        // MySQL接続 UPDATE
$pdo = new PDO($dsn, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
$regist = $pdo->prepare("UPDATE japantravel SET prefecture = :prefecture, place = :place, contents = :contents WHERE id = :num");

// パラメータのバインド
$regist->bindParam(":prefecture", $prefecture);
$regist->bindParam(":place", $place);
$regist->bindParam(":contents", $contents);
$regist->bindParam(":num", $num);

// 実行とエラーチェック
if($regist->execute()) {
    echo "投稿内容の編集が完了しました。";
} else {
    echo "編集に失敗しました。";
    print_r($regist->errorInfo());
}
    ?>

    <!--メイン-->
    <h2 class="subtitle">＊編集＊</h2>
    <p>投稿内容の編集が完了しました。</p>

    <div class="urls">
        <br><br><button onclick="location.href='mypage.php'">マイページへ戻る</button>
    </div>       

    <?php require "../../Layouts/footer.php" ?>

    <script src="JS/content-3.js"></script>
</body>
</html>