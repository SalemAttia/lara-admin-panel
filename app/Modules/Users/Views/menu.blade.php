
<li class="m-menu__item {{ (request()->is('dashboard/User*')) ? 'm-menu__item--active' : ''}}" aria-haspopup="true">
<a href="{{ route('admin.User.index') }}" class="m-menu__link ">
<i class="m-menu__link-icon fa fa-users"></i>
<span class="m-menu__link-title">
<span class="m-menu__link-wrap">
<span class="m-menu__link-text"> Users </span>

</span>
</span>
</a>
</li>
