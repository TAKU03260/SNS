@extends('layouts.login')

@section('content')
<h1>Follow List</h1>


<h2>{{ $user->username }}がフォローしている人</h2>


<p>llll</p>

@foreach($follow_users as $follow_user)
<p>{{ $follow_user->id }}</p>
<p>{{ $follow_user->username }}</p>
<a href="/{{$follow_user->id}}/follow_profile"><img src="{{ asset('/storage/images/'.$user->images) }}"></a>


@endforeach


@endsection
