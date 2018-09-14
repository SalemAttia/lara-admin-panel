<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8"/>
    <title>App Admin | @yield('title')</title>
    <meta name="description" content="Base form control examples">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!--begin::Web font -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {"families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]},
            active: function () {
                sessionStorage.fonts = true;
            }
        });
    </script>
    <!--end::Web font -->
    <!--begin::Base Styles -->
    <link href="/metronic/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css"/>
    <link href="/metronic/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css"/>
    <!--end::Base Styles -->
    <link rel="shortcut icon" href=""/>
    @stack('styles')
</head>
<!-- end::Head -->

<!-- end::Body -->
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<!-- begin:: Page -->
<div class="m-grid m-grid--hor m-grid--root m-page">
    <!-- BEGIN: Header -->
    <header class="m-grid__item    m-header " data-minimize-mobile="hide" data-minimize-offset="200"
            data-minimize-mobile-offset="200" data-minimize="minimize">
        <div class="m-container m-container--fluid m-container--full-height">
            <div class="m-stack m-stack--ver m-stack--desktop">
                <!-- BEGIN: Brand -->
                <div class="m-stack__item m-brand  m-brand--skin-dark ">
                    <div class="m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="{{ route('admin.dashboard') }}" class="m-brand__logo-wrapper">
                                <img alt="" src="/metronic/assets/demo/default/media/img/logo/logo_default_dark.png" style="width: 100%;"/>
                            </a>
                        </div>
                        <div class="m-stack__item m-stack__item--middle m-brand__tools">
                            <!-- BEGIN: Left Aside Minimize Toggle -->
                            <a href="javascript:;" id="m_aside_left_minimize_toggle"
                               class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block">
                                <span></span>
                            </a>
                            <!-- END -->
                            <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                            <a href="javascript:;" id="m_aside_left_offcanvas_toggle"
                               class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>
                            <!-- END -->
                            <!-- BEGIN: Responsive Header Menu Toggler -->
                            <a id="m_aside_header_menu_mobile_toggle" href="javascript:;"
                               class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>
                            <!-- END -->
                            <!-- BEGIN: Topbar Toggler -->
                            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;"
                               class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                <i class="flaticon-more"></i>
                            </a>
                            <!-- BEGIN: Topbar Toggler -->
                        </div>
                    </div>
                </div>
                <!-- END: Brand -->
                <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                    <!-- BEGIN: Horizontal Menu -->

                    <!-- END: Horizontal Menu -->
                    <!-- BEGIN: Topbar -->
                    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-topbar__nav-wrapper">
                            <ul class="m-topbar__nav m-nav m-nav--inline">

                               <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                    data-dropdown-toggle="click">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic">
													<img src="/metronic/assets/app/media/img/users/user4.jpg"
                                                         class="m--img-rounded m--marginless m--img-centered" alt=""/>
												</span>
                                        <span class="m-topbar__username m--hide">
													Nick
												</span>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__header m--align-center"
                                                 style="background: url(/metronic/assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">
                                                <div class="m-card-user m-card-user--skin-dark">
                                                    <div class="m-card-user__pic">
                                                        <img src="/metronic/assets/app/media/img/users/user4.jpg"
                                                             class="m--img-rounded m--marginless" alt=""/>
                                                    </div>
                                                    <div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">
																	{{ Auth::guard('dashboard')->user()->name }}
																</span>
                                                        <a class="m-card-user__email m--font-weight-300 m-link">
                                                            {{ Auth::guard('dashboard')->user()->email }}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav m-nav--skin-light">
                                                        <li class="m-nav__section m--hide">
																	<span class="m-nav__section-text">
																		Section
																	</span>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="{{ route('admin.profile') }}" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                <span class="m-nav__link-title">
                                                                        <span class="m-nav__link-wrap">
                                                                            <span class="m-nav__link-text">
                                                                                My Profile
                                                                            </span>
                                                                            <span class="m-nav__link-badge">
                                                                                <span class="m-badge m-badge--success">
                                                                                    2
                                                                                </span>
                                                                            </span>
                                                                        </span>
                                                                    </span>
                                                            </a>
                                                        </li>
                                                        {{--<li class="m-nav__item">--}}
                                                            {{--<a href="header/profile.html" class="m-nav__link">--}}
                                                                {{--<i class="m-nav__link-icon flaticon-share"></i>--}}
                                                                {{--<span class="m-nav__link-text">--}}
																			{{--Activity--}}
																		{{--</span>--}}
                                                            {{--</a>--}}
                                                        {{--</li>--}}
                                                        {{--<li class="m-nav__item">--}}
                                                            {{--<a href="header/profile.html" class="m-nav__link">--}}
                                                                {{--<i class="m-nav__link-icon flaticon-chat-1"></i>--}}
                                                                {{--<span class="m-nav__link-text">--}}
																			{{--Messages--}}
																		{{--</span>--}}
                                                            {{--</a>--}}
                                                        {{--</li>--}}
                                                        {{--<li class="m-nav__separator m-nav__separator--fit"></li>--}}
                                                        {{--<li class="m-nav__item">--}}
                                                            {{--<a href="header/profile.html" class="m-nav__link">--}}
                                                                {{--<i class="m-nav__link-icon flaticon-info"></i>--}}
                                                                {{--<span class="m-nav__link-text">--}}
																			{{--FAQ--}}
																		{{--</span>--}}
                                                            {{--</a>--}}
                                                        {{--</li>--}}
                                                        {{--<li class="m-nav__item">--}}
                                                            {{--<a href="header/profile.html" class="m-nav__link">--}}
                                                                {{--<i class="m-nav__link-icon flaticon-lifebuoy"></i>--}}
                                                                {{--<span class="m-nav__link-text">--}}
																			{{--Support--}}
																		{{--</span>--}}
                                                            {{--</a>--}}
                                                        {{--</li>--}}
                                                        <li class="m-nav__separator m-nav__separator--fit"></li>
                                                        <li class="m-nav__item">
                                                            <a href="{{ url('/dashboard/logout') }}"
                                                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                                               class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
                                                                Logout
                                                            </a>

                                                            <form id="logout-form" action="{{ url('/dashboard/logout') }}" method="POST"
                                                                  style="display: none;">
                                                                {{ csrf_field() }}
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- END: Topbar -->
                </div>
            </div>
        </div>
    </header>
    <!-- END: Header -->
    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <!-- BEGIN: Left Aside -->
        <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
            <!-- BEGIN: Aside Menu -->
            <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
                 data-menu-vertical="true" data-menu-scrollable="false" data-menu-dropdown-timeout="500">
                <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
                    <li class="m-menu__item {{(request()->getPathInfo() == '/dashboard' || request()->getPathInfo() == '/dashboard/') ? 'm-menu__item--active' : ''}}" aria-haspopup="true">
                        <a href="{{ route('admin.dashboard') }}" class="m-menu__link ">
                            <i class="m-menu__link-icon fa fa-dashboard"></i>
                            <span class="m-menu__link-title">
                                <span class="m-menu__link-wrap">
                                    <span class="m-menu__link-text"> Dashboard </span>
                                    <span class="m-menu__link-badge">
                                        <span class="m-badge m-badge--danger">  </span>
                                    </span>
                                </span>
                            </span>
                        </a>
                    </li>

                    <li class="m-menu__section">
                        <h4 class="m-menu__section-text">
                            Manage
                        </h4>
                        <i class="m-menu__section-icon flaticon-more-v3"></i>
                    </li>

                    {!! DashboardMenu::instance()->get() !!}
                </ul>
            </div>
            <!-- END: Aside Menu -->
        </div>
        <!-- END: Left Aside -->

        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                @php
                    $breadcrumb = explode('.', Route::current()->action['as']);
                    $admin = array_shift($breadcrumb); $action = array_pop($breadcrumb);
                    $breadcrumbParent = '';
                @endphp

                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title m-subheader__title--separator">
                            @yield('pageTitle', ucwords($action .' '. ($breadcrumb[0] ?? '')) )
                        </h3>
                        <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                            <li class="m-nav__item m-nav__item--home">
                                <a href="{{ route('admin.dashboard') }}" class="m-nav__link m-nav__link--icon">
                                    <i class="m-nav__link-icon la la-home"></i>
                                </a>
                            </li>

                            @if(count($breadcrumb) > 1)
                                @foreach($breadcrumb as $link)
                                    <li class="m-nav__separator"> - </li>
                                    <li class="m-nav__item">
                                        <a href="{{ route("admin.$breadcrumbParent$link.index") }}" class="m-nav__link">
                                            <span class="m-nav__link-text"> {{ ucfirst($link) }} </span>
                                        </a>
                                    </li>
                                    @php $breadcrumbParent = $link.'.';@endphp
                                @endforeach
                            @elseif(count($breadcrumb))
                                <li class="m-nav__separator"> - </li>
                                <li class="m-nav__item">
                                    <a href="{{ route("admin.{$breadcrumb[0]}.index") }}" class="m-nav__link">
                                        <span class="m-nav__link-text"> {{ ucfirst($breadcrumb[0]) }} </span>
                                    </a>
                                </li>
                            @endif
                            <li class="m-nav__separator"> - </li>
                            <li class="m-nav__item">
                                <a class="m-nav__link">
                                    <span class="m-nav__link-text"> {{ $action }} </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push"
                             data-dropdown-toggle="hover" aria-expanded="true">
                            {{--<a href="#"--}}
                               {{--class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">--}}
                                {{--<i class="la la-plus m--hide"></i>--}}
                                {{--<i class="la la-ellipsis-h"></i>--}}
                            {{--</a>--}}
                            <div class="m-dropdown__wrapper">
                                <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                <div class="m-dropdown__inner">
                                    <div class="m-dropdown__body">
                                        <div class="m-dropdown__content">
                                            <ul class="m-nav">
                                                <li class="m-nav__section m-nav__section--first m--hide">
															<span class="m-nav__section-text">
																Quick Actions
															</span>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-share"></i>
                                                        <span class="m-nav__link-text">
																	Activity
																</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                        <span class="m-nav__link-text">
																	Messages
																</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-info"></i>
                                                        <span class="m-nav__link-text">
																	FAQ
																</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__item">
                                                    <a href="" class="m-nav__link">
                                                        <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                        <span class="m-nav__link-text">
																	Support
																</span>
                                                    </a>
                                                </li>
                                                <li class="m-nav__separator m-nav__separator--fit"></li>
                                                <li class="m-nav__item">
                                                    <a href="#"
                                                       class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
                                                        Submit
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                        <strong>
                            Well done!
                        </strong>
                        {{ session('success') }}
                    </div>

                @endif

                    @if (session('warning'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                            <strong>
                                Warning!
                            </strong>
                           {{ session('warning') }}
                        </div>

                    @endif

                @yield('content')
            </div>
        </div>
    </div>
    <!-- begin::Footer -->
    <footer class="m-grid__item		m-footer ">
        <div class="m-container m-container--fluid m-container--full-height m-page__container">
            <div class="m-stack m-stack--flex-tablet-and-mobile m-stack--ver m-stack--desktop">
                <div class="m-stack__item m-stack__item--left m-stack__item--middle m-stack__item--last">
				<span class="m-footer__copyright">
					{{date('Y')}} &copy; Blue Crunch
					<a href="#" class="m-link">

					</a>
				</span>
                </div>
                <div class="m-stack__item m-stack__item--right m-stack__item--middle m-stack__item--first">
                    <ul class="m-footer__nav m-nav m-nav--inline m--pull-right">
                        <li class="m-nav__item">
                            <a href="#" class="m-nav__link">
							<span class="m-nav__link-text">
								About
							</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="#" class="m-nav__link">
							<span class="m-nav__link-text">
								Privacy
							</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="#" class="m-nav__link">
							<span class="m-nav__link-text">
								T&C
							</span>
                            </a>
                        </li>
                        <li class="m-nav__item">
                            <a href="#" class="m-nav__link">
							<span class="m-nav__link-text">
								Purchase
							</span>
                            </a>
                        </li>
                        <li class="m-nav__item m-nav__item">
                            <a href="#" class="m-nav__link" data-toggle="m-tooltip" title="Support Center"
                               data-placement="left">
                                <i class="m-nav__link-icon flaticon-info m--icon-font-size-lg3"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- end::Footer -->
</div>
<!--begin::Base Scripts -->

<script src="/metronic/assets/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="/metronic/assets/demo/default/base/scripts.bundle.js" type="text/javascript"></script>

@stack('scripts')
@yield('scripts')
</body>
</html>