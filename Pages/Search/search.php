<?php
require "../../Security/all.php";
require "../../Redirect/all.php";
require "../../Config/db.php";

$dbh=new PDO($dsn,$user,$password);
$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

function h($str){
    return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
}
if (isset($_POST["search"])) {
    $searchQuery = h($_POST["searchQuery"]);
    $sql="SELECT * FROM japantravel WHERE prefecture LIKE '%{$searchQuery}%' OR place LIKE '%{$searchQuery}%' OR name LIKE '%{$searchQuery}%' ORDER BY created_at DESC LIMIT 9999";
    $rec = $dbh->prepare($sql);
    $rec->execute();
    $rec_list = $rec->fetchAll(PDO::FETCH_ASSOC);
} else {
    $sql='SELECT * FROM japantravel WHERE 1 ORDER BY created_at DESC LIMIT 50';
    $rec = $dbh->prepare($sql);
    $rec->execute();
    $rec_list = $rec->fetchAll(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>search</title>
    <link rel="stylesheet" href="CSS/search.css">
</head>
<body>
    <?php require "../../Layouts/header.php" ?>
        <h2 class="subtitle">＊検索＊</h2>
        <div class="searchbox">
            <form action="" method="post">
                <p><input type="text" name="searchQuery" placeholder="都道府県、観光地、ユーザー名で検索" size="30" style="height:25px;"></p>
                <p><input class="btn_t" type="submit" name="search" value="検索" style="height:30px;"></p>
            </form>
        </div>
    <section class="box">
        <?php foreach($rec_list as $loop):
        $pic_num =  $loop['id'];
        ?>
        <table>
            <tr>
                <td width="42%"><img src="../../images/<?php echo $loop['filename']?>" alt="" width="100%"></td>
                <td width="40%"><?php echo $loop['name']?><br><?php echo $loop['prefecture']?><br><?php echo $loop['place']?><br>いいね : <?php echo $loop['likes']?>件<br><?php echo $loop['created_at']?></td>
            <form action="detail.php" method="POST">
                <input type="hidden" name="num" value="<?php echo $loop['id']; ?>">
                <td width="18%"><input class="submit" type="submit" name="submit" value="詳細"></td>
            </form>
        </tr>
        </table>
        <hr>
        <?php endforeach;?>
    </section>
    <section class="pcbox">
		<?php foreach($rec_list as $loop):?>
            <div class="spot">
                 <p class="name"><b>&nbsp;<?php echo $loop['name']?></b></p>
                 <div class="prefecture">
                     <p><?php echo $loop['prefecture']?></p>
                     <p>&nbsp;<?php echo $loop['place']?>&nbsp;</p>
                 </div>
             </div>
             <img src="../../images/<?php echo $loop['filename']?>" loading="lazy" alt="" style="width:100%;">
             <div class="iine">
                 <div class="many">&nbsp;いいね！ : <?php echo $loop['likes']?>件</div>
                    <div class="like_many">
                        <form action="like.php" method="POST" name="like_btn">
                            <input type="hidden" name="id" value="<?php echo $loop['id']; ?>">
                            <input class="submit" type="submit" value="いいね！">
                        </form>
                    </div>
                 </div>
             <div class="message">&nbsp;<?php echo $loop['contents']?></div>
             <div class="contents">&nbsp;<?php echo $loop['created_at']?></div>
             <div class="urls">
                 <form action="detail.php" method="POST">
                    <input type="hidden" name="num" value="<?php echo $loop['id']; ?>">
                    <td width="18%"><input class="btn_t" type="submit" name="submit" value="詳細"></td>
                </form>
             </div>
             <hr>
		<?php endforeach;?>
    </section>
    <?php require "../../Layouts/footer.php" ?>
</body>
</html>