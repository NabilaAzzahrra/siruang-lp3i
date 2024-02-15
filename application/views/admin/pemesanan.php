<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <?php echo $this->session->flashdata('pesan'); ?>
        <div class="card">
            <!-- /.card-header -->
            <div class="card-header">
                <div>
                    <form action="<?= base_url('Admin/v_pemesanan') ?>" method="GET">
                        <div class="row">
                            <div class="form-group col-md-2">
                                <select class="form-control" id="sts" name="sts" onchange="bln()" required>
                                    <option value="" selected disabled>Pilih Jenis Kegiatan</option>
                                    <option value="all">All</option>
                                    <?php
                                    foreach ($jenis_kegiatan as $k) {
                                    ?>
                                        <option value="<?= $k->nama_kegiatan ?>"><?= $k->nama_kegiatan ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <!--<div class="form-group col-md-2">-->
                            <!--    <select class="form-control" id="sts" name="sts" onchange="bln()" required>-->
                            <!--        <option value="" selected disabled>Pilih Status</option>-->
                            <!--        <option value="all">All</option>-->
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
                            <div class="form-group col-md-2">
                                <select class="form-control" id="verifikasi" name="verifikasi" onchange="ver()" required>
                                    <option value="" selected disabled>Pilih Verifikasi</option>
                                    <option value="all">All</option>
                                    <option value="sudah verifikasi">Sudah Verifikasi</option>
                                    <option value="belum verifikasi">Belum Verifikasi</option>
                                    <option value="ditolak">Ditolak</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select class="form-control" id="thn_ak" name="thn_ak" onchange="ta()" required>
                                    <option value="" selected disabled>Tahun Akademik</option>
                                    <option value="all">All</option>
                                    <?php
                                    foreach ($thn_ak as $t) {
                                    ?>
                                        <option value="<?= $t->id_tahun_akademik ?>"><?= $t->tahun_akademik ?></option>
                                    <?php  } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-1">
                                <select class="form-control" id="semester" name="semester" onchange="smt()" required>
                                    <option value="" selected disabled>Semester</option>
                                    <option value="all">All</option>
                                    <option value="Ganjil">Ganjil</option>
                                    <option value="Genap">Genap</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <input type="date" name="dari" class="form-control" value="<?= $dari ?>" onclick="dr()">
                            </div>
                            <div class="form-group col-md-2">
                                <input type="date" name="sampai" class="form-control" value="<?= $sampai ?>" onclick="sm()">
                            </div>
                            <div class="form-group col-md-1">
                                <button type="submit" class="btn btn-primary btn-sm" name="form" style="color: #fff;"><i class="fas fa-search"></i> Tampilkan</button> 
                            </div>
                        </div>
                    </form>
                </div>
                <div>
                    <form action="<?= base_url('Admin/print') ?>" target="_blank">
                        <div class="row">

                            <?php
                            if (isset($_GET['form'])) {
                                $_SESSION['eName'] = $_GET['sts'];
                                $_SESSION['eVer'] = $_GET['verifikasi'];
                                $_SESSION['eThn'] = $_GET['thn_ak'];
                                $_SESSION['eSmt'] = $_GET['semester'];
                                $_SESSION['eDari'] = $_GET['dari'];
                                $_SESSION['eSampai'] = $_GET['sampai'];
                            }
                            ?>

                            <div class="form-group col-md-3" hidden>
                                <input type="text" name="nm_sts" class="form-control" value="<?php if (isset($_SESSION['eName'])) {
                                                                                                    echo $_SESSION['eName'];
                                                                                                } ?>">
                            </div>
                            <div class="form-group col-md-3" hidden>
                                <input type="text" name="nm_ver" class="form-control" value="<?php if (isset($_SESSION['eVer'])) {
                                                                                                    echo $_SESSION['eVer'];
                                                                                                } ?>">
                            </div>
                            <div class="form-group col-md-3" hidden>
                                <input type="text" name="nm_thn" class="form-control" value="<?php if (isset($_SESSION['eThn'])) {
                                                                                                    echo $_SESSION['eThn'];
                                                                                                } ?>">
                            </div>
                            <div class="form-group col-md-3" hidden>
                                <input type="text" name="nm_smt" class="form-control" value="<?php if (isset($_SESSION['eSmt'])) {
                                                                                                    echo $_SESSION['eSmt'];
                                                                                                } ?>">
                            </div>
                            <div class="form-group col-md-3" hidden>
                                <input type="date" name="nm_dari" class="form-control" value="<?php if (isset($_SESSION['eDari'])) {
                                                                                                    echo $_SESSION['eDari'];
                                                                                                } ?>">
                            </div>
                            <div class="form-group col-md-3" hidden>
                                <input type="date" name="nm_sampai" class="form-control" value="<?php if (isset($_SESSION['eSampai'])) {
                                                                                                    echo $_SESSION['eSampai'];
                                                                                                } ?>">
                            </div>
                            <div class="form-group col-md-2">
                                <button type="submit" class="btn btn-warning" style="color: #fff;"><i class="fas fa-print"></i> Print</button> 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <table id="example6" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th style="width: 20px;" class="text-center">No</th>
                            <th class="text-center">Nama Pengguna</th>
                            <th class="text-center">No Wa</th>
                            <th class="text-center">Pesan Pukul</th>
                            <th class="text-center">Ruang</th>
                            <th class="text-center">Kelas</th>
                            <th class="text-center">Mata Kuliah</th>
                            <th class="text-center">Dosen</th>
                            <th class="text-center">Tanggal Pakai</th>
                            <th class="text-center">Hari</th>
                            <th class="text-center">Mulai Pakai</th>
                            <th class="text-center">Selesai Pakai</th>
                            <th class="text-center">Sesi</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Verifikasi</th>
                            <th class="text-center">Verifikasi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($read as $r) {
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
                            $tgl_add = $r->tgl_add;
                            $dari = date('H:i', strtotime($r->dari_pukul));
                            $sampai = date('H:i', strtotime($r->sampai_pukul));
                           $pesan = "*SIRUANG | KONFIRMASI PEMESANAN RUANGAN*%0D%0A%0D%0ATanggal Pengajuan = $tgl_add%0D%0ANama Lengkap Pengguna = $r->nama_pengguna
                            %0D%0AKelas = $r->kelas
                            %0D%0AMata Kuliah = $r->mata_kuliah
                            %0D%0ADosen = $r->nama_dosen
                            %0D%0ATanggal Penggunaan Ruang = $r->tgl_pakai
                            %0D%0APukul = $dari - $sampai WIB
                            %0D%0ASesi = $r->sesi
                            %0D%0AJenis Kegiatan = $r->status
                            %0D%0AStatus Verifikasi = *$verifikasi*
                                                        ";

                            
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $r->nama_pengguna ?></td>
                                <td><a href="https://web.whatsapp.com/send?phone='. <?=$r->no_hp?>.'&text=<?=$pesan?>" target="_blank"><?= $r->no_hp ?></a></td>
                                <td><?= $r->tgl_add ?></td>
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
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a class="btn btn-success btn-sm <?php if ($verifikasi == "Sudah") {
                                                                                echo "disabled";
                                                                            } else {
                                                                                echo "enabled";
                                                                            } ?>" onclick="return s_verifikasi(`<?= $r->id_b_ruang ?>`, `<?= $r->mata_kuliah ?>`)" title="verifikasi" href="#">
                                            <i class="fas fa-user-check"></i> Verifikasi
                                        </a>
                                        <a class="btn btn-warning btn-sm" onclick="return tolak(`<?= $r->id_b_ruang ?>`, `<?= $r->mata_kuliah ?>`)" title="tolak" href="#">
                                            <i class="fas fa-user-times"></i> Tolak
                                        </a>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <a class="btn btn-primary btn-sm" onclick="return edit(`<?= $r->id_b_ruang ?>`, `<?= $r->id_kelas ?>`, `<?= $r->id_mata_kuliah ?>`, `<?= $r->id_dosen ?>`, `<?= $r->status ?>`)" title="ubah" href="#">
                                            <i class="fas fa-edit"></i> Ubah
                                        </a>
                                        <a class="btn btn-danger btn-sm" onclick="return hapus(`<?= $r->id_b_ruang ?>`, `<?= $r->mata_kuliah ?>`)" title="hapus" href="#">
                                            <i class="fas fa-trash"></i> Hapus
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Ubah dan Tambah -->
<form name="form" action="" method="post" enctype="multipart/form-data" accept-charset="UTF-8">
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
                        <div class="form-group">
                            <label>Kelas</label>
                            <select name="id_kelas" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Kelas">
                                <option value="">--PILIH--</option>
                                <?php foreach ($kelas as $p) { ?>
                                    <option value="<?= $p->id_kelas ?>"><?= $p->kelas ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mata Kuliah</label>
                            <select name="id_mata_kuliah" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Mata Kuliah">
                                <option value="">--PILIH--</option>
                                <?php foreach ($matkul as $p) { ?>
                                    <option value="<?= $p->id_mata_kuliah ?>"><?= $p->mata_kuliah ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dosen</label>
                            <select name="id_dosen" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Dosen">
                                <option value="">--PILIH--</option>
                                <?php foreach ($dosen as $p) { ?>
                                    <option value="<?= $p->id_dosen ?>"><?= $p->nama_dosen ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kegiatan</label>
                            <select name="status" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Jenis Kegiatan">
                                <option value="">--PILIH--</option>
                                <?php
                                    foreach ($jenis_kegiatan as $k) {
                                    ?>
                                        <option value="<?= $k->nama_kegiatan ?>"><?= $k->nama_kegiatan ?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </span>
                    <span id="modal-body-s_verifikasi">
                        Yakin untuk verifikasi <b id="name-delete"></b> dari tabel ini?
                    </span>
                    <span id="modal-body-delete">
                        Yakin untuk menolak <b id="name-tolak"></b> dari tabel ini?
                    </span>
                    <span id="modal-body-hapus">
                        Yakin untuk menghapus <b id="name-hapus"></b> dari tabel ini?
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
    function s_verifikasi(id_b_ruang, mata_kuliah) {
        $('#Modal').modal('show');
        $('#modal-header').html('Verifikasi Pemesanan');
        $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
        $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
        $('#modal-body-update-or-create').addClass('d-none');
        $('#modal-body-s_verifikasi').removeClass('d-none');
        $('#modal-body-delete').addClass('d-none');
        $('#modal-body-hapus').addClass('d-none');
        $('[name="id_b_ruang"]').val(id_b_ruang);
        $('#name-delete').html(mata_kuliah);
        document.form.action = '<?= base_url('Admin/s_verifikasi'); ?>';
    }

    function tolak(id_b_ruang, mata_kuliah) {
        $('#Modal').modal('show');
        $('#modal-header').html('Tolak Pemesanan');
        $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
        $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
        $('#modal-body-update-or-create').addClass('d-none');
        $('#modal-body-s_verifikasi').addClass('d-none');
        $('#modal-body-delete').removeClass('d-none');
        $('#modal-body-hapus').addClass('d-none');
        $('[name="id_b_ruang"]').val(id_b_ruang);
        $('#name-tolak').html(mata_kuliah);
        document.form.action = '<?= base_url('Admin/tolak'); ?>';
    }

    function edit(id_b_ruang, id_kelas, id_mata_kuliah, id_dosen, status) {
        $('#Modal').modal('show');
        $('#modal-header').html('Ubah Pemesanan');
        $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
        $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
        $('#modal-body-update-or-create').removeClass('d-none');
        $('#modal-body-s_verifikasi').addClass('d-none');
        $('#modal-body-delete').addClass('d-none');
        $('#modal-body-hapus').addClass('d-none');
        $('[name="id_b_ruang"]').val(id_b_ruang);
        $('[name="id_kelas"]').val(id_kelas).trigger('change');
        $('[name="id_mata_kuliah"]').val(id_mata_kuliah).trigger('change');
        $('[name="id_dosen"]').val(id_dosen).trigger('change');
        $('[name="status"]').val(status).trigger('change');
        document.form.action = '<?= base_url('Admin/actedit_pemesanan'); ?>';
    }

    function hapus(id_b_ruang, mata_kuliah) {
        $('#Modal').modal('show');
        $('#modal-header').html('Hapus Pemesanan');
        $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
        $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
        $('#modal-body-update-or-create').addClass('d-none');
        $('#modal-body-s_verifikasi').addClass('d-none');
        $('#modal-body-delete').addClass('d-none');
        $('#modal-body-hapus').removeClass('d-none');
        $('[name="id_b_ruang"]').val(id_b_ruang);
        $('#name-hapus').html(mata_kuliah);
        document.form.action = '<?= base_url('Admin/acthapus_pemesanan'); ?>';
    }
</script>
<script type="text/javascript">
    function bln() {
        var tes = document.getElementById("sts").value;
        document.getElementById("isi_bulan").value = tes;
    }

    function ver() {
        var tes = document.getElementById("verifikasi").value;
        document.getElementById("isi_bulan").value = tes;
    }

    function ta() {
        var tes = document.getElementById("thn_ak").value;
        document.getElementById("isi_bulan").value = tes;
    }

    function smt() {
        var tes = document.getElementById("semester").value;
        document.getElementById("isi_bulan").value = tes;
    }

    function dr() {
        var tes = document.getElementById("dari").value;
        document.getElementById("isi_bulan").value = tes;
    }

    function sm() {
        var tes = document.getElementById("sampai").value;
        document.getElementById("isi_bulan").value = tes;
    }
</script>