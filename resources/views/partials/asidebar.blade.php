<aside id="rightsidebar" class="right-sidebar">
 <div class="d-flex">
                <button class="btn btn-sm bg-gradient-dark px-3 mb-2 active" data-class="bg-gradient-dark" onclick="sidebarType(this)">Dark</button>
                <button class="btn btn-sm bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
                <button class="btn btn-sm bg-gradient-dark px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
</div> 
<ul class="mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right demo-list-icon mdl-list">
    <li lass="mdl-menu__item mdl-list__item">
        <a href="/" title="{{ trans('titles.home') }}">
            <span class="mdl-list__item-primary-content">
                <i class="material-icons mdl-list__item-icon">home</i>
                {{ trans('titles.home') }}
            </span>
        </a>
    </li>
    <li lass="mdl-menu__item mdl-list__item">
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="{!! trans('titles.logout') !!}">
            <span class="mdl-list__item-primary-content">
                <i class="material-icons mdl-list__item-icon">power_settings_new</i>
                {{ trans('titles.logout') }}
            </span>
        </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	        {{ csrf_field() }}
	    </form>
    </li>
</ul>
</aside>