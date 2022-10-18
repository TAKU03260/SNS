@extends('layouts.login')

@section('content')
<h1>Follower List</h1>


<h2>{{ $user->username }}をフォローしている人</h2>



@foreach($follower_users as $follower_user)
<p>{{ $follower_user->id }}</p>
<p>{{ $follower_user->username }}</p>



<a href="/{{$follower_user->id}}/follower_profile"><img src="{{ asset('/storage/images/'.$follower_user->images) }}"></a>
@endforeach


<!--フォローしている人の投稿一覧-->



<table>


  <tr>
    <th>画像</th>
    <th>投稿者</th>
    <th>投稿日時</th>
    <th>投稿内容</th>
    <th></th>
  </tr>



  @foreach($posts as $post)
  <tr>
    <td>
      <a href="/{{$post->id}}/follow_profile">
        <img src="{{ asset('/storage/images/'.$post->images) }}">
      </a>
    </td>
    <td> {{$post->username}}</td>
    <td> {{$post->posts}}</td>
    <td> {{$post->created_at}}</td>
  </tr>

  @endforeach
</table>



@endsection
