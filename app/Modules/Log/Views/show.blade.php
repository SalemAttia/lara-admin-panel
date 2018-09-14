@extends('Dashboard::layouts.master')
@section('content')


    <!-- /.box-header -->
    <!-- /.box-body -->
    <div class="m-portlet m-portlet--mobile">
        <table class="table table-bordered">
            <tbody>
            @foreach($data as $key => $val)
                <tr>
                    <th>{{ $key }}</th>
                    <td>{!!  is_array($val) ? '<span class="label label-default">' . implode('</span> <span class="label label-default">', $val). '</span>' : $val !!} </td>
                </tr>
            @endforeach
            </tbody>
        </table>


        <br>


    </div>


@endsection
