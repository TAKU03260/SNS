@extends('layouts.logout')

@section('content')

{!! Form::open() !!}

<p>DAWNSNSへようこそ</p>
<div class="login-form">

  <div class="login-MailAdress">
    {{ Form::label('MailAdress') }}
    <br>
    {{ Form::text('mail',null,['class' => 'input']) }}
  </div>
  <br><br>
  <div class="login-Password">
    {{ Form::label('Password') }}
    <br>
    {{ Form::password('password',['class' => 'input']) }}
  </div>
  <br>
  <btn>
    {{ Form::submit('LOGIN',['class' => 'btn']) }}

  </btn>
  <p><a href="/register">新規ユーザーの方はこちら</a></p>



  {!! Form::close() !!}

  @endsection
