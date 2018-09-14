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

            <div class="m-form__actions clearfix" style="padding: 10px;">
                <a href="{{ route( substr(Route::current()->action['as'], 0, -4) . 'edit' , ['id' => $data['id']]) }}" class="btn btn-primary">
                    <i class="fa fa-pencil"></i> Edit
                </a>
            </div>
            <br>


        </div>


@endsection
