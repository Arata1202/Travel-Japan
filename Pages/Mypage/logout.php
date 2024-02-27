<?php
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
    <title>logout</title>
    <link rel="stylesheet" href="CSS/logout.css">
</head>
<body>
    
    <?php require "../../Layouts/header.php" ?>
    
    <!--メイン-->
    <h2 class="subtitle">＊ログアウト＊</h2>
    <p>ログアウトします<br>宜しいですか？</p>

    <!--ボタン-->
    <div class="urls">
        <button onclick="history.back(-1)">戻る</button>
        <button class="submit" onclick="location.href='logout-2.php'">ログアウト</button>
    </div>
    
    <?php require "../../Layouts/footer.php" ?>

    <script src="JS/logout.js"></script>
</body>
</html>