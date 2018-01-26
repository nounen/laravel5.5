<aside class="main-sidebar">
    <section class="sidebar">
        <form method="get" class="sidebar-form" id="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="菜单搜索" id="search-input">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            @foreach($menus AS $menu)
            <li class="{{--active--}} treeview">
                <a href="#">
                    <i class="fa {{ $menu['icon'] }}"></i>
                    <span>{{ $menu['name'] }}</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    @foreach($menu['childrens'] AS $children)
                    <li class="{{--active--}}">
                        <a href="{{ $children['url'] }}">
                            <i class="fa {{ $children['icon'] }}"></i> {{ $children['name'] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>
            @endforeach
            <li>
                <a href="https://adminlte.io/docs">
                    <i class="fa fa-book"></i>
                    <span>Documentation</span>
                </a>
            </li>
        </ul>

    </section>
    <!-- /.sidebar -->
</aside>
