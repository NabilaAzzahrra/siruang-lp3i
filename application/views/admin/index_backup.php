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
            <div class="card-header">
                <form action="<?= base_url('Admin/cari') ?>" method="GET">
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
                </form>
            </div>
            <div class="card-body">
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
                                    <button type="button" onclick="return pesan(`<?= $r->id_ruang ?>`)" value="<?= $r->id_ruang ?>" title="<?= $title1 ?>" class="btn btn-<?= $bg1 ?> btn-sm mr-4" <?= $disab1 ?> style="height: 100px; width: 100px;"><?= $r->ruang ?></button>
                                </td>
                                <td class="text-center">
                                    <button type="button" onclick="return pesan2(`<?= $r->id_ruang ?>`)" value="<?= $r->id_ruang ?>" title="<?= $title2 ?>" class="btn btn-<?= $bg2 ?> btn-sm mr-4" <?= $disab2 ?> style="height: 100px; width: 100px;"><?= $r->ruang ?></button>
                                </td>
                                <td class="text-center">
                                    <button type="button" onclick="return pesan3(`<?= $r->id_ruang ?>`)" value="<?= $r->id_ruang ?>" title="<?= $title3 ?>" class="btn btn-<?= $bg3 ?> btn-sm mr-4" <?= $disab3 ?> style="height: 100px; width: 100px;"><?= $r->ruang ?></button>
                                </td>
                                <td class="text-center">
                                    <button type="button" onclick="return pesan4(`<?= $r->id_ruang ?>`)" value="<?= $r->id_ruang ?>" title="<?= $title4 ?>" class="btn btn-<?= $bg4 ?> btn-sm mr-4" <?= $disab4 ?> style="height: 100px; width: 100px;"><?= $r->ruang ?></button>
                                </td>
                                <td class="text-center">
                                    <button type="button" onclick="return pesan5(`<?= $r->id_ruang ?>`)" value="<?= $r->id_ruang ?>" title="<?= $title5 ?>" class="btn btn-<?= $bg5 ?> btn-sm mr-4" <?= $disab5 ?> style="height: 100px; width: 100px;"><?= $r->ruang ?></button>
                                </td>
                                <td class="text-center">
                                    <button type="button" onclick="return pesan6(`<?= $r->id_ruang ?>`)" value="<?= $r->id_ruang ?>" title="<?= $title6 ?>" class="btn btn-<?= $bg6 ?> btn-sm mr-4" <?= $disab6 ?> style="height: 100px; width: 100px;"><?= $r->ruang ?></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div><!-- /.container-fluid -->
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
                    <button type="button" class="close" data-dismiss="modal" aria-d-none="true">&times;</button>
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
                            <label>Status</label>
                            <select name="status" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Status" required>
                                <option value="">--PILIH--</option>
                                <option value="Pergantian">Pergantian</option>
                                <option value="Kegiatan BEM HIMA dan UKM">Kegiatan BEM HIMA dan UKM</option>
                                <option value="Kerja Kelompok">Kerja Kelompok</option>
                                <option value="TSS">TSS</option>
                                <option value="Open House">Open House</option>
                                <option value="Reqruitment">Reqruitment</option>
                                <option value="Ujikom">Ujikom</option>
                                <option value="PKK">PKK</option>
                                <option value="TSS">TSS</option>
                                <option value="Micro Teaching">Micro Teaching</option>
                                <option value="Kegiatan Prodi">Kegiatan Prodi</option>
                            </select>
                        </div>
                    </span>
                    <span id="modal-body-delete">
                        Yakin untuk menghapus <b id="name-delete"></b> dari tabel ini?
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
        $('[name="id_b_ruangan"]').val();
        $('[name="id_ruang"]').val(id_ruang);
        $('[name="id_kelas"]').val();
        $('[name="id_mata_kuliah"]').val();
        $('[name="id_dosen"]').val();
        $('[name="tgl_pakai"]').val();
        $('[name="sesi"]').val("Sesi 1");
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
        $('[name="id_b_ruangan"]').val();
        $('[name="id_ruang"]').val(id_ruang);
        $('[name="id_kelas"]').val();
        $('[name="id_mata_kuliah"]').val();
        $('[name="id_dosen"]').val();
        $('[name="tgl_pakai"]').val();
        $('[name="sesi"]').val("Sesi 2");
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
        $('[name="id_b_ruangan"]').val();
        $('[name="id_ruang"]').val(id_ruang);
        $('[name="id_kelas"]').val();
        $('[name="id_mata_kuliah"]').val();
        $('[name="id_dosen"]').val();
        $('[name="tgl_pakai"]').val();
        $('[name="sesi"]').val("Sesi 3");
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
        $('[name="id_b_ruangan"]').val();
        $('[name="id_ruang"]').val(id_ruang);
        $('[name="id_kelas"]').val();
        $('[name="id_mata_kuliah"]').val();
        $('[name="id_dosen"]').val();
        $('[name="tgl_pakai"]').val();
        $('[name="sesi"]').val("Sesi 4");
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
        $('[name="id_b_ruangan"]').val();
        $('[name="id_ruang"]').val(id_ruang);
        $('[name="id_kelas"]').val();
        $('[name="id_mata_kuliah"]').val();
        $('[name="id_dosen"]').val();
        $('[name="tgl_pakai"]').val();
        $('[name="sesi"]').val("Sesi 5");
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
        $('[name="id_b_ruangan"]').val();
        $('[name="id_ruang"]').val(id_ruang);
        $('[name="id_kelas"]').val();
        $('[name="id_mata_kuliah"]').val();
        $('[name="id_dosen"]').val();
        $('[name="tgl_pakai"]').val();
        $('[name="sesi"]').val("Sesi 6");
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
        $('[name="id_kelas"]').val(id_kelas);
        $('#name-delete').html(kelas);
        document.form.action = '<?= base_url('Admin/acthapus_kelas'); ?>';
    }
</script>