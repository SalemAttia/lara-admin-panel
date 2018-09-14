@extends('Dashboard::base.table')
@section('tableTitle', 'Admins')

@section('table')
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    </thead>

    <tbody>
    @php $i = 1; @endphp
    @foreach($data as $val)
    <tr>
        <td>{{ $i }} @php $i++; @endphp </td>
        <td>{{ $val->name }}</td>
        <td>{{ $val->email }}</td>
        <td>
            @include('Dashboard::base.actions', ['id' => $val->id, 'route' => 'admin.admins' ])
        </td>
    </tr>
    @endforeach
    </tbody>
@endsection