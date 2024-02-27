<!--いいね機能　処理-->
<?php 
require "../../Config/db.php";

session_start();
session_regenerate_id();

//エスケープ処理
function h($str){
    return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}

//変数定義
$sql_id = h($_POST['id']); 

//SQL いいね追加処理
if (isset($sql_id)) {
    $dbh = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
    $stmt = $dbh->prepare("UPDATE japantravel SET likes = likes + 1 WHERE id = $sql_id");
    $stmt->bindParam(':likes', $likes);
    $stmt->execute();
} else {    
    echo "error";
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/like.css">
</head>
<body>

    <?php require "../../Layouts/header.php" ?>

    <h2 class="subtitle">＊いいね＊</h2>
    <p>いいね！しました。</p>
    
    <div class="urls">
        <button class="btn_s" onclick="location.href='home.php#n<?php echo $sql_id ?>'">戻る</button>
    </div>

    <?php require "../../Layouts/footer.php" ?>

    <script src="JS/like.js" async></script>
    
</body>
</html>
