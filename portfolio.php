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
        <h2 class="subtitle">＊ Portfolio ＊</h2>
        <hr>
        <h3>GitHub はこちら : <a href="https://github.com/Arata1202/portfolio" target="_blank">Arata1202</a></h3>
        <h2 class="subtitle">＊ 開発のきっかけ ＊</h2>
        <hr>
        <p>2023年の7月にプログラミングなどのIT関連の学習を始め、少しずつではありますが知識や技術を習得してきました。</p>
        <p>まだまだ業務に活かせるほどの実力はありませんが、一つの区切りとして私の努力を形にするためにこのPortfolioを作成する事にしました。</p> 
        <h2 class="subtitle">＊ 使用言語 / ツール ＊</h2>
        <hr>
        <ul>
            <li>HTML / CSS</li>
            <li>JavaScript</li>
            <li>Python / Django</li>
            <li>SQLite</li>
            <li>AWS / EC2 / Route53</li>
            <li>Nginx / Gunicorn</li>
            <li>Git / GitHub</li>
            <li>VSCode</li>
        </ul>
        <p>・フレームワークはPythonのDjangoを採用しました。</p>
        <p>&nbsp;JavaのSpringBootとどちらにしようか迷いましたが、現在はPythonの需要が高まってきていることや、将来性や需要の伸びを期待されているということでPythonのDjangoを採用しました。</p>
        
        <h2 class="subtitle">＊ アプリの設計 ＊</h2>
        <hr>
        <p>・見やすい設計にするため、サービスの紹介ページ以外は1枚のページで仕上げました。</p>
        <p>&nbsp;メンテナンス性の観点から、サービス紹介ページはTravel Japan !の一部として作成しました。</p>
        <p>・全体的な色合いを統一することやハンバーガーメニューを設置するなど、UIにも配慮をしています。</p>
        <p>・PCは勿論、縦画面のみスマートフォン , タブレットにもレスポンシブ対応しています。</p>
        <img src="images/respon.jpg" alt="">

        <h2 class="subtitle">＊ 開発工程 ＊</h2>
        <hr>
        <p><b>1 , ローカル環境でPortfolioの作成</b></p>
        <p>Djangoの構築に少し手間取りましたが、HTML , CSSには慣れていたのでスムーズに行えました。</p>
        <br>
        <p><b>2 , EC2へ直接デプロイ</b></p>
        <p>ポート番号がついてしまい、独自ドメイン化できなかったので失敗。</p>
        <br>
        <p><b>3 , Nginx , GunicornでEC2へデプロイ</b></p>
        <p>デプロイには成功しましたが、静的ファイルを読み込んでくれず失敗。</p>
        <p>様々な対処法を考えましたがどれも上手くいかず、応急処置としてCSSやJSはHTMLに全て埋め込みました。</p>
        <br>
        <p><b>4 , Route 53でドメインを取得し、独自ドメイン化</b></p>
        <p>ポート番号により独自ドメイン化には手間取りましたが、この工程自体は難しいものではありませんでした。</p>
        <br>
        <p><b>5 , SSl化</b></p>
        <p>初めはAWSのACMでSSL化を試みましたが、ロードバランサーの設定が上手くいかず諦めました。</p>
        <p>代替案としてCertbotを使用し、SSL化に成功しました。</p>
        <br>
        <p><b>6 , ミスの対処</b>
        <p>最後の最後に、jQueryの読み込み先のリンクがhttp:になっていたことに気づき、動作しなかったのでもう一度デプロイしました。</p>
        
        <h2 class="subtitle">＊ 開発期間 ＊</h2>
        <hr>
        <p>約5日かかりました。</p>
        <p>上記で述べた工程のように、失敗の繰り返しによりEC2へのデプロイには丸一日かかってしまいました。</p>
        
        <h2 class="subtitle">＊ 最後に / 今後の改善点 ＊</h2>
        <hr>
        <p>このPortfolioですが問題点があります。</p>
        <p>それは静的ファイルを読み込むことが出来ていないという点です。</p>
        <p>HTMLに直接埋め込むという応急処置をとりましたが、メンテナス性が悪いので今後修正する必要があります。</p>
        <p>そして今後はPWA化をしたいと考えています。</p>
        <p>サービスワーカーなどの知識を取得し、アプリケーション化してみたいと思います</p>
        
        <p>以上で紹介を終わりとさせていただきます。</p>
        <p>ご覧いただきありがとうございました。</p>
    </div>
    
    <style>
        /* ヘッダー周り */
    header{
        position:fixed;
        display:flex;
        height:45px;
    }
    .title{
        position:fixed;
        top: 0;
        left: 0;
        margin-top:0px;
        background-color:skyblue;
        color:white;
        width:100%;
        padding: 5px 0 5px 0
    }
    .title a{
        color:white;
        text-decoration:none;
    }
    .subtitle{
        margin-top:80px;
        margin-bottom:0px;
        text-align :center;
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
    }
    .box a{
        color: royalblue;
        text-decoration: none;
    }
    @media screen and (max-width: 767px) {
        .box{
            width:100%;
            margin-bottom:80px;
        }
    }
    </style>
</body>
</html>