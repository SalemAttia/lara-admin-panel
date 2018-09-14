@extends('Dashboard::layouts.master')
@section('tableButton')
    @if(getCurrentAdminRoles()->hasAction(substr(Route::current()->action['as'], 0, -5).'create'))

        <li class="m-nav__item">
            <a href="{{ route( substr(Route::current()->action['as'], 0, -5) . 'create' ) }}"  class="m-nav__link">
                <i class="m-nav__link-icon flaticon-share"></i>
                <span class="m-nav__link-text">Create</span>
            </a>
        </li>

        @if(isset($xlx) && $xlx == true)
            <li class="m-nav__item">
                <a href="{{ url('dashboard/ExportExcel/'.explode('/',Route::current()->uri())[1]) }}"  class="m-nav__link">
                    <i class="m-nav__link-icon flaticon-chat-1"></i>
                    <span class="m-nav__link-text">Export Excel</span>
                </a>
            </li>
        @endif

    @endif

@endsection
@section('content')
    @yield('tableBefore')
    <div class="m-portlet m-portlet--mobile col-xs-12" id="tablefilteration">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        @yield('tableTitle')

                    </h3>
                </div>


            </div>
            <div class="m-portlet__head-tools">
                <ul class="m-portlet__nav">

                    <li class="m-portlet__nav-item">
                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                            <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl m-dropdown__toggle">
                                <i class="la la-plus m--hide"></i>
                                <i class="la la-ellipsis-h m--font-brand"></i>
                            </a>
                            <div class="m-dropdown__wrapper">
                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                <div class="m-dropdown__inner">
                                    <div class="m-dropdown__body">

                                        <div class="m-dropdown__content">
                                            <ul class="m-nav">
                                                <li class="m-nav__section m-nav__section--first">
                                                    <span class="m-nav__section-text">Quick Actions</span>
                                                </li>
                                                @yield('tableButton')
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
        @if(isset($cols))
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption" style="padding-top: 8px;">
                <div class="m-portlet__head-title">
                    <br>

                    <h3 class="m-portlet__head-text">
                        Filtration :-

                        {{--@if(getCurrentAdmin()->isRole('manager'))--}}
                        {{--<a href="/dashboard/exportPrescriptionTracker" style="margin-left: 50px;" class="dt-button buttons-html5 pull-right">--}}
                        {{--<i class="glyphicons glyphicons-file-export"></i>EXCEL--}}
                        {{--</a>--}}
                        {{--@endif--}}

                        <small>
                            <div class="form-group ">
                                <label for="userName">Filed</label>
                                <select name="" class="form-control" v-model="filed" v-on:change="getdata()" id="">
                                    <option value="id">ID</option>

                                        @foreach($cols as $col)
                                            <option value="{{$col}}">{{$col}}</option>
                                        @endforeach

                                </select>
                            </div>
                        </small>
                        |
                        <small>
                            <div class="form-group ">
                                <label for="userName">Order</label>
                                <select v-model="order" class="form-control" v-on:change="getdata()" id="">
                                    <option value="asc">ASC</option>
                                    <option value="desc">DESC</option>
                                </select>
                            </div>
                        </small>
                        |
                        <small>
                            <div class="form-group ">
                                <label for="userName">Search in Filed</label>
                                <input class="form-control" id="userName" v-on:change="getdata()" v-model="searchtext" placeholder="type text here">
                            </div>
                        </small>

                    </h3>

                </div>


            </div>

        </div>
        @endif

        <div class="m-portlet__body">
            <!--begin: Datatable -->
                <table style="width: 100%;white-space: unset;" id="@yield('tableId', 'items')"  class="mdl-data-table display @yield('tableClass')" cellspacing="0" width="100%">
                    @yield('table')
                </table>
            <!--begin::Modal-->
            <div class="modal fade" id="delete-form-modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Delete
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure to Delete?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                Close
                            </button>
                            <a class="btn btn-danger"  v-on:click="DeleteRow()">
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Modal-->
            <!--end: Datatable -->
        </div>
    </div>

    @yield('tableAfter')

    <!--begin::Modal-->
    <div class="modal fade" id="delete-form-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Delete
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to Delete?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="button" class="btn btn-danger" id="deleteConfirm" data-id>
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->



@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.material.min.css">
    <style>

        .dataTables_wrapper{
            display: block;
            padding-bottom: 40px;
        }
        table, .mdl-data-table{
            width: 100%;
            margin-bottom: 30px;
        }
        .dt-buttons, .dataTables_info{
            float: left;
        }
        .dataTables_filter{
            float: right;
            margin-bottom: 20px;
            position: relative;
            top: -5px;
        }
        .dataTables_paginate{
            float: right;
        }
        .dt-button{
            border: none;
            border-radius: 2px;
            position: relative;
            height: 36px;
            margin: 0;
            min-width: 64px;
            padding: 0 16px;
            display: inline-block;
            font-family: "Roboto","Helvetica","Arial",sans-serif;
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0;
            overflow: hidden;
            will-change: box-shadow;
            transition: box-shadow .2s cubic-bezier(.4,0,1,1),background-color .2s cubic-bezier(.4,0,.2,1),color .2s cubic-bezier(.4,0,.2,1);
            outline: none;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
            line-height: 36px;
            vertical-align: middle;
            background: #3f51b5;
            color: #fff;
        }
        .dt-button:hover{
            color: rgba(255,255,255,0.4);
            text-decoration: none;
        }
        .dataTables_length label{
            float: left !important;
        }
        small label{
            color: #000;
        }

        .form-control {
            border-color: #576077;
            color: #575962;
        }

         [v-cloak] {
             display: none;
         }
        .diehere{
            display: none;
        }
        #secondbody td{
            text-align: left !important;
        }

    </style>
@endpush

@push('scripts')

    <script src="/assets/js/datatable/jquery.dataTables.min.js"></script>
    {{--<script src="/assets/js/datatable/dataTables.bootstrap.min.js"></script>--}}
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.material.min.js"></script>
    <script src="/assets/js/datatable/dataTables.buttons.min.js"></script>
    <script src="/assets/ajax/datatable/jszip.min.js"></script>
    <script src="/assets/ajax/datatable/pdfmake.min.js"></script>
    <script src="/assets/ajax/datatable/vfs_fonts.js"></script>
    <script src="/assets/js/datatable/buttons.html5.min.js"></script>
    <script src="/assets/js/datatable/buttons.print.min.js"></script>
    <script>
//        deleteConfirm
        $('.deleteAction').click(function (e) {
            e.preventDefault();
            $('#deleteConfirm').attr('data-id', $(this).data('id'));
        });

        $('#deleteConfirm').click(function (e) {
            e.preventDefault();
            $('#delete-form-modal').modal('hide');
            $($(this).data('id')).submit();
        });
    </script>

    <script>
        //        deleteConfirm
        $('.deleteAction').click(function (e) {
            e.preventDefault();
            $('#deleteConfirm').attr('data-id', $(this).data('id'));
        });

        $('#deleteConfirm').click(function (e) {
            e.preventDefault();
            $('#delete-formform-modal').modal('hide');
            $($(this).data('id')).submit();
        });
    </script>
@endpush

@section('scripts')
    <script>
        $(function () {
            $('#items').DataTable({
                columnDefs: [
                    {
                        targets: [ 0, 1, 2 ],
                        className: 'mdl-data-table__cell--non-numeric'
                    }
                ],
                @if(getCurrentAdminRoles()->hasPermission('datatable.export'))
                lengthChange: false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
                @endif
            });

        })
    </script>
        <script src="{{asset('js/vue.js')}}"></script>
        <script src="{{asset('js/vue-resource.js')}}"></script>
        <script src="{{asset('js/tablefilteration.js')}}"></script>
        <script>

        </script>




@endsection