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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>submit</title>
    <link rel="stylesheet" href="CSS/answer.css">
</head>
<body>
    <header>
        <!--タイトル-->
        <h1 class="title">&nbsp;Travel Japan !</h1>
    </header>    
    <?php

    //トークンの一致確認
    if (isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION['csrf_token']) {
        
        //エスケープ処理
        function h($str){
            return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
        }
        $name=h($_POST["name"]);
        $id=h($_POST["id"]);
        $address=h($_POST["address"]);
        $tel=h($_POST["tel"]);
        $password=h($_POST["password"]);
        $csrf_token=h($_POST["csrf_token"]);
    }else{
    header('Location:submit.php');
    }
    ?>
    <div class="box">
        <!--確認フォーム-->
        <form action="complete.php" method="post">   
            <h2 class="subtitle">＊新規会員登録＊</h2>
            <p class="smalltitle">内容をご確認の上、<br>宜しければ登録してください。</p>
            <div class="box">
                <h3>氏名</h3>
                <p><?php echo $name ?><p>
                <h3>メールアドレス</h3>
                <p><?php echo $address ?><p>
                <h3>会員ID</h3>
                <p><?php echo $id ?><p>
                <h3>パスワード</h3>
                <p>表示されません<p>
                <h3>電話番号</h3>
               <p><?php echo $tel ?><p>
            </div>
            <div class="flex_box">
                <input class="btn" type="button" value="内容を修正する" onclick="history.back(-1)">
                <button class="submit" type="submit" name="add">登録する</button>
    
                <!--トークンの送信-->
                <input type="hidden" name="csrf_token" value="<?php echo $csrf_token;?>">
                <input type="hidden" name="name" value="<?php echo $name;?>">
                <input type="hidden" name="address" value="<?php echo $address;?>">
                <input type="hidden" name="password" value="<?php echo $password;?>">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="hidden" name="tel" value="<?php echo $tel;?>">
            </div>
        </form>   
    </div> 
        
    <!--ボトムメニュー-->
    <footer>
        <ul class="under_menu">
            <li><a href="guest.php">ホーム</a></li>
            <li><a href="form.php">ログイン</a></li>
            <li><a href="gcontactform.php">お問い合わせ</a></li>
        </ul>
    </footer>
</body>
</html>