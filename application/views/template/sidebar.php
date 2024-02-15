        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-primary  elevation-4">
            <!-- Brand Logo -->

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="https://yt3.googleusercontent.com/YTbtWHaUmX2ZZIqimCKCUdth28WvOR7_7HRAautax_jvG89xIDsW4LPWViFMZhsPWM55bNaoFLI=s900-c-k-c0x00ffffff-no-rj" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="<?php
                                    if ($this->session->userdata('akses') == "admin") {
                                        echo  base_url('Admin/profile');
                                    } else {
                                        echo base_url('User/profile');
                                    }
                                    ?>" class="d-block"><?= $this->session->userdata('nama') ?></a>
                    </div>
                </div>

                <!-- SidebarSearch Form -->
                <!-- <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div> -->

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <?php
                        $disab = "";
                        $enab = "";
                        if ($this->session->userdata('akses') == "admin") {
                            $disab = "enabled";
                        } else {
                            $disab = "hidden";
                        }

                        if ($this->session->userdata('akses') == "user") {
                            $enab = "enabled";
                        } else {
                            $enab = "hidden";
                        }
                        ?>
                        <li class="nav-item menu-<?= $this->session->userdata('dashboard') ?>" <?= $disab ?>>
                            <a href="<?= base_url('Admin/index') ?>" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item menu-<?= $this->session->userdata('dashboard') ?>" <?= $enab ?>>
                            <a href="<?= base_url('User/index') ?>" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <!--<li class="nav-item menu-<?= $this->session->userdata('k_pemesanan') ?>" <?= $disab ?>>-->
                        <!--    <a href="<?= base_url('Admin/k_pemesanan') ?>" class="nav-link">-->
                        <!--        <i class="nav-icon fas fa-folder"></i>-->
                        <!--        <p>-->
                        <!--            Keterangan Pemesanan-->
                        <!--        </p>-->
                        <!--    </a>-->
                        <!--</li>-->
                        
                        <li class="nav-item menu-<?= $this->session->userdata('data') ?>" <?= $disab ?>>
                            <a href="#" class="nav-link<?= $this->session->userdata('data_status') ?>">
                                <i class="nav-icon fas fa-folder"></i>
                                <p>
                                    Data
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('Admin/konfigurasi') ?>" class="nav-link <?= $this->session->userdata('konfigurasi'); ?>">
                                        <i class="far fa-<?= $this->session->userdata('konfigurasi_dot'); ?>circle nav-icon"></i>
                                        <p>Konfigurasi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Admin/tahun_akademik') ?>" class="nav-link <?= $this->session->userdata('tahun_akademik'); ?>">
                                        <i class="far fa-<?= $this->session->userdata('tahun_akademik_dot'); ?>circle nav-icon"></i>
                                        <p>Tahun Akademik</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Admin/jenis_kegiatan') ?>" class="nav-link <?= $this->session->userdata('jenis_kegiatan'); ?>">
                                        <i class="far fa-<?= $this->session->userdata('jenis_kegiatan_dot'); ?>circle nav-icon"></i>
                                        <p>Jenis Kegiatan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Admin/ruang') ?>" class="nav-link <?= $this->session->userdata('ruang'); ?>">
                                        <i class="far fa-<?= $this->session->userdata('ruang_dot'); ?>circle nav-icon"></i>
                                        <p>Ruang</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Admin/kelas') ?>" class="nav-link <?= $this->session->userdata('kelas'); ?>">
                                        <i class="far fa-<?= $this->session->userdata('kelas_dot'); ?>circle nav-icon"></i>
                                        <p>Kelas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Admin/dosen') ?>" class="nav-link <?= $this->session->userdata('dosen'); ?>">
                                        <i class="far fa-<?= $this->session->userdata('dosen_dot'); ?>circle nav-icon"></i>
                                        <p>Dosen</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Admin/mata_kuliah') ?>" class="nav-link <?= $this->session->userdata('mata_kuliah'); ?>">
                                        <i class="far fa-<?= $this->session->userdata('mata_kuliah_dot'); ?>circle nav-icon"></i>
                                        <p>Mata Kuliah</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Admin/jadwal') ?>" class="nav-link <?= $this->session->userdata('jadwal'); ?>">
                                        <i class="far fa-<?= $this->session->userdata('jadwal_dot'); ?>circle nav-icon"></i>
                                        <p>Jadwal</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url('Admin/user') ?>" class="nav-link <?= $this->session->userdata('user'); ?>">
                                        <i class="far fa-<?= $this->session->userdata('user_dot'); ?>circle nav-icon"></i>
                                        <p>User</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item menu-<?= $this->session->userdata('pemesanan') ?>" <?= $disab ?>>
                            <a href="#" class="nav-link<?= $this->session->userdata('pemesanan_status') ?>">
                                <i class="nav-icon fas fa-folder"></i>
                                <p>
                                    Verifikasi Pemesanan
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url('Admin/v_pemesanan') ?>" class="nav-link <?= $this->session->userdata('v_pemesanan'); ?>">
                                        <i class="far fa-<?= $this->session->userdata('v_pemesanan_dot'); ?>circle nav-icon"></i>
                                        <p>Pemesanan</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--<li class="nav-item menu-<?= $this->session->userdata('k_pemesanan') ?>" <?= $enab ?>>-->
                        <!--    <a href="<?= base_url('User/k_pemesanan') ?>" class="nav-link">-->
                        <!--        <i class="nav-icon fas fa-folder"></i>-->
                        <!--        <p>-->
                        <!--            Keterangan Pemesanan-->
                        <!--        </p>-->
                        <!--    </a>-->
                        <!--</li>-->
                        <li class="nav-item menu-<?= $this->session->userdata('pemesanan') ?>" <?= $enab ?>>
                            <a href="<?= base_url('User/v_pemesanan') ?>" class="nav-link">
                                <i class="nav-icon fas fa-folder"></i>
                                <p>
                                    Pemesanan
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ?>" <?= $disab ?>>
                            <a href="<?=base_url('user_guide/user_guide_admin.pdf')?>" target="_blank" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    User Guide
                                </p>
                            </a>
                        </li>
                        <li class="nav-item ?>" <?= $enab ?>>
                            <a href="<?=base_url('user_guide/user_guide_user.pdf')?>" target="_blank" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    User Guide
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0"><?= $title ?></h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active"><?= $title ?></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->