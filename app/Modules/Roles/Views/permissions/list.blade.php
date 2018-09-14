@extends('Dashboard::base.table')
@section('tableTitle', 'Roles')

@section('table')
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Action</th>
    </tr>
    </thead>

    <tbody>
    @foreach($data as $val)
    <tr>
        <td>{{ $val->id }}</td>
        <td>{{ $val->name }}</td>
        <td>{{ $val->description }}</td>
        <td>
            @include('Dashboard::base.actions', ['id' => $val->id, 'route' => 'admin.permissions' ])
        </td>
    </tr>
    @endforeach
    </tbody>
@endsection