<!--いいね機能　処理-->
<?php 
require "db.php";

//直接アクセスの禁止
if (!isset ($_SESSION['user'] )){
    header('Location:home.php');
}

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
    header('Location:index.php');
} else {    
    echo "error";
}
?>
