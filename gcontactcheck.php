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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>
    <link rel="stylesheet" href="CSS/gcontactcheck.css">
</head>
<body>
    <header>
        <!--タイトル-->
        <h1 class="title"><a href="">&nbsp;Travel Japan !</a></h1>
    </header> 
    
    <h2 class="subtitle">＊お問い合わせ＊</h2>

    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        //トークンの一致確認
        if (isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION['csrf_token']) {
            
            //エスケープ処理
            function h($str){
                return htmlspecialchars($str,ENT_QUOTES,'UTF-8');
            }
            $name=h($_POST["name"]);
            $sex=h($_POST["sex"]);
            $mail=h($_POST["email"]);
            $title=h($_POST["title"]);
            $content=h($_POST["contact_body"]);
            $csrf_token=h($_POST["csrf_token"]);
        }else{
            header('Location:contactform.php');
        }
    }
    ?>

    <!--フォーム受け渡し-->
    <form action="" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
        <input type="hidden" name="name" value="<?php echo $name;?>">
        <input type="hidden" name="sex" value="<?php echo $sex;?>">
        <input type="hidden" name="email" value="<?php echo $mail;?>">
        <input type="hidden" name="title" value="<?php echo $title;?>">
        <input type="hidden" name="contact_body" value="<?php echo $content;?>">
        <div class="box">

            <!--メイン-->
            <p class="comment">内容をご確認の上、宜しければ送信してください。</p>
            <h3>氏名</h3>
            <p><?php echo $name ?><p>
            <h3>メールアドレス</h3>
            <p><?php echo $mail ?><p>
            <h3>題名</h3>
            <p><?php echo $title ?><p>
            <h3>お問い合わせ内容</h3>
            <p><?php echo $content ?><p>
        </div>
        <div class="urls">
            <input class="last_btn" type="button" value="内容を修正する" onclick="history.back(-1)">
            <button class="submit" type="submit" name="add">送信する</button>
        </div>
    </form>
    <?php
            
    //メールの設定
    if(isset($_POST["add"])){
        mb_language("ja");
        mb_internal_encoding("UTF-8");
        $subject="お問い合わせ受付完了のお知らせ";
        $body=<<<EOM
        ※このメールはシステムからの自動返信です。
        
        {$name}様
        以下の内容でお問い合わせを受付致しました。
        
        【氏名】
        ・{$name}
        【性別】
        ・{$sex}
        【メール】
        ・{$mail}
        【題名】
        ・{$title}
        【お問い合わせ内容】
        ・{$content}
        
        内容を確認の上、改めてご連絡をさせていただきます。しばらくお待ちください。
        EOM;
        $fromEmail = "aratadayoon@yahoo.co.jp";
        $fromName = "Japan Travel!";
        $header = "From: " . mb_encode_mimeheader("Japan Travel!") . "<{aratadayoon@yahoo.co.jp}>";
        mb_send_mail($mail, $subject, $body, $header);
        mb_send_mail($fromEmail, $subject, $body, $header);
        header("Location: gcontactcomplete.php");
        exit;
    }?>

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