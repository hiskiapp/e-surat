<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{ route('home') }}" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('submissions.index') }}" class="waves-effect">
                        <i class="ti-email"></i>
                        <span>Riwayat Pengajuan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('account') }}" class="waves-effect">
                        <i class="mdi mdi-clipboard-list-outline"></i>
                        <span>Data Diri</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:void(0);"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="waves-effect">
                        <i class="mdi mdi-logout"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->