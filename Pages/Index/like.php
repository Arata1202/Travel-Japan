<?php
session_start();
session_regenerate_id();
require "../../Config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_name = $_SESSION['user']; // ログインユーザーの名前
    $post_id = $_POST['post_id'];
    $like = filter_var($_POST['like'], FILTER_VALIDATE_BOOLEAN); // 追加: いいねの状態

    $dbh = new PDO($dsn, $user, $password);

    if ($like) {
        // いいねを追加
        $stmt = $dbh->prepare("INSERT INTO good_list (user_name, post_id) VALUES (?, ?) ON DUPLICATE KEY UPDATE user_name = user_name");
    } else {
        // いいねを解除
        $stmt = $dbh->prepare("DELETE FROM good_list WHERE user_name = ? AND post_id = ?");
    }
    $stmt->execute([$user_name, $post_id]);

    // いいねの数を更新
    $stmt = $dbh->prepare("UPDATE japantravel SET likes = (SELECT COUNT(*) FROM good_list WHERE post_id = ?) WHERE id = ?");
    $stmt->execute([$post_id, $post_id]);

    $stmt = $dbh->prepare("SELECT COUNT(*) FROM good_list WHERE post_id = ?");
    $stmt->execute([$post_id]);
    $likes = $stmt->fetchColumn();

    echo json_encode(['success' => true, 'likes' => $likes]);
    exit();
}
