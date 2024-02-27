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
    <title>search</title>
    <link rel="stylesheet" href="CSS/like.css">
</head>
<body>
    
    <?php require "../../Layouts/header.php" ?>
    
    <!--いいね機能　処理-->
    <?php  
    
    //エスケープ処理
    function h($str){
        return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
    }
    //変数定義
    $sql_id = h($_POST['id']); 
    
    //SQL いいね追加処理
    if (isset($sql_id)) {
        $dbh = new PDO($dsn,$user,$password);
        $stmt = $dbh->prepare("UPDATE japantravel SET likes = likes + 1 WHERE id = $sql_id");
        $stmt->bindParam(':likes', $likes);
        $stmt->execute();
    } else {    
        echo "error";
    }
    ?>

    <h2 class="subtitle">＊いいね＊</h2>
    <p>いいね！しました。</p>

    <div class="urls">
        <form action="detail.php" method="POST">
            <input type="hidden" name="num" value="<?php echo $sql_id ?>">
            <input class="submit" type="submit" value="戻る">
        </form>
    </div>

    <?php require "../../Layouts/footer.php" ?>

    <script src="JS/like.js"></script>
</body>
</html>