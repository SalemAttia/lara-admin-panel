@if(!getCurrentAdmin()->isRole('manager'))

<li class="m-menu__item  m-menu__item--submenu {{ (request()->is('dashboard/admins*') || request()->is('dashboard/permissions*') || request()->is('dashboard/Page*') || request()->is('dashboard/SplashScreen*') || request()->is('dashboard/roles*') || request()->is('dashboard/Log*') ) ? 'm-menu__item--open  m-menu__item--expanded' : ''}}" aria-haspopup="true"
    data-menu-submenu-toggle="hover">
    <a href="#" class="m-menu__link m-menu__toggle">
        <i class="m-menu__link-icon fa fa-cog"></i>
        <span class="m-menu__link-text">App Management</span>
        <i class="m-menu__ver-arrow la la-angle-right"></i>
    </a>
    <div class="m-menu__submenu">
        <span class="m-menu__arrow"></span>
        <ul class="m-menu__subnav">
            <li class="m-menu__item  m-menu__item--parent" aria-haspopup="true">
                <a href="#" class="m-menu__link ">
					<span class="m-menu__link-text">App Management</span>
                </a>
            </li>
            <li class="m-menu__item {{ (request()->is('dashboard/admins*')) ? 'm-menu__item--active' : ''}}" aria-haspopup="true">
                <a href="{{ route('admin.admins.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                    <span class="m-menu__link-text">Admins/Manager</span>
                </a>
            </li>

            <li class="m-menu__item {{ (request()->is('dashboard/Log*')) ? 'm-menu__item--active' : ''}}" aria-haspopup="true">
                <a href="{{ route('admin.Log.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                    <span class="m-menu__link-text">Admins/Logs</span>
                </a>
            </li>


            <li class="m-menu__item {{ (request()->is('dashboard/roles*')) ? 'm-menu__item--active' : ''}}" aria-haspopup="true">
                <a href="{{ route('admin.roles.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                    <span class="m-menu__link-text">Roles</span>
                </a>
            </li>

            <li class="m-menu__item {{ (request()->is('dashboard/permissions*')) ? 'm-menu__item--active' : ''}}" aria-haspopup="true">
                <a href="{{ route('admin.permissions.index') }}" class="m-menu__link ">
                    <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i>
                    <span class="m-menu__link-text">Permissions</span>
                </a>
            </li>





        </ul>
    </div>
</li>
@endif





