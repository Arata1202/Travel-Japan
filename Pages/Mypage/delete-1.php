<?php
//セキュリティー対策・セッション　＊
header('X-Frame-Options: SAMEORIGIN');
session_start();
session_regenerate_id();

//変数の定義 投稿番号
$num = $_SESSION['num'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>delete</title>
    <link rel="stylesheet" href="CSS/delete-1.css">
</head>
<body>
    
    <?php require "../../Layouts/header.php" ?>
        
    <!--表示部分-->
    <h2 class="subtitle">＊投稿の削除＊</h2>
    <p>一度削除したデータは復元できません。</p>
        
    <!--ボタン-->
    <div class="urls">
        <form action="delete-2.php" method="POST">
            <input type="hidden" name = "delete" value = "<?php echo $num ?>">
            <input class="submit" type="submit" value="削除">
        </form>
    </div>

    <?php require "../../Layouts/footer.php" ?>

    <script src="JS/delete-1.js"></script>
</body>
</html>