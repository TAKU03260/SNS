<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>

<body>
    <header>


        <div id="head">
            <h1><a href="login"><img src="{{ asset('/storage/images/main_logo.png') }}"></a></h1>
            <div id="right_header">
                <div id="profile">
                    <p>
                        おかえりなさい<?php $user = Auth::user(); ?>{{ $user->username }}


                    </p>

                    <div class="basic_function">

                        <p class="nav-open active">
                            <img src="{{ asset('/storage/images/arrow.png') }}"><img src="{{ asset('/storage/images/dawn.png')}}">

                        </p>

                        <nav>
                            <ul>

                                <li><a href="/top">HOME</a></li>
                                <li><a href="/profile">プロフィール編集</a></li>
                                <li><a href="/logout">ログアウト</a></li>
                            </ul>
                        </nav>
                    </div>





                </div>
    </header>
    <div id="row">


        <div id="container">
            @yield('content')
        </div>


        <div id="side-bar">

            <div id="confirm">

                <p>{{ $user->username }}さんの</p>
                <br>
                <div>
                    <p>フォロー数</p>
                    <p>{{ $data1 }}名</p>
                </div>
                <br>
                <p class="btn"><a href="/followList">フォローリスト</a></p>
                <div>
                    <p>フォロワー数</p>
                    <p>{{$data2}}名</p>
                </div>
                <br>
                <p class="btn"><a href="/followerList">フォロワーリスト</a></p>
            </div>
            <br>

            <!--検索機能-->
            <p><a href="/search">ユーザー検索</a></p>


        </div>
    </div>
    <footer>
    </footer>
    <script src="{{ asset('js/app.js')}}"></script>
    <script>
        $(function() {
            //クリックで動く
            $('.nav-open').click(function() {
                if ($(this).hasClass('active')) {
                    $(this).toggleClass('active');
                    $(this).next('nav').fadeOut();
                } else {
                    $(this).toggleClass('active');
                    $(this).next('nav').fadeIn();
                }
            });


        });
    </script>

</body>

</html>
