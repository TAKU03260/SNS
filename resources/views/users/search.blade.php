@extends('layouts.login')

@section('content')


<h1>ユーザー 一覧</h1>



@foreach($users as $user)
<img src="{{ asset('/storage/images/'.$user->images) }}">
<p>{{ $user->username }}</p>


@if($followings->contains('follow',$user->id))
{{Form::open(['url' =>'follow/delete'])}}
{{Form::hidden('id',$user->id)}}
<button type="submit">フォローをはずす</button>
{{Form::close()}}
@else
{{Form::open(['url' =>'follow/create'])}}
{{Form::hidden('id',$user->id)}}
<button type="submit">フォローする</button>
{{Form::close()}}
@endif
@endforeach

<div class="search">

  <form action="/search" method="post">
    @csrf
    <input type="text" placeholder="検索" name="search" />
    <button type="submit" id="sbtn"><i class="fas fa-search">
        S
      </i></button>
  </form>

</div>



@endsection
