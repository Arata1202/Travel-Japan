<?php
require "../../Config/db.php";

//セキュリティー対策・セッション　＊
header('X-Frame-Options: SAMEORIGIN');
session_start();
session_regenerate_id();

//エスケープ処理
function h($str){
    return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}
//変数定義
date_default_timezone_set('Asia/Tokyo');
$created_at=date("Y-m-d H:i:s");
$name = $_SESSION['user'];
$id=h($_POST["id"]);
$comment=h($_POST['comment']);
$filename=h($_POST["filename"]);
    
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>comment</title>
    <link rel="stylesheet" href="CSS/comment-add.css">
</head>
<body>
    
    <?php require "../../Layouts/header.php" ?>
    
    <!--サブタイトル-->
    <h2 class="subtitle">＊コメント＊</h2>
    <p>コメントを投稿しました。</p>
    
    <!--戻る用フォーム-->
    <form action="comment.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="hidden" name="filename" value="<?php echo $filename ?>">
        <input class="submit" type="submit" value="コメントを見る">
    </form>
    <?php

    //SQL　コメント内容保存
    if (isset($_POST["comment"])) {
        $dbh = new PDO($dsn,$user,$password);
        $stmt = $dbh->prepare("INSERT INTO comment(id, name, comment, created_at) VALUES (:id,:name,:comment,:created_at)");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':comment', $comment);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->execute();
    } 
    ?>
                
    <?php require "../../Layouts/footer.php" ?>

    <script src="JS/comment-add.js"></script>
</body>
</html>