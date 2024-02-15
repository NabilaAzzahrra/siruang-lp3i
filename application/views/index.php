            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <?php
                    $a = date('l');
                    $day = "";
                    if ($a == 'Monday') {
                        $day = 'Senin';
                    } elseif ($a == 'Tuesday') {
                        $day = 'Selasa';
                    } elseif ($a == 'Wednesday') {
                        $day = 'Rabu';
                    } elseif ($a == 'Thursday') {
                        $day = 'Kamis';
                    } elseif ($a == 'Friday') {
                        $day = 'Jumat';
                    } elseif ($a == 'Saturday') {
                        $day = 'Sabtu';
                    } elseif ($a == 'Sunday') {
                        $day = 'Minggu';
                    }

                    ?>
                    <div class="alert alert-success" role="alert" <?php
                                                                    if ($a != "Friday") {
                                                                        echo "hidden";
                                                                    }
                                                                    ?>>
                        <h4 class="alert-heading">Informasi!</h4>
                        <p>Untuk hari ini maka jam masuk ada perubahan</p>
                        <hr>
                        <p class="mb-0">Sesi 3 = 13.30 - 15.10 WIB</p>
                        <p class="mb-0">Sesi 4 = 15.30 - 17.10 WIB</p>
                        <p class="mb-0">Sesi 5 = 18.30 - 20.10 WIB</p>
                        <!-- <p class="mb-0">Sesi 6 = 18.30 - </p> -->
                    </div>

                    <div class="row">
                        <!-- <p class="mb-4" style="font-size: 20px;"><strong class="badge badge-success"><?= $day ?>, <?= date('d F Y') ?> </strong></p> -->
                        <!-- <div class="form-group col-md-10">
                            <a href="<?= base_url('Admin/tgl_lain') ?>" type="reset" class="btn btn-info btn-sm">Lihat Tanggal Lain</a>
                        </div> -->
                        <!-- <div class="form-group col-md-2">
                            <input name="dari" name="tgl" type="date" class="form-control" value="<?= $tgl ?>">
                        </div> -->
                    </div>

                    <!-- <form name="form" action="<?= base_url('Admin/cari') ?>" method="GET" enctype="multipart/form-data" accept-charset="UTF-8">
                        <div class="row">

                            <?php
                            // if (isset($_GET['form'])) {
                            //     $_SESSION['eName'] = $_GET['bulan'];
                            // }
                            ?>

                            <p class="mb-4" style="font-size: 20px;"><strong class="badge badge-success"><?= $day ?>, <?= date('d F Y') ?> </strong></p>
                            <div class="form-group col-md-2">
                                <input type="date" name="tgl" class="form-control" placeholder="Tanggal" value="<?= $tgl ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <button type="submit" class="btn btn-primary" style="color: #fff;"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form> -->
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4 mt-2 mb-2">
                                     <button type="button" class="btn btn-success btn-sm mr-4" style="height: 50px; width: 50px;"></button> <b>Ruang Kosong</b>
                                </div>
                                <div class="col-md-4 mt-2 mb-2">
                                     <button type="button" class="btn btn-warning btn-sm mr-4" style="height: 50px; width: 50px;"></button> <b>Ruang Dipesan</b>
                                </div>
                                <div class="col-md-4 mt-2 mb-2">
                                     <button type="button" class="btn btn-danger btn-sm mr-4" style="height: 50px; width: 50px;"></button> <b>Ruang Jadwal Kuliah</b>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <form action="<?= base_url('Admin/cari') ?>" method="GET">
                                <div class="row">
                                    <?php
                                    // if (isset($_GET['form'])) {
                                    //     $_SESSION['eName'] = $_GET['bulan'];
                                    // }
                                    ?>
                                    <p class="mb-4 ml-3" style="font-size: 18px;"><strong class="badge badge-success"><?= $day ?>, <?= date('d F Y') ?> </strong></p>
                                    <div class="form-group col-md-2">
                                        <input type="date" name="tgl" class="form-control" placeholder="Tanggal" value="<?= $tgl ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button type="submit" class="btn btn-primary" style="color: #fff;"><i class="fas fa-search"></i> Tampilkan</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-body">
                            <?php echo $this->session->flashdata('pesan'); ?>
                            <table id="example3" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sesi 1<br>08.00 - 09.40 WIB</th>
                                        <th class="text-center">Sesi 2<br>09.50 - 11.30 WIB</th>
                                        <th class="text-center">Sesi 3<br>12.30 - 14.10 WIB</th>
                                        <th class="text-center">Sesi 4<br>14.20 - 16.00 WIB</th>
                                        <th class="text-center">Sesi 5<br>16.10 - 17.50 WIB</th>
                                        <th class="text-center">Sesi 6<br>18.30 - 20.10 WIB</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($read as $r) {
                                        $id_ruang = $r->id_ruang;
                                        // print_r($jadwal);
                                        foreach ($jadwal as $s) {
                                            $id_dosen = $s->nama_dosen;
                                            $id_matkul = $s->mata_kuliah;
                                            $id_kelas = $s->kelas;
                                            $gab = "
Dosen : $id_dosen
Mata Kuliah : $id_matkul
Kelas : $id_kelas";

                                            $this->db->select('*');
                                            $this->db->from('jadwal');
                                            $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=jadwal.id_tahun_akademik');
                                            $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
                                            $this->db->where('id_ruang =', $id_ruang);
                                            $this->db->where('hari =', date('l'));
                                            // $this->db->where('hari =', date('l', strtotime($_GET['tgl'])));
                                            $this->db->where('dari =', "08:00:00");
                                            $this->db->where('status =', "normal");
                                            $cek = $this->db->get();
                                            if ($cek->num_rows() > 0) {
                                                $bg1 = "danger";
                                                $disab1 = "disabled";
                                                $title1 = $gab;
                                            } else {
                                                $this->db->select('*');
                                                $this->db->from('b_ruang');
                                                $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
                                                $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
                                                $this->db->where('id_ruang =', $id_ruang);
                                                $this->db->where('hari =', date('l'));
                                                $this->db->where('tgl_pakai =', date('Y-m-d'));
                                                $this->db->where('dari_pukul =', "08:00:00");
                                                $this->db->where('s_verifikasi !=', 'ditolak');
                                                $cek = $this->db->get();
                                                if ($cek->num_rows() > 0) {
                                                    foreach ($b_ruang as $br) {
                                                        $dosenn = $br->nama_dosen;
                                                        $matkull = $br->mata_kuliah;
                                                        $kelass = $br->kelas;
                                                        $statuss = $br->status;

                                                        $satu = "Dosen : $dosenn";
                                                        $dua = "Mata Kuliah : $matkull";
                                                        $tiga = "Kelas : $kelass";
                                                        $empat = "Status : $statuss";
                                                        $b = "
$satu 
$dua  
$tiga 
$empat";
                                                        if ($br->s_verifikasi == "belum verifikasi") {
                                                            $bg1 = "warning";
                                                            $disab1 = "disabled";
                                                            $title1 = $b;
                                                        } else if ($br->s_verifikasi == "sudah verifikasi") {
                                                            $bg1 = "warning";
                                                            $disab1 = "disabled";
                                                            $title1 = $b;
                                                        } 
                                                    }
                                                } else {
                                                    $bg1 = "success";
                                                    $disab1 = "enabled";
                                                    $title1 = "Kosong";
                                                }
                                            }
                                        }

                                        foreach ($jadwal as $s) {
                                            $id_dosen = $s->nama_dosen;
                                            $id_matkul = $s->mata_kuliah;
                                            $id_kelas = $s->kelas;
                                            $gab = "
Dosen : $id_dosen
Mata Kuliah : $id_matkul
Kelas : $id_kelas";

                                            $this->db->select('*');
                                            $this->db->from('jadwal');
                                            $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=jadwal.id_tahun_akademik');
                                            $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
                                            $this->db->where('id_ruang =', $id_ruang);
                                            $this->db->where('hari =', date('l'));
                                            $this->db->where('dari =', "09:50:00");
                                            $this->db->where('status =', "normal");
                                            $cek = $this->db->get();
                                            if ($cek->num_rows() > 0) {
                                                $bg2 = "danger";
                                                $disab2 = "disabled";
                                                $title2 = $gab;
                                            } else {
                                                $this->db->select('*');
                                                $this->db->from('b_ruang');
                                                $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
                                                $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
                                                $this->db->where('id_ruang =', $id_ruang);
                                                $this->db->where('hari =', date('l'));
                                                $this->db->where('tgl_pakai =', date('Y-m-d'));
                                                $this->db->where('dari_pukul =', "09:50:00");
                                                $this->db->where('s_verifikasi !=', 'ditolak');
                                                $cek = $this->db->get();
                                                if ($cek->num_rows() > 0) {
                                                    foreach ($b_ruang as $br) {
                                                        $dosenn = $br->nama_dosen;
                                                        $matkull = $br->mata_kuliah;
                                                        $kelass = $br->kelas;
                                                        $statuss = $br->status;

                                                        $satu = "Dosen : $dosenn";
                                                        $dua = "Mata Kuliah : $matkull";
                                                        $tiga = "Kelas : $kelass";
                                                        $empat = "Status : $statuss";
                                                        $b = "
$satu 
$dua  
$tiga 
$empat";
                                                        if ($br->s_verifikasi == "belum verifikasi") {
                                                            $bg2 = "warning";
                                                            $disab2 = "disabled";
                                                            $title2 = $b;
                                                        } else if ($br->s_verifikasi == "sudah verifikasi") {
                                                            $bg2 = "warning";
                                                            $disab2 = "disabled";
                                                            $title2 = $b;
                                                        }
                                                    }
                                                } else {
                                                    $bg2 = "success";
                                                    $disab2 = "enabled";
                                                    $title2 = "Kosong";
                                                }
                                            }
                                        }

                                        foreach ($jadwal as $s) {
                                            $id_dosen = $s->nama_dosen;
                                            $id_matkul = $s->mata_kuliah;
                                            $id_kelas = $s->kelas;
                                            $gab = "
Dosen : $id_dosen
Mata Kuliah : $id_matkul
Kelas : $id_kelas";

                                            $this->db->select('*');
                                            $this->db->from('jadwal');
                                            $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=jadwal.id_tahun_akademik');
                                            $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
                                            $this->db->where('id_ruang =', $id_ruang);
                                            $this->db->where('hari =', date('l'));
                                            $this->db->where('dari =', "12:30:00");
                                            $this->db->where('status =', "normal");
                                            $cek = $this->db->get();
                                            if ($cek->num_rows() > 0) {
                                                $bg3 = "danger";
                                                $disab3 = "disabled";
                                                $title3 = $gab;
                                            } else {
                                                $this->db->select('*');
                                                $this->db->from('b_ruang');
                                                $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
                                                $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
                                                $this->db->where('id_ruang =', $id_ruang);
                                                $this->db->where('hari =', date('l'));
                                                $this->db->where('tgl_pakai =', date('Y-m-d'));
                                                $this->db->where('dari_pukul =', "12:30:00");
                                                $this->db->where('s_verifikasi !=', 'ditolak');
                                                $cek = $this->db->get();
                                                if ($cek->num_rows() > 0) {
                                                    foreach ($b_ruang as $br) {
                                                        $dosenn = $br->nama_dosen;
                                                        $matkull = $br->mata_kuliah;
                                                        $kelass = $br->kelas;
                                                        $statuss = $br->status;

                                                        $satu = "Dosen : $dosenn";
                                                        $dua = "Mata Kuliah : $matkull";
                                                        $tiga = "Kelas : $kelass";
                                                        $empat = "Status : $statuss";
                                                        $b = "
$satu 
$dua  
$tiga 
$empat";
                                                        if ($br->s_verifikasi == "belum verifikasi") {
                                                            $bg3 = "warning";
                                                            $disab3 = "disabled";
                                                            $title3 = $b;
                                                        } else if ($br->s_verifikasi == "sudah verifikasi") {
                                                            $bg3 = "warning";
                                                            $disab3 = "disabled";
                                                            $title3 = $b;
                                                        }
                                                    }
                                                } else {
                                                    $bg3 = "success";
                                                    $disab3 = "enabled";
                                                    $title3 = "Kosong";
                                                }
                                            }
                                        }

                                        foreach ($jadwal as $s) {
                                            $id_dosen = $s->nama_dosen;
                                            $id_matkul = $s->mata_kuliah;
                                            $id_kelas = $s->kelas;
                                            $gab = "
Dosen : $id_dosen
Mata Kuliah : $id_matkul
Kelas : $id_kelas";

                                            $this->db->select('*');
                                            $this->db->from('jadwal');
                                            $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=jadwal.id_tahun_akademik');
                                            $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
                                            $this->db->where('id_ruang =', $id_ruang);
                                            $this->db->where('hari =', date('l'));
                                            $this->db->where('dari =', "14:20:00");
                                            $this->db->where('status =', "normal");
                                            $cek = $this->db->get();
                                            if ($cek->num_rows() > 0) {
                                                $bg4 = "danger";
                                                $disab4 = "disabled";
                                                $title4 = $gab;
                                            } else {
                                                $this->db->select('*');
                                                $this->db->from('b_ruang');
                                                $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
                                                $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
                                                $this->db->where('id_ruang =', $id_ruang);
                                                $this->db->where('hari =', date('l'));
                                                $this->db->where('tgl_pakai =', date('Y-m-d'));
                                                $this->db->where('dari_pukul =', "14:20:00");
                                                $this->db->where('s_verifikasi !=', 'ditolak');
                                                // $this->db->where('s_verifikasi =', "sudah verifikasi");
                                                $cek = $this->db->get();
                                                if ($cek->num_rows() > 0) {
                                                    foreach ($b_ruang as $br) {
                                                        $dosenn = $br->nama_dosen;
                                                        $matkull = $br->mata_kuliah;
                                                        $kelass = $br->kelas;
                                                        $statuss = $br->status;

                                                        $satu = "Dosen : $dosenn";
                                                        $dua = "Mata Kuliah : $matkull";
                                                        $tiga = "Kelas : $kelass";
                                                        $empat = "Status : $statuss";
                                                        $b = "
$satu 
$dua  
$tiga 
$empat";
                                                        if ($br->s_verifikasi == "belum verifikasi") {
                                                            $bg4 = "warning";
                                                            $disab4 = "disabled";
                                                            $title4 = $b;
                                                        } else if ($br->s_verifikasi == "sudah verifikasi") {
                                                            $bg4 = "warning";
                                                            $disab4 = "disabled";
                                                            $title4 = $b;
                                                        }
                                                    }
                                                } else {
                                                    $bg4 = "success";
                                                    $disab4 = "enabled";
                                                    $title4 = "Kosong";
                                                }
                                            }
                                        }

                                        foreach ($jadwal as $s) {
                                            $id_dosen = $s->nama_dosen;
                                            $id_matkul = $s->mata_kuliah;
                                            $id_kelas = $s->kelas;
                                            $gab = "
Dosen : $id_dosen
Mata Kuliah : $id_matkul
Kelas : $id_kelas";

                                            $this->db->select('*');
                                            $this->db->from('jadwal');
                                            $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=jadwal.id_tahun_akademik');
                                            $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
                                            $this->db->where('id_ruang =', $id_ruang);
                                            // $this->db->where('hari =', date('l', strtotime($_GET['tgl'])));
                                            $this->db->where('hari =', date('l'));
                                            $this->db->where('dari =', "16:10:00");
                                            $this->db->where('status =', "normal");
                                            $cek = $this->db->get();
                                            if ($cek->num_rows() > 0) {
                                                $bg5 = "danger";
                                                $disab5 = "disabled";
                                                $title5 = $gab;
                                            } else {
                                                $this->db->select('*');
                                                $this->db->from('b_ruang');
                                                $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
                                                $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
                                                $this->db->where('id_ruang =', $id_ruang);
                                                $this->db->where('hari =', date('l'));
                                                $this->db->where('tgl_pakai =', date('Y-m-d'));
                                                $this->db->where('dari_pukul =', "16:10:00");
                                                $this->db->where('s_verifikasi !=', 'ditolak');
                                                $cek = $this->db->get();
                                                if ($cek->num_rows() > 0) {
                                                    foreach ($b_ruang as $br) {
                                                        $dosenn = $br->nama_dosen;
                                                        $matkull = $br->mata_kuliah;
                                                        $kelass = $br->kelas;
                                                        $statuss = $br->status;

                                                        $satu = "Dosen : $dosenn";
                                                        $dua = "Mata Kuliah : $matkull";
                                                        $tiga = "Kelas : $kelass";
                                                        $empat = "Status : $statuss";
                                                        $b = "
$satu 
$dua  
$tiga 
$empat";
                                                        if ($br->s_verifikasi == "belum verifikasi") {
                                                            $bg5 = "warning";
                                                            $disab5 = "disabled";
                                                            $title5 = $b;
                                                        } else if ($br->s_verifikasi == "sudah verifikasi") {
                                                            $bg5 = "warning";
                                                            $disab5 = "disabled";
                                                            $title5 = $b;
                                                        }
                                                    }
                                                } else {
                                                    $bg5 = "success";
                                                    $disab5 = "enabled";
                                                    $title5 = "Kosong";
                                                }
                                            }
                                        }

                                        foreach ($jadwal as $s) {
                                            $id_dosen = $s->nama_dosen;
                                            $id_matkul = $s->mata_kuliah;
                                            $id_kelas = $s->kelas;
                                            $gab = "
Dosen : $id_dosen
Mata Kuliah : $id_matkul
Kelas : $id_kelas";

                                            $this->db->select('*');
                                            $this->db->from('jadwal');
                                            $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=jadwal.id_tahun_akademik');
                                            $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
                                            $this->db->where('id_ruang =', $id_ruang);
                                            $this->db->where('hari =', date('l'));
                                            $this->db->where('dari =', "18:30:00");
                                            $this->db->where('status =', "normal");
                                            $cek = $this->db->get();
                                            if ($cek->num_rows() > 0) {
                                                $bg6 = "danger";
                                                $disab6 = "disabled";
                                                $title6 = $gab;
                                            } else {
                                                $this->db->select('*');
                                                $this->db->from('b_ruang');
                                                $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
                                                $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
                                                $this->db->where('id_ruang =', $id_ruang);
                                                $this->db->where('hari =', date('l'));
                                                $this->db->where('tgl_pakai =', date('Y-m-d'));
                                                $this->db->where('dari_pukul =', "18:30:00");
                                                $this->db->where('s_verifikasi !=', 'ditolak');
                                                $cek = $this->db->get();
                                                if ($cek->num_rows() > 0) {
                                                    foreach ($b_ruang as $br) {
                                                        $dosenn = $br->nama_dosen;
                                                        $matkull = $br->mata_kuliah;
                                                        $kelass = $br->kelas;
                                                        $statuss = $br->status;

                                                        $satu = "Dosen : $dosenn";
                                                        $dua = "Mata Kuliah : $matkull";
                                                        $tiga = "Kelas : $kelass";
                                                        $empat = "Status : $statuss";
                                                        $b = "
$satu 
$dua  
$tiga 
$empat";
                                                        if ($br->s_verifikasi == "belum verifikasi") {
                                                            $bg6 = "warning";
                                                            $disab6 = "disabled";
                                                            $title6 = $b;
                                                        } else if ($br->s_verifikasi == "sudah verifikasi") {
                                                            $bg6 = "warning";
                                                            $disab6 = "disabled";
                                                            $title6 = $b;
                                                        }
                                                    }
                                                } else {
                                                    $bg6 = "success";
                                                    $disab6 = "enabled";
                                                    $title6 = "Kosong";
                                                }
                                            }
                                        }
                                    ?>
                                        <tr>
                                                                                        <td class="text-center">
                                                <button type="button" onclick="return pesan(`<?= $r->id_ruang ?>`)" value="<?= $r->id_ruang ?>" title="<?= $title1 ?>" class="btn btn-<?= $bg1 ?> btn-sm mr-4" <?php
                                                                                                                                                                                                                if ($bg1 == "danger") {
                                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                                } elseif ($bg1 == "warning") {
                                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                                }
                                                                                                                                                                                                                ?> style="height: 100px; width: 100px; font-size: 18px; font-weight: bold;"><?= $r->ruang ?></button>
                                                <button type="button" class="btn btn-<?= $bg1 ?> btn-sm mr-4 disabled" style="height: 100px; width: 100px; font-size: 18px; font-weight: bold;" <?php
                                                                                                                                                                                                if ($bg1 != "danger") {
                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>><?= $r->ruang ?></button>
                                                <button type="button" class="btn btn-<?= $bg1 ?> btn-sm mr-4 disabled" style="height: 100px; width: 100px; font-size: 18px; font-weight: bold;" <?php
                                                                                                                                                                                                if ($bg1 != "warning") {
                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>><?= $r->ruang ?></button>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" onclick="return pesan2(`<?= $r->id_ruang ?>`)" value="<?= $r->id_ruang ?>" title="<?= $title2 ?>" class="btn btn-<?= $bg2 ?> btn-sm mr-4 <?= $disab2 ?>" <?php
                                                                                                                                                                                                                                if ($bg2 == "danger") {
                                                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                                                } elseif ($bg2 == "warning") {
                                                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                ?> style="height: 100px; width: 100px; font-size: 18px; font-weight: bold;"><?= $r->ruang ?></button>
                                                <button type="button" class="btn btn-<?= $bg2 ?> btn-sm mr-4 disabled" style="height: 100px; width: 100px; font-size: 18px; font-weight: bold;" <?php
                                                                                                                                                                                                if ($bg2 != "danger") {
                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>><?= $r->ruang ?></button>
                                                <button type="button" class="btn btn-<?= $bg2 ?> btn-sm mr-4 disabled" style="height: 100px; width: 100px; font-size: 18px; font-weight: bold;" <?php
                                                                                                                                                                                                if ($bg2 != "warning") {
                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>><?= $r->ruang ?></button>

                                            </td>
                                            <td class="text-center">
                                                <button type="button" onclick="return pesan3(`<?= $r->id_ruang ?>`)" value="<?= $r->id_ruang ?>" title="<?= $title3 ?>" class="btn btn-<?= $bg3 ?> btn-sm mr-4 <?= $disab3 ?>" <?php
                                                                                                                                                                                                                                if ($bg3 == "danger") {
                                                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                                                } elseif ($bg3 == "warning") {
                                                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                ?> style="height: 100px; width: 100px; font-size: 18px; font-weight: bold;"><?= $r->ruang ?></button>
                                                <button type="button" class="btn btn-<?= $bg3 ?> btn-sm mr-4 disabled" style="height: 100px; width: 100px; font-size: 18px; font-weight: bold;" <?php
                                                                                                                                                                                                if ($bg3 != "danger") {
                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>><?= $r->ruang ?></button>
                                                <button type="button" class="btn btn-<?= $bg3 ?> btn-sm mr-4 disabled" style="height: 100px; width: 100px; font-size: 18px; font-weight: bold;" <?php
                                                                                                                                                                                                if ($bg3 != "warning") {
                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>><?= $r->ruang ?></button>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" onclick="return pesan4(`<?= $r->id_ruang ?>`)" value="<?= $r->id_ruang ?>" title="<?= $title4 ?>" class="btn btn-<?= $bg4 ?> btn-sm mr-4 <?= $disab4 ?>" <?php
                                                                                                                                                                                                                                if ($bg4 == "danger") {
                                                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                                                } elseif ($bg4 == "warning") {
                                                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                ?> style="height: 100px; width: 100px; font-size: 18px; font-weight: bold;"><?= $r->ruang ?></button>
                                                <button type="button" class="btn btn-<?= $bg4 ?> btn-sm mr-4 disabled" style="height: 100px; width: 100px; font-size: 18px; font-weight: bold;" <?php
                                                                                                                                                                                                if ($bg4 != "danger") {
                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>><?= $r->ruang ?></button>
                                                <button type="button" class="btn btn-<?= $bg4 ?> btn-sm mr-4 disabled" style="height: 100px; width: 100px; font-size: 18px; font-weight: bold;" <?php
                                                                                                                                                                                                if ($bg4 != "warning") {
                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>><?= $r->ruang ?></button>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" onclick="return pesan5(`<?= $r->id_ruang ?>`)" value="<?= $r->id_ruang ?>" title="<?= $title5 ?>" class="btn btn-<?= $bg5 ?> btn-sm mr-4 <?= $disab5 ?>" <?php
                                                                                                                                                                                                                                if ($bg5 == "danger") {
                                                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                                                } elseif ($bg5 == "warning") {
                                                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                ?> style="height: 100px; width: 100px; font-size: 18px; font-weight: bold;"><?= $r->ruang ?></button>
                                                <button type="button" class="btn btn-<?= $bg5 ?> btn-sm mr-4 disabled" style="height: 100px; width: 100px; font-size: 18px; font-weight: bold;" <?php
                                                                                                                                                                                                if ($bg5 != "danger") {
                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>><?= $r->ruang ?></button>
                                                <button type="button" class="btn btn-<?= $bg5 ?> btn-sm mr-4 disabled" style="height: 100px; width: 100px; font-size: 18px; font-weight: bold;" <?php
                                                                                                                                                                                                if ($bg5 != "warning") {
                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>><?= $r->ruang ?></button>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" onclick="return pesan6(`<?= $r->id_ruang ?>`)" value="<?= $r->id_ruang ?>" title="<?= $title6 ?>" class="btn btn-<?= $bg6 ?> btn-sm mr-4 <?= $disab6 ?>" <?php
                                                                                                                                                                                                                                if ($bg6 == "danger") {
                                                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                                                } elseif ($bg6 == "warning") {
                                                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                                                }
                                                                                                                                                                                                                                ?> style="height: 100px; width: 100px; font-size: 18px; font-weight: bold;"><?= $r->ruang ?></button>
                                                <button type="button" class="btn btn-<?= $bg6 ?> btn-sm mr-4 disabled" style="height: 100px; width: 100px; font-size: 18px; font-weight: bold;" <?php
                                                                                                                                                                                                if ($bg6 != "danger") {
                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>><?= $r->ruang ?></button>
                                                <button type="button" class="btn btn-<?= $bg6 ?> btn-sm mr-4 disabled" style="height: 100px; width: 100px; font-size: 18px; font-weight: bold;" <?php
                                                                                                                                                                                                if ($bg6 != "warning") {
                                                                                                                                                                                                    echo "hidden";
                                                                                                                                                                                                }
                                                                                                                                                                                                ?>><?= $r->ruang ?></button>

                                            </td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                    $a = date('l');
                    $day = "";
                    if ($a == 'Monday') {
                        $day = 'Senin';
                    } elseif ($a == 'Tuesday') {
                        $day = 'Selasa';
                    } elseif ($a == 'Wednesday') {
                        $day = 'Rabu';
                    } elseif ($a == 'Thursday') {
                        $day = 'Kamis';
                    } elseif ($a == 'Friday') {
                        $day = 'Jumat';
                    } elseif ($a == 'Saturday') {
                        $day = 'Sabtu';
                    } elseif ($a == 'Sunday') {
                        $day = 'Minggu';
                    }

                    ?>
                    <div class="card">

                        <div class="card-header">
                            <button type="button" class="btn btn-danger btn-sm mr-4" style="height: 50px; width: 50px;"></button> <b>Jadwal Kuliah</b>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example4" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;" class="text-center">No</th>
                                        <th>Mata Kuliah</th>
                                        <th>Dosen</th>
                                        <th>Hari</th>
                                        <th>Kelas</th>
                                        <th>Ruang</th>
                                        <th>Dari</th>
                                        <th>Sampai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($jadwal_hariini as $r) {
                                        if ($r->hari == "Sunday") {
                                            $day = "Minggu";
                                        } else if ($r->hari == "Monday") {
                                            $day = "Senin";
                                        } else if ($r->hari == "Tuesday") {
                                            $day = "Selasa";
                                        } else if ($r->hari == "Wednesday") {
                                            $day = "Rabu";
                                        } else if ($r->hari == "Thursday") {
                                            $day = "Kamis";
                                        } else if ($r->hari == "Friday") {
                                            $day = "Jumat";
                                        } else if ($r->hari == "Saturday") {
                                            $day = "Sabtu";
                                        }
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $r->mata_kuliah ?></td>
                                            <td><?= $r->nama_dosen ?></td>
                                            <td><?= $day ?></td>
                                            <td><?= $r->kelas ?></td>
                                            <td><?= $r->ruang ?></td>
                                            <td><?= date("H:i", strtotime($r->dari)) ?> WIB</td>
                                            <td><?= date("H:i", strtotime($r->sampai)) ?> WIB</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                    </div>

                    <div class="card">

                        <div class="card-header">
                            <button type="button" class="btn btn-warning btn-sm mr-4" style="height: 50px; width: 50px;"></button> <b>Ruang Dipesan</b>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example5" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 20px;" class="text-center">No</th>
                                        <th>Ruang</th>
                                        <th>Kelas</th>
                                        <th>Mata Kuliah</th>
                                        <th>Dosen</th>
                                        <th>Tanggal Pakai</th>
                                        <th>Hari</th>
                                        <th>Mulai Pakai</th>
                                        <th>Selesai Pakai</th>
                                        <th>Sesi</th>
                                        <th>Status</th>
                                        <th>Verifikasi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($pemesanan_hariini as $r) {
                                        if ($r->s_verifikasi == "sudah verifikasi") {
                                            $verifikasi = "Sudah";
                                        } else if ($r->s_verifikasi == "belum verifikasi") {
                                            $verifikasi = "Belum";
                                        } else {
                                            $verifikasi = "Ditolak";
                                        }

                                        $day = "";
                                        if ($r->hari == "Sunday") {
                                            $day = "Minggu";
                                        } else if ($r->hari == "Monday") {
                                            $day = "Senin";
                                        } else if ($r->hari == "Tuesday") {
                                            $day = "Selasa";
                                        } else if ($r->hari == "Wednesday") {
                                            $day = "Rabu";
                                        } else if ($r->hari == "Thursday") {
                                            $day = "Kamis";
                                        } else if ($r->hari == "Friday") {
                                            $day = "Jumat";
                                        } else if ($r->hari == "Saturday") {
                                            $day = "Sabtu";
                                        }
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $r->ruang ?></td>
                                            <td><?= $r->kelas ?></td>
                                            <td><?= $r->mata_kuliah ?></td>
                                            <td><?= $r->nama_dosen ?></td>
                                            <td><?= $r->tgl_pakai ?></td>
                                            <td><?= $day ?></td>
                                            <td><?= date('H:i', strtotime($r->dari_pukul)) ?></td>
                                            <td><?= date('H:i', strtotime($r->sampai_pukul)) ?></td>
                                            <td><?= $r->sesi ?></td>
                                            <td><?= $r->status ?></td>
                                            <td><?= $verifikasi ?></td>

                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->

                    </div>


                    <!-- <button type="button" class="btn btn-danger btn-sm mr-4 disabled" style="height: 50px; width: 50px;"></button> <b>Jadwal Mata Kuliah</b><br><br>
                    <button type="button" class="btn btn-warning btn-sm mr-4 disabled" style="height: 50px; width: 50px;"></button> <b>Ruang Telah dipesan</b><br><br> -->
            </section>
            <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

            <form name="form" action="" method="POST" enctype="multipart/form-data" accept-charset="UTF-8">
                <div id="Modal" class="modal fade" tabindex="-1">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 id="modal-header" class="modal-title"></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-d-none="true" onclick="reloadPage()">&times;</button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id_b_ruang">
                                <span id="modal-body-update-or-create">
                                    <div class="form-group" hidden>
                                        <label>Id Ruang</label>
                                        <input type="text" name="id_ruang" class="form-control" placeholder="Id Ruang">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>Tahun Akademik</label>
                                        <?php
                                        foreach ($tahun_akademik as $t) {
                                        }
                                        ?>
                                        <input type="text" class="form-control" placeholder="Tahun Akademik" value="<?= $t->id_tahun_akademik ?>" name="tahun_akademik">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>Semester</label>
                                        <input type="text" name="semester" class="form-control" placeholder="Semester" value="<?= $t->semester ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Kelas</label>
                                        <select name="id_kelas" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Kelas" required>
                                            <option value="">--PILIH--</option>
                                            <?php foreach ($kelas as $p) { ?>
                                                <option value="<?= $p->id_kelas ?>"><?= $p->kelas ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Lengkap Pengguna</label>
                                        <input type="text" name="nama_pengguna" class="form-control" placeholder="Nama Pengguna" onkeyup="this.value = this.value.toUpperCase()" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="alert alert-primary" role="alert">
                                          Harap Isi Nomor dengan 62, Contoh <b>6281456655077</b>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>No Kontak Pengguna</label>
                                        <input type="number" name="no_hp" class="form-control" placeholder="No WhatsApp Pengguna" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Mata Kuliah</label>
                                        <select name="id_mata_kuliah" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Mata Kuliah" required>
                                            <option value="">--PILIH--</option>
                                            <?php foreach ($matkul as $p) { ?>
                                                <option value="<?= $p->id_mata_kuliah ?>"><?= $p->mata_kuliah ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Dosen</label>
                                        <select name="id_dosen" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Dosen" required>
                                            <option value="">--PILIH--</option>
                                            <?php foreach ($dosen as $p) { ?>
                                                <option value="<?= $p->id_dosen ?>"><?= $p->nama_dosen ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>Tanggal Pakai</label>
                                        <input type="date" name="tgl_pakai" class="form-control" placeholder="Tanggal Pakai" value="<?= $tgl ?>">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>Sesi</label>
                                        <input type="text" name="sesi" class="form-control" placeholder="Sesi">
                                    </div>
                                    <div class="form-group">
                                        <label>Jenis Kegiatan</label>
                                        <select name="status" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Status" required>
                                            <option value="" selected disabled>Pilih Status</option>
                                            <?php
                                            foreach ($jenis_kegiatan as $k) {
                                            ?>
                                                <option value="<?= $k->nama_kegiatan ?>"><?= $k->nama_kegiatan ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!--<div class="form-group">-->
                                    <!--    <label>Status</label>-->
                                    <!--    <select name="status" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Status" required>-->
                                    <!--        <option value="">--PILIH--</option>-->
                                    <!--        <option value="Pergantian">Pergantian</option>-->
                                    <!--        <option value="Kegiatan BEM HIMA dan UKM">Kegiatan BEM HIMA dan UKM</option>-->
                                    <!--        <option value="Kerja Kelompok">Kerja Kelompok</option>-->
                                    <!--        <option value="TSS">TSS</option>-->
                                    <!--        <option value="Open House">Open House</option>-->
                                    <!--        <option value="Reqruitment">Reqruitment</option>-->
                                    <!--        <option value="Ujikom">Ujikom</option>-->
                                    <!--        <option value="PKK">PKK</option>-->
                                    <!--        <option value="TSS">TSS</option>-->
                                    <!--        <option value="Micro Teaching">Micro Teaching</option>-->
                                    <!--        <option value="Kegiatan Prodi">Kegiatan Prodi</option>-->
                                    <!--    </select>-->
                                    <!--</div>-->
                                </span>
                                <span id="modal-body-delete">
                                    Yakin untuk menghapus <b id="name-delete"></b> dari tabel ini?
                                </span>
                                <span id="modal-body-muncul">
                                    Ruangan ini Sedang digunakan
                                </span>
                                <span id="modal-body-ganti">
                                    Ruangan ini Sudah dipesan
                                </span>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-block" id="modal-button" style="color: #fff;">Simpan</button>
                                <button type="button" class="btn btn-block" data-dismiss="modal" id="batal" aria-d-none="true" style="color: #fff;">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            </html>

            <script>
                function pesan(id_ruang, sesi) {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Pesan Ruang');
                    $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-body-update-or-create').removeClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('#modal-body-muncul').addClass('d-none');
                    $('#modal-body-ganti').addClass('d-none');
                    $('[name="id_b_ruangan"]').val();
                    $('[name="id_ruang"]').val(id_ruang);
                    $('[name="id_kelas"]').val();
                    $('[name="id_mata_kuliah"]').val();
                    $('[name="id_dosen"]').val();
                    $('[name="tgl_pakai"]').val();
                    $('[name="sesi"]').val("Sesi 1");
                    $('[name="nama_pengguna"]').val();
                    $('[name="no_hp"]').val();
                    $('[name="status"]').val();
                    $('[name="tahun_akademik"]').val();
                    $('[name="semester"]').val();
                    document.form.action = '<?= base_url('Admin/actadd_b_ruang'); ?>';
                }

                function pesan2(id_ruang, sesi) {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Pesan Ruang');
                    $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-body-update-or-create').removeClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('#modal-body-muncul').addClass('d-none');
                    $('#modal-body-ganti').addClass('d-none');
                    $('[name="id_b_ruangan"]').val();
                    $('[name="id_ruang"]').val(id_ruang);
                    $('[name="id_kelas"]').val();
                    $('[name="id_mata_kuliah"]').val();
                    $('[name="id_dosen"]').val();
                    $('[name="tgl_pakai"]').val();
                    $('[name="sesi"]').val("Sesi 2");
                    $('[name="nama_pengguna"]').val();
                    $('[name="no_hp"]').val();
                    $('[name="status"]').val();
                    $('[name="tahun_akademik"]').val();
                    $('[name="semester"]').val();
                    document.form.action = '<?= base_url('Admin/actadd_b_ruang'); ?>';
                }

                function pesan3(id_ruang, sesi) {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Pesan Ruang');
                    $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-body-update-or-create').removeClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('#modal-body-muncul').addClass('d-none');
                    $('#modal-body-ganti').addClass('d-none');
                    $('[name="id_b_ruangan"]').val();
                    $('[name="id_ruang"]').val(id_ruang);
                    $('[name="id_kelas"]').val();
                    $('[name="id_mata_kuliah"]').val();
                    $('[name="id_dosen"]').val();
                    $('[name="tgl_pakai"]').val();
                    $('[name="sesi"]').val("Sesi 3");
                    $('[name="nama_pengguna"]').val();
                    $('[name="no_hp"]').val();
                    $('[name="status"]').val();
                    $('[name="tahun_akademik"]').val();
                    $('[name="semester"]').val();
                    document.form.action = '<?= base_url('Admin/actadd_b_ruang'); ?>';
                }

                function pesan4(id_ruang, sesi) {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Pesan Ruang');
                    $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-body-update-or-create').removeClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('#modal-body-muncul').addClass('d-none');
                    $('#modal-body-ganti').addClass('d-none');
                    $('[name="id_b_ruangan"]').val();
                    $('[name="id_ruang"]').val(id_ruang);
                    $('[name="id_kelas"]').val();
                    $('[name="id_mata_kuliah"]').val();
                    $('[name="id_dosen"]').val();
                    $('[name="tgl_pakai"]').val();
                    $('[name="sesi"]').val("Sesi 4");
                    $('[name="nama_pengguna"]').val();
                    $('[name="no_hp"]').val();
                    $('[name="status"]').val();
                    $('[name="tahun_akademik"]').val();
                    $('[name="semester"]').val();
                    document.form.action = '<?= base_url('Admin/actadd_b_ruang'); ?>';
                }

                function pesan5(id_ruang, sesi) {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Pesan Ruang');
                    $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-body-update-or-create').removeClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('#modal-body-muncul').addClass('d-none');
                    $('#modal-body-ganti').addClass('d-none');
                    $('[name="id_b_ruangan"]').val();
                    $('[name="id_ruang"]').val(id_ruang);
                    $('[name="id_kelas"]').val();
                    $('[name="id_mata_kuliah"]').val();
                    $('[name="id_dosen"]').val();
                    $('[name="tgl_pakai"]').val();
                    $('[name="sesi"]').val("Sesi 5");
                    $('[name="nama_pengguna"]').val();
                    $('[name="no_hp"]').val();
                    $('[name="status"]').val();
                    $('[name="tahun_akademik"]').val();
                    $('[name="semester"]').val();
                    document.form.action = '<?= base_url('Admin/actadd_b_ruang'); ?>';
                }

                function pesan6(id_ruang, sesi) {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Pesan Ruang');
                    $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-body-update-or-create').removeClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('#modal-body-muncul').addClass('d-none');
                    $('#modal-body-ganti').addClass('d-none');
                    $('[name="id_b_ruangan"]').val();
                    $('[name="id_ruang"]').val(id_ruang);
                    $('[name="id_kelas"]').val();
                    $('[name="id_mata_kuliah"]').val();
                    $('[name="id_dosen"]').val();
                    $('[name="tgl_pakai"]').val();
                    $('[name="sesi"]').val("Sesi 6");
                    $('[name="nama_pengguna"]').val();
                    $('[name="no_hp"]').val();
                    $('[name="status"]').val();
                    $('[name="tahun_akademik"]').val();
                    $('[name="semester"]').val();
                    document.form.action = '<?= base_url('Admin/actadd_b_ruang'); ?>';
                }

                function hapus(id_kelas, kelas) {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Hapus Kelas');
                    $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-body-update-or-create').addClass('d-none');
                    $('#modal-body-delete').removeClass('d-none');
                    $('#modal-body-muncul').addClass('d-none');
                    $('#modal-body-ganti').addClass('d-none');
                    $('[name="id_kelas"]').val(id_kelas);
                    $('#name-delete').html(kelas);
                    document.form.action = '<?= base_url('Admin/acthapus_kelas'); ?>';
                }

                function muncul() {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Keterangan');
                    $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success').hide();
                    $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger').hide();
                    $('#modal-body-update-or-create').addClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('#modal-body-muncul').removeClass('d-none');
                    $('#modal-body-ganti').addClass('d-none');
                    $('[name="id_kelas"]').val(id_kelas);
                    $('#name-delete').html(kelas);
                    // document.form.action = '<?= base_url('Admin/acthapus_kelas'); ?>';
                }

                function ganti() {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Keterangan');
                    $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success').hide();
                    $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger').hide();
                    $('#modal-body-update-or-create').addClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('#modal-body-muncul').addClass('d-none');
                    $('#modal-body-ganti').removeClass('d-none');
                    $('[name="id_kelas"]').val(id_kelas);
                    $('#name-delete').html(kelas);
                    // document.form.action = '<?= base_url('Admin/acthapus_kelas'); ?>';
                }
            </script>
            <script>
                function reloadPage() {
                    location.reload();
                }
            </script>