<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title>SNS</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/logout.css">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="https://hri-group.jp/images/favicon.ico" sizes="16x16" type="image/png" />
    <link rel="icon" href="https://hri-group.jp/images/favicon.ico" sizes="32x32" type="image/png" />
    <link rel="icon" href="https://hri-group.jp/images/favicon.ico" sizes="48x48" type="image/png" />
    <link rel="icon" href="https://hri-group.jp/images/favicon.ico" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="https://hri-group.jp/images/favicon.ico" />
    <!--OGPタグ/twitterカード-->
</head>

<body>
    <header>
        <h1><img src="storage/images/main_logo.png"></h1>
        <p>Social Network Service</p>
    </header>
    <div id="container">
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js')}}"></script>
</body>

</html>
