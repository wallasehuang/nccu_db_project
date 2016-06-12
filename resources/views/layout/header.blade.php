<ul class="header-inner">
    <li id="menu-trigger" data-trigger="#sidebar">
        <div class="line-wrap">
            <div class="line top"></div>
            <div class="line center"></div>
            <div class="line bottom"></div>
        </div>
    </li>

    <li class="logo hidden-xs">
        <a href="{{Url::to('Home/Index')}}">@yield('title')</a>
    </li>

    <li class="pull-right">
        <ul class="top-menu">
            <li id="toggle-width">
                <div class="toggle-switch">
                    <input id="tw-switch" type="checkbox" hidden="hidden">
                    <label for="tw-switch" class="ts-helper"></label>
                </div>
            </li>
            <li><a class="btn btn-primary" href="{{Url::to("/logout")}}">登出</a></li>
        </ul>
    </li>
</ul>


<!-- Top Search Content -->
<div id="top-search-wrap">
    <div class="tsw-inner">
        <i id="top-search-close" class="zmdi zmdi-arrow-left"></i>
        <input type="text">
    </div>
</div>
