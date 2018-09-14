
<li class="m-menu__item {{ (request()->is('dashboard/Team*')) ? 'm-menu__item--active' : ''}}" aria-haspopup="true">
<a href="{{ route('admin.Team.index') }}" class="m-menu__link ">
<i class="m-menu__link-icon fa fa-cogs"></i>
<span class="m-menu__link-title">
<span class="m-menu__link-wrap">
<span class="m-menu__link-text"> Team </span>

</span>
</span>
</a>
</li>
