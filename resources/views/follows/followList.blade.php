@extends('layouts.login')

@section('content')
<h1>Follow List</h1>


<h2>{{ $user->username }}がフォローしている人</h2>


@foreach($follow_users as $follow_user)
<p>{{ $follow_user->id }}</p>
<p>{{ $follow_user->username }}</p>
<a href="/{{$follow_user->id}}/follow_profile"><img src="{{ asset('/storage/images/'.$follow_user->images) }}"></a>


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

    <td> <a href="/{{$post->id}}/follow_profile"><img src="{{ asset('/storage/images/'.$post->images) }}"></a></td>

    <td> {{$post->username}}</td>
    <td> {{$post->posts}}</td>
    <td> {{$post->created_at}}</td>






  </tr>

  @endforeach
</table>




@endsection
