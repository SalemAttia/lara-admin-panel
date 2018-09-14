@extends('Dashboard::layouts.master')
@php
$formTitleDefault = explode('.', Route::current()->action['as']);
array_shift($formTitleDefault);
$mainRoute = $formTitleDefault[0];
$formTitleDefault = implode(' / ', $formTitleDefault);
@endphp
@section('formFooter')
    <button type="submit" class="btn btn-primary">Submit</button>
@endsection
@section('content')
    @yield('formBefore')
    <div class="m-portlet m-portlet--tab col-md-10 col-sm-12">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                <span class="m-portlet__head-icon m--hide">
                    <i class="la la-gear"></i>
                </span>
                    <h3 class="m-portlet__head-text">
                        @yield('formTitle', $formTitleDefault)

                    </h3>

                </div>

            </div>
            @if(isset($xlx) && $xlx == true)
                <button class="btn btn-info pull-right" style="margin-top:2%;"  data-toggle="modal" data-target="#upload-form-modal">bulk upload</button>
            @endif
        </div>

        <form role="form" method="POST" action="@yield('formAction')" class="m-form m-form--fit m-form--label-align-right" enctype="@yield('formEncType')">
            {{ csrf_field() }}
            <div style="padding: 30px">
                @yield('form')
            </div>
            <!-- /.box-body -->

            <div class="m-form__actions">
                @yield('formFooter')
            </div>

            <input name="_method" type="hidden" value="@yield("formMethod")">
        </form>
    </div>
    <!-- /.box -->
    @yield('formAfter')
    <!--begin::Modal-->
    <div class="modal fade" id="upload-form-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form  action="{{url('dashboard/readExcel/'.$mainRoute)}}" method="post"  class="form-horizontal form-validate-jquery" enctype="multipart/form-data">
                {{csrf_field()}}
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Upload Data
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <p>if you want to upload data using excel sheet download template fill data required and upload it from the button below ?</p>

                    <div class="panel panel-flat">
                        <div class="panel-body">

                                <fieldset class="content-group">

                                    <div class="form-group">
                                        <label class="control-label col-lg-2">File</label>
                                        <div class="col-lg-10">
                                            <input type="file" class="form-control" required="required" name="excel" value="">
                                        </div>
                                    </div>


                                </fieldset>




                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Close
                    </button>
                    <a href="{{url('dashboard/xlxTemplate/'.$mainRoute)}}" type="button" class="btn btn-info" >
                        Download Template
                    </a>
                    <button type="submit" class="btn btn-success" id="deleteConfirm" data-id>
                        Upload
                    </button>
                </div>

            </div>
            </form>
        </div>
    </div>
    <!--end::Modal-->

@endsection

<!-- iCheck for checkboxes and radio inputs -->
@push('styles')
    <link rel="stylesheet" href="/assets/icheck/flat/_all.css">
@endpush

@push('scripts')
    <script src="/assets/icheck/icheck.js"></script>
    <script>
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass   : 'iradio_flat-green'
        })
    </script>
@endpush