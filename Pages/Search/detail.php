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
    <link rel="stylesheet" href="CSS/detail.css">
</head>
<body>
    
    <?php require "../../Layouts/header.php" ?> 

    <h2 class="subtitle">＊詳細＊</h2>
    <?php
    
    //投稿番号
    $_SESSION['num'] = $_POST['num'];
    $num = $_SESSION['num'] ;

    //SQL SELECT
    if (isset($_POST["num"])) {
        $pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
        $stmt = $pdo->prepare("SELECT * FROM japantravel WHERE id = '$num'");
        $stmt->execute();
    } else {    
        echo "error";
    }
    ?>

    <!--詳細画面の表示-->
    <section class="box">
		<?php foreach($stmt as $loop):?>
            <div class="spot">
                 <p class="name">
                    &nbsp;
                    
                    <!--　フォローページ　-->
                    <form class="btn_tr" action="searchyourpage.php" method="POST">
                        <input type="hidden" name="num" value="<?php echo $loop['id']; ?>">
                        <input type="hidden" name="name" value="<?php echo $loop['name']; ?>">
                        <button class="btn_tr" type="submit"><?php echo $loop['name']; ?></button>
                    </form>
                 </p>
                 <div class="prefecture">
                     <p><?php echo $loop['prefecture']?></p>
                     <p>&nbsp;<?php echo $loop['place']?>&nbsp;</p>
                 </div>
             </div>
             <img src="../../images/<?php echo $loop['filename']?>" alt="" style="width:100%;">
             
             <!--いいね機能 フォーム-->
             <div class="iine">
                 <div class="many">&nbsp;いいね！ : <?php echo $loop['likes']?>件</div>
                    <div class="like_many">

                        <!--いいね機能　フォーム-->
                        <form action="like.php" method="POST" name="like_btn">
                            <input type="hidden" name="id" value="<?php echo $loop['id']; ?>">
                            <input class="submit" type="submit" value="いいね！">
                        </form>
                    </div>
                 </div>
             <div class="message">&nbsp;<?php echo $loop['contents']?></div>
             <p class="contents">&nbsp;<?php echo $loop['created_at']?></div>
             <div class="urls">
                 <div class="urls">
                     <button onclick="location.href='search.php'">戻る</button>
                    <form action="comment.php" method="POST">
                    
                        <!--トークンの送信-->
                        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token;?>">
                        <input type="hidden" name="id" value="<?php echo $loop['id']; ?>">
                        <input type="hidden" name="name" value="<?php echo $loop['name']; ?>">
                        <input type="hidden" name="filename" value="<?php echo $loop['filename']; ?>">
                        <input class="btn-s" type="submit" value="コメント欄">
                    </form>
                </div>
             </div>
             <hr>
		<?php endforeach;?>
    </section>

    <?php require "../../Layouts/footer.php" ?>

    <script src="JS/detail.js"></script>
</body>
</html>