<?php
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
    <link rel="stylesheet" href="CSS/add.css">
</head>
<body>
    
    <?php require "../../Layouts/header.php" ?>

    <h2 class="subtitle">＊新規投稿＊</h2>
        
    <!--入力フォーム-->
    <div class="box">
        <form action="add-2.php" method="post" enctype="multipart/form-data">
             <input type="hidden" name="name" value="<?php echo $_SESSION['user'] ?>" ><br>
             <h3>都道府県</h3>
             <input type="text" name="prefecture" value="" placeholder="例 : 神奈川県" size="30" required style="height:25px;"><br>
             <h3>観光地名称</h3>
             <input type="text" name="place" value="" placeholder="例 : 箱根温泉" size="30" required style="height:25px;"><br>
             <h3>コメント</h3>
             <textarea name="contents" value="" placeholder="例 : 箱根温泉へ行きました。" rows="5" cols="30"></textarea><br>
             <br>
             <input type="file" name="upload_image" size="30" required style="height:25px;">
             <br>
             <button class="submit" type="submit">投稿</button>
        </form>
     </div>
                   
     <?php require "../../Layouts/footer.php" ?>

    <script src="JS/add.js"></script>
</body>
</html>