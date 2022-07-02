@extends('layouts.login')

@section('content')

<h3>プロフィール</h3>


<div style="margin-top: 30px;">

  <table class="table table-striped">
    <tr>
      <th>UserName</th>
      <td>{{ Auth::user()->username }}</td>
    </tr>
    <tr>
      <th>MailAdress</th>
      <td>{{ Auth::user()->mail }}</td>
    </tr>
    <tr>
      <th>Password</th>
      <td>{{ Auth::user()->password }}</td>
    </tr>
    <tr>
      <th>new Password</th>
      <td><input type="password" name="new_password"></td>
    </tr>
    <tr>
      <th>Bio</th>
      <td>{{Auth::user()->bio}}
      <td>
    </tr>
    <tr>
      <th>Icon Image</th>
      <td><img src="{{ asset('/storage/images/'. Auth::user()->images) }}"></td>
    </tr>
  </table>

</div>

@endsection
