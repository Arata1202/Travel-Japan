$(".likeButton").click(function() {
    var postId = $(this).data("post-id");
    $.ajax({
        type: "POST",
        url: "like.php",
        data: { postId: postId },
        success: function(response) {
            // 成功した場合の処理
            alert("いいね！しました。");
            // ここにいいねの数を更新するなどの処理を追加することもできます
        },
        error: function(xhr, status, error) {
            // エラーが発生した場合の処理
            console.error(xhr.responseText);
        }
    });
});
