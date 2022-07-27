@extends('layouts.login')

@section('content')

<h1>Laravelを使った投稿機能の実装</h1>


<div class='container'>


  <h2 class='page-header'>新しく投稿をする</h2>

  {!! Form::open(['url' => 'post/create']) !!}
  <div class="form-group">
    {!! Form::input('text', 'newPost', null, ['required', 'class' => 'form-control', 'placeholder' => '投稿内容']) !!}
  </div>
  <button type="submit" class="btn btn-success pull-right">追加</button>
  {!! Form::close() !!}



</div>
<hr>

<br><br><br><br><br>
<table>
  <tr>
    <th>画像</th>
    <th>投稿者</th>
    <th>投稿日時</th>
    <th>投稿内容</th>
    <th>編集ボタン</th>
    <th>削除ボタン</th>


    <th></th>
  </tr>

  @foreach($posts as $post)
  <tr>

    <td> <img src="{{ asset('/storage/images/'.$post->images) }}"></td>

    <td> {{$post->username}}</td>
    <td> {{$post->posts}}</td>
    <td> {{$post->created_at}}</td>


    @if($post->user_id === Auth::id())
    <!--PostsテーブルのUser_idとログインしているユーザーが一致しているときのみ表示する-->


    <!--編集用のボタン-->
    <td>

      <button class="modal-open btn btn-danger" id="js-open" data-target="modal{{ $post->id }}"><img src="{{ asset('/storage/images/edit.png')}}"></button>
    </td>




    <div class="overlay" id="js-overlay"></div>


    <div id="modal{{ $post->id }}" class="modal">
      <div id="js-modal">

        {!! Form::open(['url' => '/post/update']) !!}
        <div class="form-group">
          {!! Form::hidden('id', $post->id) !!}
          {!! Form::input('text', 'upPost', $post->posts, ['required', 'class' => 'form-control']) !!}
        </div>


        <button type="submit" class="btn btn-primary pull-right"><img src="{{ asset('/storage/images/edit.png')}}"></button>
        {!! Form::close() !!}</p>
        <div class="modal-close__wrap">
          <button class="modal-close" id="js-close">
            <span></span>
            <span></span>
          </button>
        </div>
      </div>

    </div>








    <!--削除ボタン-->
    <td>
      <a class="btn btn-danger btn-reverse" href="/post/{{$post->id}}/delete" onclick="return confirm('こちらの投稿を削除してもよろしいでしょうか？')"><img src="{{ asset('/storage/images/trash.png')}}"></a>
    </td>

    @endif
  </tr>

  @endforeach
</table>








@endsection
