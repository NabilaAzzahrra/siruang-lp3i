<body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="https://yt3.googleusercontent.com/YTbtWHaUmX2ZZIqimCKCUdth28WvOR7_7HRAautax_jvG89xIDsW4LPWViFMZhsPWM55bNaoFLI=s900-c-k-c0x00ffffff-no-rj" alt="AdminLTELogo" height="120px" width="120px">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white ini navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

                <!-- Notifications Dropdown Menu -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item ">
                    <a id="logout" class="dropdown-item nav-link logout" href="#">
                        <span class="logout">
                            <!-- <i class="ti-power-off text-primary" aria-hidden="true"></i> -->
                           <i class="fas fa-sign-out-alt"></i> Keluar
                        </span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
        <div id="ModalLogout" class="modal fade" id="modal-default" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Logout</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda yakin untuk logout? Anda akan dialihkan ke halaman login jika sudah yakin.</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <a class="btn btn-block bg-gradient-success" href="<?= base_url('Auth/logout') ?>">OK</a>
                        <button type="button" class="btn btn-block bg-gradient-danger" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>