@extends('layouts.login')

@section('content')

<h3>プロフィール</h3>


<div style="margin-top: 30px;">


  <h2>UserName</h2>

  <div class='container'>

    {!! Form::open(array('url' => '/profile/update','files'=> true)) !!}
    <!---->
    <!--FORMタグ始めの記述-->

    <div class="form-group">

      {!! Form::input('text', 'username', Auth::user()->username, ['required', 'class' => 'form-control']) !!}

      @if ($errors->has('username'))
      {{$errors->first('username')}}
      @endif
    </div>


    <h2>MailAdress</h2>

    <div class="form-group">

      {!! Form::input('text', 'mail', Auth::user()->mail, ['required', 'class' => 'form-control']) !!}

      @if ($errors->has('mail'))
      {{$errors->first('mail')}}
      @endif

    </div>
    <h2>Password</h2>
    <div class=" form-group">


      {!! Form::input('password', 'read_password',Auth::user()->password, [ 'class' => 'form-control']) !!}

    </div>


    <h2>Newpassword</h2>

    <div class="form-group">

      {!! Form::input('password', 'password', null, [ 'class' => 'form-control']) !!}




      @if ($errors->has('newpassword'))
      {{$errors->first('newpassword')}}
      @endif
    </div>


    <h2>bio</h2>



    <div class="form-group">

      {!! Form::input('text', 'bio', Auth::user()->bio, [ 'class' => 'form-control']) !!}

      @if ($errors->has('bio'))
      {{$errors->first('bio')}}
      @endif

    </div>





    <h2>Image</h2>


    <div class="form-group">

      {!! Form::input('file', 'images',null, [ 'class' => 'form-control']) !!}

      @if ($errors->has('images'))
      {{$errors->first('images')}}
      @endif
    </div>
    <button type="submit" class="btn btn-primary pull-right"><img src="{{ asset('/storage/images/edit.png')}}"></button>




    {!! Form::close() !!}




  </div>


</div>


@endsection
