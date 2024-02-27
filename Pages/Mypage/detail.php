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
    <title>mypage</title>
    <link rel="stylesheet" href="CSS/detail.css">
</head>
<body>
    
    <?php require "../../Layouts/header.php" ?>

    <h2 class="subtitle">＊詳細＊</h2>
        
    <?php 
    //エスケープ処理
    function h($str){
        return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
    }
    //投稿番号
    $num = $_POST['num'];
    $_SESSION['num'] = $num;
    
    if (isset($_POST["num"])) {
        
        //SQL接続　SELECT
        $pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
        $stmt = $pdo->prepare("SELECT * FROM japantravel WHERE id = '$num'");
        $stmt->execute();
    } else {    
        echo "error";
    }
    ?>
    <!--投稿内容の表示-->
    <section class="box">
		<?php foreach($stmt as $loop):?>
            <div class="spot">
                 <p class="name">
                    &nbsp;
                    <!--　フォローページ　-->
                    <form class="follow" action="mypage.php" method="POST">
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
             
             <!--いいね機能-->
             <div class="iine">
                <div class="many">&nbsp;いいね！ : <?php echo $loop['likes']?>件</div>
            </div>       
             <div class="message">&nbsp;<?php echo $loop['contents']?></div>
             <div class="contents">&nbsp;<?php echo $loop['created_at']?></div>
             
             <!--コメントボタン-->
             <div class="urls">
                <button onclick="location.href='mypage.php'">戻る</button>
                <button class="submit" onclick="location.href='content-1.php'">編集</button>
                <button class="delete" onclick="location.href='delete-1.php'">削除</button>
            </div>
             </div>
             <hr>
		<?php endforeach;?>
    </section>

    <!--投稿内容の表示-->
    <section class="box">
		<?php foreach($stmt as $loop):?>
            
        <div class="spot">
            <p class="name"><b>&nbsp;<?php echo $loop['name']?></b></p>
            <div class="prefecture">
                <p><?php echo $loop['prefecture']?></p>
                <p>&nbsp;<?php echo $loop['place']?>&nbsp;</p>
            </div>
        </div>
 
        <img src="../../images/<?php echo $loop['filename']?>" alt="" style="width:100%;">
        
        <div class="iine">
           <div>いいね : <?php echo $loop['likes']?>件</div>
        </div>
        <div class="message"><?php echo $loop['contents']?></div>
        <div class="contents">&nbsp;<?php echo $loop['tag']?></div>
        <div class="contents">&nbsp;<?php echo $loop['created_at']?></div>
        
        <div class="urls">
            <button onclick="history.back(-1)">戻る</button>
            <button class="submit" onclick="location.href='content-1.php'">編集</button>
            <button class="delete" onclick="location.href='delete-1.php'">削除</button>
        </div>
        <hr>
       
        <?php endforeach;?>
    </section>

    <?php require "../../Layouts/footer.php" ?>

    <script src="JS/detail.js"></script>
</body>
</html>