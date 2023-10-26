<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank you</title>
</head>
<body>
    <header>
        <!--タイトル-->
        <h1 class="title">&nbsp;Portfolio</h1>
    </header> 

    <div class="box">
        <h2 class="subtitle">Portfolio</h2>
        <h3>GitHub はこちら : <a href="https://github.com/Arata1202/portfolio" target="_blank">Arata1202</a></h3>
        <hr>
        
        <h2 class="subtitle">開発のきっかけ</h2>
        <p>2023年の7月にプログラミングなどのIT関連の学習を始め、少しずつではありますが知識や技術を習得してきました。</p>
        <p>まだまだ業務でバリバリ働くほどの実力はありませんが、一つの区切りとして私の努力を形にするためにこのPortfolioを作成する事にしました。</p> 
        <hr>
        
        <h2 class="subtitle">使用言語 / ツール</h2>
        <ul>
            <li>HTML / CSS</li>
            <li>JavaScript</li>
            <li>Python / Django</li>
            <li>SQLite　※MySQLに変更予定</li>
            <li>AWS / EC2 / Route53</li>
            <li>Nginx</li>
            <li>Gunicorn</li>
            <li>Git / GitHub</li>
            <li>VSCode</li>
        </ul>
        <p>フレームワークはPythonのDjangoを採用しました。</p>
        <p>JavaのSpringBootと迷いましたが、現在はPythonの需要が高まってきていることや、将来性や需要の伸びを期待されているということでDjangoを採用しました。</p>
        <hr>
        
        <h2 class="subtitle">アプリの設計</h2>
        <p>見やすい設計にするため、サービスの紹介ページ以外は1枚のページで仕上げました。</p>
        <p>メンテナンス性の観点から、サービス紹介ページはTravel Japan !のドメイン内に作成しました。</p>
        <p>全体的な色合いを統一することやハンバーガーメニューを設置するなど、UIにも配慮をしています。</p>
        <p>PCは勿論、スマートフォン , タブレットにもレスポンシブ対応しています。</p>
        <img src="images/respon.jpg" alt="">
        <hr>

        <h2 class="subtitle">開発工程</h2>
        <h3>1 , ローカル環境でPortfolioの作成</h3>
        <p>Djangoの構築に少し手間取りましたが、HTML , CSSには慣れていたのでスムーズに行えました。</p>
        <br>
        <h3>2 , EC2へ直接デプロイ</h3>
        <p>デプロイ自体は成功しました。しかし、ポート番号がついてしまい独自ドメイン化できなかったので失敗。</p>
        <p>ここで、Djangoの場合は直接デプロイする方法は一般的ではないことに気づきました。</p>
        <br>
        <h3>3 , Nginx , GunicornでEC2へデプロイ</h3>
        <p>検索したところNginx , Gunicornを使ったデプロイが一般的であることがわかりました。</p>
        <p>そこで試したところ、デプロイには成功しましたが静的ファイルを読み込んでくれず失敗。</p>
        <p>様々な対処法を試しましたがどれも上手くいかず、応急処置としてCSSやJSはHTMLに全て埋め込みました。</p>
        <br>
        <h3>4 , Route 53でドメインを取得し、独自ドメイン化</h3>
        <p>ポート番号により独自ドメイン化には手間取りましたが、この工程自体は難しいものではありませんでした。</p>
        <p>よってこの作業はすぐに完了しました。</p>
        <br>
        <h3>5 , SSL化</h3>
        <p>初めはAWSのACMでSSL化を試みましたが、ロードバランサーの設定が上手くいかず諦めました。</p>
        <p>代替案としてNginxでCertbotを使用し、SSL化に成功しました。</p>
        <br>
        <h3>6 , ミスの対処</h3>
        <p>最後の最後に、jQueryの読み込み先のリンクがhttp:になっていたことに気づき、動作しなかったのでもう一度デプロイしました。</p>
        <h3>7 , 完成</h3>
        <hr>

        <h2 class="subtitle">開発期間</h2>
        <p>約5日かかりました。</p>
        <p>上記で述べた工程のように、失敗の繰り返しによりEC2へのデプロイには丸一日かかってしまいました。</p>
        <hr>
        
        <h2 class="subtitle">最後に</h2>
        <p>このPortfolioですが問題点があります。</p>
        <p>それは静的ファイルを読み込むことが出来ていないという点です。</p>
        <p>HTMLに直接埋め込むという応急処置をとりましたが、メンテナンス性が悪いので今後修正する必要があります。</p>
        <p>そして今後はPWA化をしたいと考えています。</p>
        <p>サービスワーカーなどの知識を習得し、ネイティブアプリケーション化する予定です。</p>     
        <p>以上で紹介を終わりとさせていただきます。</p>
        <p>ご覧いただきありがとうございました。</p>
    </div>
    
    <style>
        /* ヘッダー周り */
header{
    position:fixed;
    display:flex;
    height:45px;
    z-index: 9;
}
.title{
    position:fixed;
    top: 0;
    left: 0;
    margin-top:0px;
    background-color:skyblue;
    color:white;
    width:100%;
    padding: 10px 0 10px 1%
    
}
.title a{
    color:white;
    text-decoration:none;
    padding-left:1%;
}
.subtitle{
    text-align: center;
    font-size: 35px;
    margin-bottom: 50px;
    margin-top: 30px;
    color: deepskyblue;
    position: relative;
}
.subtitle:after {
    position: absolute;
    top: 50px;
    bottom: 0;
    left: 32.8%;
    width: 35%;
    height: 6px;
    content: '';
    border-radius: 3px;
    background-image: -webkit-gradient(linear, right top, left top, from(#2af598), to(#009efd));
    background-image: -webkit-linear-gradient(right, #2af598 0%, #009efd 100%);
    background-image: linear-gradient(to left, #2af598 0%, #009efd 100%);
  }
    img{
    width: 100%;
}

/*　メイン　*/
    .pic{
        text-align: center;
        margin-top: 100px;
    }
    .box{
        width: 50%;
        margin:auto;
        margin-top: 80px;
    }
    .box a{
        color: royalblue;
        text-decoration: none;
    }
    h3{
        font-size: 25px;
    }
    @media screen and (max-width: 767px) {
        header{
            margin-bottom: 50px;
        }
        .box{
            width:90%;
            margin: auto;
            margin-top:80px;
        }
        .subtitle{
                text-align: center;
                font-size: 30px;
                margin-bottom: 30px;
                margin-top: 20px;
                color: deepskyblue;
                position: relative;
            }
        .subtitle:after {
            position: absolute;
            top: 50px;
            bottom: 0;
            left: 10%;
            width: 81.5%;
            height: 6px;
            content: '';
            border-radius: 3px;
            background-image: -webkit-gradient(linear, right top, left top, from(#2af598), to(#009efd));
            background-image: -webkit-linear-gradient(right, #2af598 0%, #009efd 100%);
            background-image: linear-gradient(to left, #2af598 0%, #009efd 100%);
            }
        h3{
            font-size: 20px;
        }
    }
        </style>
</body>
</html>