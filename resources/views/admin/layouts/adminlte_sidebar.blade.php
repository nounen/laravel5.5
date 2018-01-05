<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="https://adminlte.io/themes/AdminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form method="get" class="sidebar-form" id="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..." id="search-input">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                        <i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
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
