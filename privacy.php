<!--　　WordPressコピペ　　-->

<?php
//セキュリティー対策
header('X-Frame-Options: SAMEORIGIN');

session_start();
session_regenerate_id();

//直接アクセスの禁止
if (!isset ($_SESSION['user'] )){
    header('Location:home.php');
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <title>privacy-policy</title>
    <link rel="stylesheet" href="CSS/privacy.css">
    <script src="JS/privacy.js" async></script>
    <link rel="manifest" href="manifest.webmanifest" />
    <link rel="apple-touch-icon" sizes="180x180" href="icon-192x192.png">
    <script>
        window.addEventListener('load', function () {
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register("/sw.js")
                    .then(function (registration) {
                        console.log("serviceWorker registed.");
                    }).catch(function (error) {
                        console.warn("serviceWorker error.", error);
                    });
            }
        });
    </script>
</head>
<body>
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
                        <li><h5><a href="about.php">＊Travel Japan ! とは</a></h5></li>
                        <li><h5><a href="mypage.php">＊マイページ</a></h5></li>
                        <li><h5><a href="ranking.php">＊ランキング</a></h5></li>
                        <li><h5><a href="privacy.php">＊プライバシーポリシー</a></h5></li>
                        <li><h5><a href="contactform.php">＊お問い合わせ</a></h5></li>
                    </ul>
                </div>
            </div>
        </div>

        <!--タイトル-->
        <h1 class="title">&nbsp;Travel Japan !</h1>
    </header> 
    
    <!--内容　WordPressコピーペースト-->

    <h2 class="post-title">＊プライバシーポリシー＊</h2>
    
        
    <div class="post-content entry-content">
    
        
        <h2 class="wp-block-heading">基本方針</h2>
        
        
        
        <p>当サイトは、個人情報の重要性を認識し、個人情報を保護することが社会的責務であると考え、個人情報に関する法令を遵守し、当サイトで取扱う個人情報の取得、利用、管理を適正に行います。</p>
        
        
        
        <h2 class="wp-block-heading">適用範囲</h2>
        
        
        
        <p>本プライバシーポリシーは、お客様の個人情報もしくはそれに準ずる情報を取り扱う際に、当サイトが遵守する方針を示したものです。</p>
        
        
        
        <h2 class="wp-block-heading">個人情報の利用目的</h2>
        
        
        
        <p>当サイトは、お客様からご提供いただく情報を以下の目的の範囲内において利用します。</p>
        
        
        
        <ul class="is-style-default">
        <li>ご本人確認のため</li>
        
        
        
        <li>お問い合わせ、コメント等の確認・回答のため</li>
        
        
        
        <li>メールマガジン・DM・各種お知らせ等の配信・送付のため</li>
        
        
        
        <li>キャンペーン・アンケート・モニター・取材等の実施のため</li>
        
        
        
        <li>サービスの提供・改善・開発・マーケティングのため</li>
        
        
        
        <li>お客さまの承諾・申込みに基づく、提携事業者・団体等への個人情報の提供のため</li>
        
        
        
        <li>利用規約等で禁じている行為などの調査のため</li>
        
        
        
        <li>その他個別に承諾いただいた目的</li>
        </ul>
        
        
        
        <h2 class="wp-block-heading">個人情報の管理</h2>
        
        
        
        <p>当サイトは、個人情報の正確性及び安全確保のために、セキュリティ対策を徹底し、個人情報の漏洩、改ざん、不正アクセスなどの危険については、必要かつ適切なレベルの安全対策を実施します。</p>
        
        
        
        <p>当サイトは、第三者に重要な情報を読み取られたり、改ざんされたりすることを防ぐために、SSLによる暗号化を使用しております。</p>
        
        
        
        <h2 class="wp-block-heading">個人情報の第三者提供</h2>
        
        
        
        <p>当サイトは、以下を含む正当な理由がある場合を除き、個人情報を第三者に提供することはありません。</p>
        
        
        
        <ul class="is-style-default">
        <li>ご本人の同意がある場合</li>
        
        
        
        <li>法令に基づく場合</li>
        
        
        
        <li>人の生命・身体・財産の保護に必要な場合</li>
        
        
        
        <li>公衆衛生・児童の健全育成に必要な場合</li>
        
        
        
        <li>国の機関等の法令の定める事務への協力の場合（税務調査、統計調査等）</li>
        </ul>
        
        
        
        <p>当サイトでは、利用目的の達成に必要な範囲内において、他の事業者へ個人情報を委託することがあります。</p>
        
        
        
        <h2 class="wp-block-heading">個人情報に関するお問い合わせ</h2>
        
        
        
        <p>開示、訂正、利用停止等のお申し出があった場合には、所定の方法に基づき対応致します。具体的な方法については、個別にご案内しますので、お問い合わせください。</p>
        
        
        
        <h2 class="wp-block-heading">Cookie（クッキー）</h2>
        
        
        
        <p>Cookie（クッキー）は、利用者のサイト閲覧履歴を、利用者のコンピュータに保存しておく仕組みです。</p>
        
        
        
        <p>利用者はCookie（クッキー）を無効にすることで収集を拒否することができますので、お使いのブラウザの設定をご確認ください。ただし、Cookie（クッキー）を拒否した場合、当サイトのいくつかのサービス・機能が正しく動作しない場合があります。</p>
        
        
        
        <h2 class="wp-block-heading">アクセス解析</h2>
        
        
        
        <p>当サイトでは、サイトの分析と改善のためにGoogleが提供している「Google アナリティクス」を利用しています。</p>
        
        
        
        <p>このサービスは、トラフィックデータの収集のためにCookie（クッキー）を使用しています。トラフィックデータは匿名で収集されており、個人を特定するものではありません。</p>
        
        
        
        <h2 class="wp-block-heading">広告配信</h2>
        
        
        
        <p>当サイトは、第三者配信の広告サービス「Google アドセンス」を利用しています。</p>
        
        
        
        <p>広告配信事業者は、利用者の興味に応じた広告を表示するためにCookie（クッキー）を使用することがあります。これによって利用者のブラウザを識別できるようになりますが、個人を特定するものではありません。</p>
        
        
        
        <p>Cookie（クッキー）を無効にする方法や「Google アドセンス」に関する詳細は、https://policies.google.com/technologies/ads?gl=jp をご覧ください。</p>
        
        
        
        <p>また、Amazonのアソシエイトとして、当サイトは適格販売により収入を得ています。</p>
        
        
        
        <h2 class="wp-block-heading">コメント・お問い合わせフォーム</h2>
        
        
        
        <p>当サイトでは、コメント・お問い合わせフォームに表示されているデータ、そしてスパム検出に役立てるための IP アドレスやブラウザのユーザーエージェント文字列等を収集します。</p>
        
        
        
        <p>メールアドレスから作成される匿名化されたハッシュ文字列は、あなたが「Gravatar」サービスを使用中かどうか確認するため同サービスに提供されることがあります。</p>
        
        
        
        <p>同サービスのプライバシーポリシーは、https://automattic.com/privacy/ をご覧ください。</p>
        
        
        
        <p>なお、コメントが承認されると、プロフィール画像がコメントとともに一般公開されます。</p>
        
        
        
        <h2 class="wp-block-heading">他サイトからの埋め込みコンテンツ</h2>
        
        
        
        <p>当サイトには、埋め込みコンテンツ （動画、画像、投稿など）が含まれます。他サイトからの埋め込みコンテンツは、訪問者がそのサイトを訪れた場合とまったく同じように振る舞います。</p>
        
        
        
        <p>これらのサイトは、あなたのデータの収集、Cookie（クッキー）の使用、サードパーティによる追加トラッキングの埋め込み、埋め込みコンテンツとのやりとりの監視を行うことがあります。</p>
        
        
        
        <p>アカウントを使ってそのサイトにログイン中の場合、埋め込みコンテンツとのやりとりのトラッキングも含まれます。</p>
        
        
        
        <h2 class="wp-block-heading">免責事項</h2>
        
        
        
        <p>当サイトのコンテンツ・情報について、可能な限り正確な情報を掲載するよう努めておりますが、正確性や安全性を保証するものではありません。当サイトに掲載された内容によって生じた損害等の一切の責任を負いかねますのでご了承ください。</p>
        
        
        
        <p>当サイトからリンクやバナーなどによって他のサイトに移動した場合、移動先サイトで提供される情報、サービス等について一切の責任を負いません。</p>
        
        
        
        <p>当サイトで掲載している料金表記について、予告なく変更されることがあります。</p>
        
        
        
        <h2 class="wp-block-heading">著作権・肖像権</h2>
        
        
        
        <p>当サイトで掲載しているすべてのコンテンツ（文章、画像、動画、音声、ファイル等）の著作権・肖像権等は当サイト所有者または各権利所有者が保有し、許可なく無断利用（転載、複製、譲渡、二次利用等）することを禁止します。また、コンテンツの内容を変形・変更・加筆修正することも一切認めておりません。</p>
        
        
        
        <p>各権利所有者におかれましては、万一掲載内容に問題がございましたら、ご本人様よりお問い合わせください。迅速に対応いたします。</p>
        
        
        
        <h2 class="wp-block-heading">リンク</h2>
        
        
        
        <p>当サイトは原則リンクフリーです。リンクを行う場合の許可や連絡は不要です。引用する際は、引用元の明記と該当ページへのリンクをお願いします。</p>
        
        
        
        <p>ただし、画像ファイルへの直リンク、インラインフレームを使用したHTMLページ内で表示する形でのリンクはご遠慮ください。</p>
        
        
        
        <h2 class="wp-block-heading">本プライバシーポリシーの変更</h2>
        
        
        
        <p>当サイトは、本プライバシーポリシーの内容を適宜見直し、その改善に努めます。</p>
        
        
        
        <p>本プライバシーポリシーは、事前の予告なく変更することがあります。</p>
        
        
        
        <p>本プライバシーポリシーの変更は、当サイトに掲載された時点で有効になるものとします。</p>
                                      
    </div>

    <!--ボトムメニュー-->
    <footer>
        <ul class="under_menu">
            <li><a href="index.php">ホーム</a></li>
            <li><a href="add.php">投稿する</a></li>
            <li><a href="search.php">検索</a></li>
        </ul>
    </footer> 
</body>
</html>
