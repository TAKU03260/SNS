@extends('layouts.logout')

@section('content')

<div id="clear">
  <p><?php $user = Auth::user(); ?>{{ $user->username }}さんの</p>
  <p>ようこそ！DAWNSNSへ！</p>
  <p>ユーザー登録が完了しました。</p>
  <p>さっそく、ログインをしてみましょう。</p>

  <p class="btn"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection
