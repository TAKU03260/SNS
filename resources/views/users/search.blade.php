@extends('layouts.login')

@section('content')


<h1>ユーザー表示</h1>

<p>検索ワード：{{$keyword}}</p>
<!--検索したワードを表示する-->

@foreach($users as $user)
<img src="{{ asset('/storage/images/'.$user->images) }}">
<p>{{ $user->username }}</p>


@if($followings->contains('follow',$user->id))
<!--followカラムの中に自分のidが含まれていれば外す-->
{{Form::open(['url' =>'follow/delete'])}}
{{Form::hidden('id',$user->id)}}
<button type="submit">フォローをはずす</button>
{{Form::close()}}
@else
<!--idが含まれていなければフォローをする。-->
{{Form::open(['url' =>'follow/create'])}}
{{Form::hidden('id',$user->id)}}
<button type="submit">フォローする</button>
{{Form::close()}}
@endif
<hr>
@endforeach


<p></p>
<div class="search">

  <form action="/search" method="post">
    @csrf
    <input type="text" placeholder="検索" name="search">
    <button type="submit" id="sbtn"><i class="fas fa-search">
        SEARCH
      </i></button>
  </form>

</div>



@endsection
