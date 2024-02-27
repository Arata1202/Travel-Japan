<?php
require "../../Config/db.php";

//セキュリティー対策
header('X-Frame-Options: SAMEORIGIN');
session_start();
session_regenerate_id();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>add</title>
    <link rel="stylesheet" href="CSS/add-2.css">
</head>
<body>
    
    <?php require "../../Layouts/header.php" ?>

    <!--画面表示部分-->
    <h2 class="subtitle">＊新規投稿＊</h2>
    <section class="box">
         <p>投稿ありがとうございます。</p><br>
         <button class="submit" onclick="location.href='../Index/home.php'">ホームに戻る</button>
    </section>
    
    <?php
    // アップロードされた画像があるかチェック
if (!empty($_FILES)) {
    $filename = $_FILES['upload_image']['name'];
    $uploaded_path = '../../images/' . $filename;
    $result = move_uploaded_file($_FILES['upload_image']['tmp_name'], $uploaded_path);

    if ($result) {
        // 画像の形式に応じて、画像を読み込む
        $image = null;
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        switch ($extension) {
            case 'jpg':
            case 'jpeg':
                $image = imagecreatefromjpeg($uploaded_path);
                break;
            case 'png':
                $image = imagecreatefrompng($uploaded_path);
                break;
        }

        // 画像が読み込めたかチェック
        if ($image !== false) {
            // WebP形式で画像を保存
            $webp_path = '../../images/' . pathinfo($filename, PATHINFO_FILENAME) . '.webp';
            imagewebp($image, $webp_path);

            // オリジナルの画像を削除
            unlink($uploaded_path);

            // WebP画像のパスを更新
            $filename = pathinfo($filename, PATHINFO_FILENAME) . '.webp';
            $img_path = $webp_path;
            $MSG = 'images/' . $filename;
        } else {
            $MSG = 'アップロード失敗！画像形式がサポートされていません。';
        }
    } else {
        $MSG = 'アップロード失敗！エラーコード：' . $_FILES['upload_image']['error'];
    }
} else {
    $MSG = '画像を選択してください';
}

    
    //エスケープ処理
    function h($str){
        return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
    }
    //変数代入
    date_default_timezone_set('Asia/Tokyo');
    $created_at = date("Y-m-d H:i:s");
    $id = null;
    $name = h($_POST["name"]);
    $contents = h($_POST["contents"]);
    $place = h($_POST["place"]);
    $prefecture = h($_POST["prefecture"]);
    
    //MySQL接続
    $pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
    $regist = $pdo->prepare("INSERT INTO japantravel(id, name, contents, created_at, place, prefecture, filename) VALUES (:id,:name,:contents,:created_at,:place,:prefecture,:filename)");
    $regist->bindParam(":id", $id);
    $regist->bindParam(":name", $name);
    $regist->bindParam(":contents", $contents);
    $regist->bindParam(":place", $place);
    $regist->bindParam(":prefecture", $prefecture);
    $regist->bindParam(":created_at", $created_at);
    $regist->bindParam(":filename", $filename);
    $regist->execute();
    ?>
    
    <?php require "../../Layouts/footer.php" ?>

    <script src="JS/add-2.js"></script>
</body>
</html>