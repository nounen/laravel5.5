<aside class="main-sidebar">
    <section class="sidebar">
        {{-- 菜单搜索 --}}
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

        {{-- 菜单 --}}
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>

            {{-- 菜单一级 --}}
            @foreach($menus AS $menu)
            <li class="active treeview">
                <a href="#">
                    <i class="{{ $menu['class'] }}"></i>
                    <span>{{ $menu['name'] }}</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                {{-- 菜单二级 --}}
                <ul class="treeview-menu">
                    @foreach($menu['children'] AS $children)
                    <li class="{{ getActiveClass($children['uri']) }}">
                        <a href="{{ url($children['uri']) }}">
                            <i class="{{ $children['class'] }}"></i> {{ $children['name'] }}
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
