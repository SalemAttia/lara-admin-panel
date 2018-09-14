@extends('Dashboard::base.form')
@section('formMethod', formMethod($action))
@section('formAction', formAction($action, 'admin.User', inputValue('id', $data)) )
@section('formEncType', "multipart/form-data")
@section('form')

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="userName">name</label>
        <input name="name" class="form-control" id="userName" placeholder="" value="{{ inputValue('name' , $data) }}">
        @errors('name')
    </div>
    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="userName">email</label>
        <input name="email" type="email" class="form-control" id="userName" placeholder="" value="{{ inputValue('email' , $data) }}">
        @errors('email')
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="userName">password</label>
        <input name="password" type="password" class="form-control" id="userName" placeholder="" value="{{ inputValue('password' , $data) }}">
        @errors('password')
    </div>

    <div class="form-group{{ $errors->has('teams') ? ' has-error' : '' }}">
        <label for="userName">teams</label>
        @foreach($teams as $team)

         <input name="teams[]" type="checkbox" class="form-control" id="userName" @if(in_array($team->id,$userTeams) == true) checked @endif placeholder="" value="{{ $team->id }}"> {{$team->title}}
        @endforeach
        @errors('teams')
    </div>

@endsection
