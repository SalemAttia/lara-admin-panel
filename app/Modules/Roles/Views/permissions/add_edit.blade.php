@extends('Dashboard::base.form')
@section('formMethod', formMethod($action))
@section('formAction', formAction($action, 'admin.permissions', inputValue('id', $data)) )
@section('form')
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="roleName">Permission Name</label>
        <input name="name" class="form-control" id="roleName" placeholder="Name" value="{{ inputValue('name' , $data) }}">
        @errors('name')
    </div>

    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="roleDesc">Permission Description</label>
        <input name="description" class="form-control" id="roleDesc" placeholder="Description" value="{{ inputValue('description' , $data) }}">
        @errors('description')
    </div>

    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
        <label for="slug">Permission Slug</label>
        <input name="slug" class="form-control" id="slug" placeholder="Slug" value="{{ inputValue('slug' , $data) }}">
        @errors('slug')
    </div>
@endsection

{{--@section('formFooter')--}}
{{--<button type="submit" class="btn btn-primary">Add</button>--}}
{{--<button type="submit" class="btn btn-primary">Edit</button>--}}
{{--@endsection--}}
