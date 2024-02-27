<?php
//セキュリティー対策・セッション　＊
header('X-Frame-Options: SAMEORIGIN');
session_start();
session_regenerate_id();

if (isset($_POST["csrf_token"]) && $_POST["csrf_token"] === $_SESSION['csrf_token']) {
    //
}

require "../../Config/db.php";
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>login</title>
    <link rel="stylesheet" href="CSS/login-2.css">
</head>
<body>
    
    <?php require "../../Layouts/header.php" ?>

    <!--エスケープ処理-->
    <?php
    function h($str){
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }
    
    // フォームから送信されたデータの取得
    $member = h($_POST["user"]); // メールアドレス
    $raw_password = h($_POST["password"]); // 生のパスワード
    
    if (!empty($member) && !empty($raw_password)) {
        // メールアドレスとパスワードが入力されている場合
    
        // 形式が無効な場合のエラー　RFC準拠
        if (!filter_var($member, FILTER_VALIDATE_EMAIL)) {
            print "<h2>＊ログイン＊</h2><h3>有効なメールアドレスを入力してください</h3>";
            exit;
        }
    
        $dbh = new PDO($dsn_s, $user, $password);
        $stmt = $dbh->prepare("SELECT * FROM user WHERE address=:user");
        $stmt->bindParam(':user', $member);
        $stmt->execute();
    
        if ($rows = $stmt->fetch()) {
            // ユーザーが存在する場合
    
            // データベースから取得したハッシュ化されたパスワード
            $hashed_password = $rows["password"];
    
            // 生のパスワードをハッシュ化
            $hashed_input_password = password_hash($raw_password, PASSWORD_DEFAULT);
    
            // パスワードが一致するかチェック
            if (password_verify($raw_password, $hashed_password)) {
                // パスワードが一致する場合
                header('Location: ../Index/home.php');
                $_SESSION['user'] = $rows['id']; 
            } else {
                // パスワードが一致しない場合
                print "<h2>＊ログイン＊</h2><h3>パスワードが間違っています。<br>もう一度ログインしてください。</h3>";
            }
        } else {
            // ユーザーが存在しない場合
            print "<h2>＊ログイン＊</h2><h3>ユーザーが存在しません<br>もう一度ログインしてください。</h3>";
        }
    } else {
        // メールアドレスまたはパスワードが入力されていない場合
        print "<h2>＊ログイン＊</h2><h3>メールアドレスとパスワードを入力してください。</h3>";
    }
    

?>

    <script src="JS/login-2.js"></script>
</body>
</html>