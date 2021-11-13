<aside class="main-sidebar sidebar-dark-info bg-navy elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link" style="text-align: center;">
        @if(empty($companyinfo->image))
        <img src="{{asset($companyinfo->logo)}}" width="150px" alt="Company Image">
        @endif
    </a>
    <?php
    $admin_status = Auth::user()->status;
    $admin_id = Auth::user()->id;
    $type = Auth::user()->type;
    $navs = DB::table('navigation')->where('active', '1')->where('parent_id', '0')->orderBy('orderBy', 'DESC')->get();
    ?>
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <a href="/home">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">

                    <img src="{{asset('admin_assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">

                </div>
                <div class="info">
                    <a href="/home" class="d-block">{{Auth::user()->name}}</a>
                </div>
            </div>

        </a>
        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <a href="{{route('home')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <?php
                foreach ($navs as $each_menu) :
                    $sub_menu = DB::table('admin_role')->where('parent_id', $each_menu->navigation_id)->where('admin_id', $admin_id)->get();
                    $menufind = DB::table('navigation')->where('url', '/' . Request::segment(1))->pluck('parent_id')->first();
                ?>
                    <li class="nav-item {{ $each_menu->navigation_id === $menufind ? 'menu-open':'' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                <?php echo $each_menu->label; ?>
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <?php if (!empty($sub_menu)) : ?>
                            <ul class="nav nav-treeview ">
                                <?php
                                foreach ($sub_menu as $each_submenu) :
                                    if (!empty($each_submenu)) :
                                        $single_submenu = DB::table('navigation')->where('navigation_id', $each_submenu->navigation_id)->get();

                                        $url = $single_submenu[0]->url;
                                        $label = $single_submenu[0]->label;
                                ?>

                                        <li class="nav-item">
                                            <a href="{{ $url }}" class="nav-link {{   '/'.Request::segment(1) === $url ? 'active':'' }}">
                                                <i class="far fa-circle nav-icon"></i>
                                                <p><?php echo $label; ?></p>
                                            </a>
                                        </li>
                                <?php
                                    endif;
                                endforeach;
                                ?>
                            </ul>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>


            </ul>
        </nav>

    </div>
    <!-- /.sidebar -->
</aside>