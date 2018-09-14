@extends('Dashboard::base.form')
@section('formMethod', formMethod($action))
@section('formAction', formAction($action, 'admin.Log', inputValue('id', $data)) )
@section('formEncType', "multipart/form-data")
@section('form')

@endsection
