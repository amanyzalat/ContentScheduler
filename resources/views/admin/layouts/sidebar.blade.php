<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="/admin/index" class="waves-effect">
                        <i class="ti-home"></i><span class="badge rounded-pill bg-primary float-end">1</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="has-arrow waves-effect">
                        <i class="ti-package"></i>
                        <span>Tasks</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('tasks.create')}}">Add</a></li>
                        <li><a href="{{route('tasks.index')}}">List</a></li>
                        <li><a href="{{route('tasks.statistics')}}">Statistics</a></li>
                    </ul>
                </li>
               
                

          

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->