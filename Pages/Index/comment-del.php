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
$id = h($_POST["id"]);
$name = $_SESSION['user'];
$comment = h($_POST['comment']);
$filename = h($_POST['filename']);
$csrf_token=h($_POST["csrf_token"]);


//MySQL接続 DELETE
$pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
$regist = $pdo->prepare("DELETE FROM comment WHERE id = '$id' && name = '$name' && comment = '$comment'");
$regist->execute();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>comment</title>
    <link rel="stylesheet" href="CSS/comment-del.css">
</head>
<body>

    <?php require "../../Layouts/header.php" ?>
    
    <!--サブタイトル-->
    <h2 class="subtitle">＊コメント＊</h2>
    <p>コメントを削除しました。</p>
    
    <!--戻る用フォーム-->
    <form action="comment.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="hidden" name="name" value="<?php echo $name ?>">
        <input type="hidden" name="filename" value="<?php echo $filename ?>">
        <input class="submit" type="submit" value="戻る">
    </form>

    <?php require "../../Layouts/footer.php" ?>

    <script src="JS/comment-del.js"></script>
</body>
</html>