@extends('Dashboard::layouts.master')
@section('content')
    <div class="m-content">
        <!--Begin::Main Portlet-->
        <div class="m-portlet">
            <div class="m-portlet__body  m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">

                    <div class="col-xl-4">
                        <!--begin:: Widgets/Profit Share-->
                        <div class="m-widget14">
                            <div class="m-widget14__header">
                                <h3 class="m-widget14__title">
                                   Teams
                                </h3>
                                <span class="m-widget14__desc">
													Count of all Teams
												</span>
                            </div>
                            <div class="row  align-items-center">
                                <div class="col">
                                    <div id="m_chart_profit_share" class="m-widget14__chart" style="height: 160px">
                                        <div class="m-widget14__stat">
                                            {{$teams}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--end:: Widgets/Profit Share-->
                    </div>
                    <div class="col-xl-4">
                        <!--begin:: Widgets/Profit Share-->
                        <div class="m-widget14">
                            <div class="m-widget14__header">
                                <h3 class="m-widget14__title">
                                    Users
                                </h3>
                                <span class="m-widget14__desc">
													Count of all Users
												</span>
                            </div>
                            <div class="row  align-items-center">
                                <div class="col">
                                    <div id="m_chart_profit_share" class="m-widget14__chart" style="height: 160px">
                                        <div class="m-widget14__stat">
                                            {{$users}}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!--end:: Widgets/Profit Share-->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <!--end::Base Scripts -->
    <!--begin::Page Vendors -->


@endpush