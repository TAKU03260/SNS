@extends('layouts.logout')

@section('content')

{!! Form::open() !!}


<div class="form-group">
  <p>UserName</p>

  {!! Form::input('text', 'username',null,['required']) !!}





  @if ($errors->has('username'))
  {{$errors->first('username')}}
  @endif

</div>

<div class="form-group">
  <p>MailAdress</p>
  {!! Form::input('text', 'mail',null, ['required']) !!}


  @if ($errors->has('mail'))
  {{$errors->first('mail')}}
  @endif



</div>

<div class="form-group">


  <p>Password</p>
  {!! Form::input('password', 'password',null, [ 'class' => 'form-control']) !!}

  @if ($errors->has('password'))
  {{$errors->first('password')}}
  @endif
</div>



<div class="form-group">
  <p>Password confirm</p>
  {!! Form::input('password', 'password-confirm', null, [ 'class' => 'form-control']) !!}


  @if ($errors->has('password-confirm'))
  {{$errors->first('password-confirm')}}
  @endif

</div>

{{ Form::submit('登録') }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}

@endsection
