@extends('Dashboard::base.form')
@section('formMethod', formMethod($action))
@section('formAction', formAction($action, 'admin.Team', inputValue('id', $data)) )
@section('formEncType', "multipart/form-data")
@section('form')
   <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
			<label for="userName">title</label>
			<input name="title" class="form-control" id="userName" placeholder="" value="{{ inputValue('title' , $data) }}">
			@errors('title')
			</div>
			

@endsection
