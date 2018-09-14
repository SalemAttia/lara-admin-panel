@extends('Dashboard::base.form')
@section('formMethod', formMethod($action))
@section('formAction', formAction($action, 'admin.admins', inputValue('id', $data)) )
@section('form')
    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="adminName">Admin Name</label>
        <input name="name" class="form-control" id="adminName" placeholder="Name"
               value="{{ inputValue('name' , $data) }}">
        @errors('name')
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="adminEmail">Admin Email</label>
        <input name="email" class="form-control" id="adminEmail" placeholder="Email"
               type="email" value="{{ inputValue('email' , $data) }}">
        @errors('email')
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="adminPass">Password</label>
        <input type="password" name="password" class="form-control" id="adminPass" placeholder="Password" autocomplete="off">
        @errors('password')
    </div>

    <div class="form-group {{ $errors->has('role') ? ' has-error' : '' }}">
        <label for="adminRole">Role</label>
        <select id="adminRole" name="role" class="form-control" id="adminRole" required>
            <option value="">Select Role</option>
            @foreach($roles as $role)
                <option value="{{$role->slug}}" {{ inputValue('role' , $data) == $role->slug ? 'selected' : '' }}>{{ $role->name }}</option>
            @endforeach
        </select>
        @errors('role')
    </div>


@endsection

@section('scripts')

@endsection