@extends('Dashboard::base.table')
@section('tableTitle', 'Log')


   @section('table')
       <thead>
       <tr>
           <th>ID</th>
           <th>Action</th>
           <th>Url</th>
           <th>Prowser Detalis</th>
           <th>IP</th>
           <th>Admin</th>
           <th>Show</th>
       </tr>
       </thead>

       <tbody>
       @foreach($data as $val)
       <tr>
           <td>{{ $val->id }}</td>
           <td>{{ $val->action }}</td>
           <td>{{ $val->Url }}</td>
           <td style="width: 200px;">{{ $val->ProwserDetalis }}</td>
           <td>{{ $val->ip }}</td>
           <td>{{ \App\Modules\Admins\Models\Admin::find($val->user_id)->name }}</td>

           <td>
               <a href="{{ route('admin.Log' . '.show', ['id' => $val->id]) }}"><i class="la la-eye"></i> View</a>
           </td>
       </tr>
       @endforeach
       </tbody>
       <style>
           .m-portlet__nav-link{
               display: none !important;
           }
       </style>
   @endsection
