<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li>
                    <a href="{{ route('admin.home') }}" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ti-email"></i>
                        <span>Pengajuan Surat</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.submissions.pending') }}">
                                <span
                                    class="badge badge-pill badge-primary float-right">{{ pendingSubmissions() }}</span>
                                Menunggu Persetujuan </a></li>
                        <li><a href="{{ route('admin.submissions.approved') }}">Disetujui</a></li>
                        <li><a href="{{ route('admin.submissions.rejected') }}">Ditolak</a></li>
                    </ul>
                </li>

                <li class="menu-title">Master Data</li>
                <li>
                    <a href="{{ route('admin.data.index') }}" class=" waves-effect">
                        <i class="ti-user"></i>
                        <span>Administrator</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.index') }}" class=" waves-effect">
                        <i class="ti-agenda"></i>
                        <span>Warga</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.letters.index') }}" class=" waves-effect">
                        <i class="ti-receipt"></i>
                        <span>Daftar Surat</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.signatories.index') }}" class=" waves-effect">
                        <i class="ti-receipt"></i>
                        <span>Penandatangan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.helpers') }}" class=" waves-effect">
                        <i class="ti-hand-point-right"></i>
                        <span>Helpers</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->