@extends('layouts.login')

@section('content')

<h1>Laravelを使った投稿機能の実装</h1>

<p>投稿する</p>
<div class='container'>


  <h2 class='page-header'>新しく投稿をする</h2>
  {!! Form::open(['url' => 'post/create']) !!}
  <div class="form-group">
    {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!}
  </div>
  <button type="submit" class="btn btn-success pull-right">追加</button>
  {!! Form::close() !!}



</div>



<table>
  <tr>
    <th>投稿者</th>
    <th>投稿日時</th>
    <th>投稿内容</th>
    <th>編集ボタン</th>
    <th>削除ボタン</th>
    <th>編集日時</th>

    <th></th>
  </tr>

  @foreach($posts as $post)
  <tr>
    <td>{{Auth::user()->username}}</td>
    <td>{{$post->created_at}}</td>
    <td>{{$post->posts}}</td>



    <!--編集用のボタン-->
    <td><a class="btn btn-primary" href="/post/{{$post->id}}/updateForm"><img src="storage/images/edit.png"></a></td>

    <!--削除ボタン-->
    <td>
      <a class="btn btn-danger" href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"><img src="storage/images/trash.png"></a>
    </td>

    <td>{{$post->updated_at}}</td>
  </tr>

  @endforeach
</table>
@endsection
