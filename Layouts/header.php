<header>
    <!--ハンバーガーメニュー-->
    <div class="humberger">
        <div class="btn">
            <i></i>
            <i></i>
            <i></i>
        </div>
        <div class="block">
            <div class="list">
                <ul>
                    <li style="color:deepskyblue;"><h5>＊<?php echo $_SESSION['user'] ?>様,ようこそ＊</h5></li>
                    <br>
                    <li><h5><a href="../Infomation/about.php">＊Travel Japan ! とは</a></h5></li>
                    <li><h5><a href="../Mypage/mypage.php">＊マイページ</a></h5></li>
                    <li><h5><a href="../Ranking/ranking.php">＊ランキング</a></h5></li>
                    <li><h5><a href="../Infomation/privacy.php">＊プライバシーポリシー</a></h5></li>
                    <li><h5><a href="../Contact/contact-1.php">＊お問い合わせ</a></h5></li>
                </ul>
            </div>
        </div>
    </div>
    
    <!--タイトル-->
    <h1 class="title">&nbsp;Travel Japan !</h1>
</header> 

<script>
    const btn = document.querySelector('.btn');
     const block = document.querySelector('.block');
     btn.addEventListener('click', () => {
         btn.classList.toggle('active');
         block.classList.toggle('active');
     });
</script>

<style>
    /* ハンバーガーメニュー */
.btn{
    position:fixed;
    top: 0;
    right: 0;
    width: 45px;
    height: 45px;
    z-index: 9;
}
.btn i{
    position: absolute;
    left: 5px;
    width: 40px;
    height: 2px;
    background-color: white;
    transition: .5s;
}
.btn i:nth-of-type(1){
    top: 16px;
}
.btn i:nth-of-type(2){
    top: 26px;
}
.btn i:nth-of-type(3){
    top: 36px;
}
.btn.active i:nth-of-type(1){
    transform: translateY(10px) rotate(45deg);
}
.btn.active i:nth-of-type(2){
    opacity: 0;
}
.btn.active i:nth-of-type(3){
    transform: translateY(-10px) rotate(-45deg);
}
.block{
    position: fixed;
    bottom: 0;
    top: 0;
    left: 0;
    right: 0;
    background-color: white;
    color: black;
    opacity: 0;
    pointer-events: none;
    transition: .5s;
}
.block.active{
    opacity: 1;
    pointer-events: auto;
}
.list{
    position: absolute;
    top: 60px;
    left: 20px;
    font-size: 30px;
}
.list ul{
    list-style: none;
    padding: 0px;
}
.list li{
    padding: 0px 0px 0px 30px;
    line-height: 10px;
} 
.list ul{
    list-style:none;
}
h5{
    margin-bottom:0px;
}
.list ul h5 a{
    color:black;
    text-decoration:none;
}
</style>