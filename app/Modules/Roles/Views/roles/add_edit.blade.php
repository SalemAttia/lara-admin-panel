@extends('Dashboard::base.form')
@section('formTitle',"Roles")
@section('formMethod', formMethod($action))
@section('formAction', formAction($action, 'admin.roles', inputValue('id', $data)) )
{{--@section('formEncType', 'enctype="multipart/form-data"' )--}}
@section('form')
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="roleName">Role Name</label>
        <input name="name" class="form-control" id="roleName" placeholder="Name"
               value="{{ inputValue('name' , $data) }}">
        @errors('name')
    </div>

    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="roleDesc">Role Description</label>
        <input name="description" class="form-control" id="roleDesc" placeholder="Description"
               value="{{ inputValue('description' , $data) }}">
        @errors('description')
    </div>

    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
        <label for="slug">Role Slug</label>
        <input name="slug" class="form-control" id="slug" placeholder="Slug" value="{{ inputValue('slug' , $data) }}">
        @errors('slug')
    </div>

    <div class="form-group{{ $errors->has('actions') ? ' has-error' : '' }}">
        <div >
            <ul style="list-style: none;padding: 20px; margin: 10px 0 30px 0; border: 4px solid #efefef">
                <li class='title'><h2>Actions</h2></li>
                <?php listOfRoles(function($role, $name) use ($data){ ?>
                <li style="list-style: none;display: inline-block;margin: 0 10px"><label>
                        {{ strtoupper($role) }}
                        <input type="checkbox" name="actions[]" value="{{ $name }}"
                               class="flat-red" {{ in_array($name, inputValue('actions', $data, [])) ? 'checked' : '' }}>
                    </label></li>
                <?php });?>
            </ul>
        </div>
        @errors('actions')
    </div>

    <div class="form-group{{ $errors->has('permissions') ? ' has-error' : '' }}">
        <div>
            <ul style="list-style: none;padding: 20px; margin: 10px 0 30px 0; border: 4px solid #efefef">
                <li class='title'><h2>Permissions</h2></li>
                <?php listOfPermissions(function($permission) use ($data){ ?>
                <li style="list-style: none;display: inline-block"><label>
                        {{ strtoupper($permission->name) }}
                        <input type="checkbox" name="permissions[]" value="{{ $permission->slug }}"
                               class="flat-red" {{ in_array($permission->slug, inputValue('permissions', $data, [])) ? 'checked' : '' }}>
                    </label></li>
                <?php });?>
            </ul>
        </div>
        @errors('permissions')
    </div>
@endsection