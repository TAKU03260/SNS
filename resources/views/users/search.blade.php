@extends('layouts.login')

@section('content')


<h1>ユーザー 一覧</h1>



@foreach($users as $user)
<img src="{{ asset('/storage/images/'.$user->images) }}">
<p>{{ $user->username }}</p>
@endforeach

<div class="search">

  <form action="search.blade.php" method="post">
    <input type="text" placeholder="検索" name="search" />
    <button type="submit" id="sbtn"><i class="fas fa-search">
        S
      </i></button>
  </form>

</div>



@endsection
