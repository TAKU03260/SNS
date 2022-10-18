@extends('layouts.login')


@section('content')


<img src="{{ asset('/storage/images/'.$user->images) }}">
<p>NAME：{{ $user->username }}</p>
<p>BIO：{{$user->bio}}</p>
<br><br>

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




@foreach($posts as $post)
<p>
  <img src="{{ asset('/storage/images/'.$post->images) }}">
  {{$post->username}}
  {{$post->posts}}
  {{$post->created_at}}
</p>





@endforeach









@endsection
