@extends('layouts.login')

@section('content')
<h1>Follower List</h1>


<h2>{{ $user->username }}をフォローしている人</h2>



@foreach($follower_users as $follower_user)
<p>{{ $follower_user->id }}</p>
<p>{{ $follower_user->username }}</p>



<a href="/{{$follower_user->id}}/follower_profile"><img src="{{ asset('/storage/images/'.$user->images) }}"></a>
@endforeach


@endsection
