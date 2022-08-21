<button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
    <i class="ion-close"></i>
</button>

<!-- LOGO -->
<div class="topbar-left">
    <div class="text-center">
        <a href="<?php base_url('/'); ?>" class="logo"><i class="mdi mdi-assistant"></i> SIKENMA</a>
        <!-- <a href="index.html" class="logo"><img src="assets/images/logo.png" height="24" alt="logo"></a> -->
    </div>
</div>

<!-- Start sidebarinner -->
<div class="sidebar-inner slimscrollleft">

    <div id="sidebar-menu">
        <ul>
            <li>
                <a href="/" class="waves-effect">
                    <i class="mdi mdi-airplay"></i>
                    <span> Dashboard </span>
                </a>
            </li>

            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="mdi mdi-table-edit"></i>
                    <span> Manajemen </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span>
                </a>
                <ul class="list-unstyled">
                    <li><a href="/mitra-list">Mitra</a></li>
                    <li><a href="/survey-list">Kegiatan</a></li>
                    <li><a href="/users-list">Pegawai</a></li>
                </ul>
            </li>

            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="mdi mdi-database"></i>
                    <span> Mitra </span> <span class="float-right"><i class="mdi mdi-chevron-right"></i></span>
                </a>
                <ul class="list-unstyled">
                    <li><a href="/track-record-summary">Summary</a></li>
                    <li><a href="/track-record-entry">Input Track Record</a></li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="clearfix"></div>
</div>
<!-- End sidebarinner -->