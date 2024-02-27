<?php
require "../../Config/db.php";

//セキュリティー対策
header('X-Frame-Options: SAMEORIGIN');
session_start();
session_regenerate_id();

//SQL接続
$pdo = new PDO($dsn,$user,$password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
$regist = $pdo->prepare("SELECT * FROM japantravel order by created_at DESC limit 50");
$regist->execute();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>Travel Japan !</title>
    <link rel="stylesheet" href="CSS/home.css">
</head>
<body>
    
    <?php require "../../Layouts/header.php" ?>
        
    <h2 class="subtitle">＊最新の投稿＊</h2>
           
    <!--投稿内容の表示-->
    <section class="box">
		<?php foreach($regist as $loop):?>
            <div class="spot">
                 <p class="name" id="n<?php echo $loop['id']; ?>">
                 &nbsp;
                        
                    <!--　フォローページ　-->
                    <form class="follow" action="yourpage.php" method="POST">
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
                    <div class="like_many">

                        <!--いいね機能　フォーム-->
                        <form action="like.php" method="POST" name="like_btn">
                            <input type="hidden" name="id" value="<?php echo $loop['id']; ?>">
                            <input class="submit" type="submit" value="いいね！">
                        </form>
                    </div>
                 </div>
             <div class="message">&nbsp;<?php echo $loop['contents']?></div>
             <div class="contents">&nbsp;<?php echo $loop['created_at']?></div>
             
             <!--コメントボタン-->
             <div class="urls">
                <form action="comment.php" method="POST">
                    
                    <!--トークンの送信-->
                    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token;?>">
                    <input type="hidden" name="id" value="<?php echo $loop['id']; ?>">
                    <input type="hidden" name="name" value="<?php echo $loop['name']; ?>">
                    <input type="hidden" name="filename" value="<?php echo $loop['filename']; ?>">
                    <input class="btn_s" type="submit" value="コメント欄">
                </form>
             </div>
             <hr>
		<?php endforeach;?>
    </section>
            
    <?php require "../../Layouts/footer.php" ?>

    <script src="JS/home.js"></script>

    <!--     jQuery     -->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript">

        $(function(){
            $(window).on('load',function(){
                $('.loader').delay(500).fadeOut(500);
                $('.loader-bg').delay(800).fadeOut(700);
            });
            setTimeout(function(){
                $('.loader-bg').fadeOut(500);
            },5000);
        });

    </script>
</body>
</html>

        


        
        
        
        
 