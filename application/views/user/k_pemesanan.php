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
                    <div class="card">
                        <div class="card-body">
                            <form action="<?= base_url('User/cari_kpemesanan') ?>" method="GET" enctype="multipart/form-data" accept-charset="UTF-8">
                                <div class="row">
                                    <p class="mb-4 ml-3" style="font-size: 24px;"><strong class="badge badge-success"><?= $day ?>, <?= date('d F Y') ?> </strong></p>
                                    <div class="form-group col-md-2">
                                        <input type="date" name="tgl" class="form-control" placeholder="Tanggal" value="<?= $tgl ?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <select class="form-control" id="verifikasi" name="verifikasi" onchange="ver()" required>
                                            <option value="" selected disabled>Pilih Verifikasi</option>
                                            <option value="all">All</option>
                                            <option value="sudah verifikasi">sudah verifikasi</option>
                                            <option value="belum verifikasi">belum verifikasi</option>
                                            <option value="ditolak">ditolak</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <?php
                                        foreach ($ta as $z) {
                                        }
                                        ?>
                                        <select class="form-control" id="thn_ak" name="thn_ak" onchange="ta()" required>
                                            <option value="<?= $z->id_tahun_akademik ?>"><?= $z->tahun_akademik ?></option>
                                            <hr>
                                            <option value="all">all</option>
                                            <?php
                                            foreach ($tahun_akademik as $t) {
                                            ?>
                                                <option value="<?= $t->id_tahun_akademik ?>"><?= $t->tahun_akademik ?></option>
                                            <?php  } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <button type="submit" class="btn btn-primary" style="color: #fff;"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php echo $this->session->flashdata('pesan'); ?>
                    <div class="card">

                        <div class="card-header">
                            <button type="button" class="btn btn-danger btn-sm mr-4 disabled" style="height: 50px; width: 50px;"></button> <b>Jadwal Mata Kuliah</b>
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
                                    foreach ($read as $r) {
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
                            <button type="button" class="btn btn-warning btn-sm mr-4 disabled" style="height: 50px; width: 50px;"></button> <b>Ruang Telah dipesan</b>
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
                                    foreach ($pemesanan as $r) {
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
                                <input type="hidden" name="id_jadwal">
                                <span id="modal-body-update-or-create">
                                    <div class="form-group" hidden>
                                        <label>Tahun Akademik</label>
                                        <?php
                                        foreach ($tahun_akademik as $t) {
                                        }
                                        ?>
                                        <input type="text" name="tahun_akademik" class="form-control" placeholder="Tahun Akademik" value="<?= $t->id_tahun_akademik ?>">
                                    </div>
                                    <div class="form-group" hidden>
                                        <label>Semester</label>
                                        <input type="text" name="semester" class="form-control" placeholder="Semester" value="<?= $t->semester ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Mata Kuliah</label>
                                        <select name="id_matkul" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Mata Kuliah">
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
                                        <label>Hari</label>
                                        <select name="hari" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Hari">
                                            <option value="">--PILIH--</option>
                                            <option value="Sunday">Minggu</option>
                                            <option value="Monday">Senin</option>
                                            <option value="Tuesday">Selasa</option>
                                            <option value="Wednesday">Rabu</option>
                                            <option value="Thursday">Kamis</option>
                                            <option value="Friday">Jumat</option>
                                            <option value="Saturday">Sabtu</option>
                                        </select>
                                    </div>
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
                                        <label>Ruang</label>
                                        <select name="id_ruang" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Ruang">
                                            <option value="">--PILIH--</option>
                                            <?php foreach ($ruang as $p) { ?>
                                                <option value="<?= $p->id_ruang ?>"><?= $p->ruang ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Dari</label>
                                                <input type="time" name="dari" class="form-control" placeholder="Dari">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Sampai</label>
                                                <input type="time" name="sampai" class="form-control" placeholder="Sampai">
                                            </div>
                                        </div>
                                    </div>
                                </span>
                                <span id="modal-body-delete">
                                    Yakin untuk mengubah status <b id="name-delete"></b> dari tabel ini?
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
                function tambah() {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Tambah Jadwal');
                    $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-body-update-or-create').removeClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('#modal-body-hapus').addClass('d-none');
                    $('[name="id_jadwal"]').val();
                    $('[name="id_matkul"]').val();
                    $('[name="id_kelas"]').val();
                    $('[name="id_ruang"]').val();
                    $('[name="dari"]').val();
                    $('[name="sampai"]').val();
                    $('[name="tahun_akademik"]').val();
                    $('[name="semester"]').val();
                    document.form.action = '<?= base_url('Admin/actadd_jadwal'); ?>';
                }


                function edit(id_jadwal, hari, id_matkul, id_dosen, id_kelas, id_ruang, dari, sampai) {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Ubah Jadwal');
                    $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-body-update-or-create').removeClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('#modal-body-hapus').addClass('d-none');
                    $('[name="id_jadwal"]').val(id_jadwal);
                    $('[name="hari"]').val(hari).trigger('change');
                    $('[name="id_matkul"]').val(id_matkul).trigger('change');
                    $('[name="id_dosen"]').val(id_dosen).trigger('change');
                    $('[name="id_kelas"]').val(id_kelas).trigger('change');
                    $('[name="id_ruang"]').val(id_ruang).trigger('change');
                    $('[name="dari"]').val(dari);
                    $('[name="sampai"]').val(sampai);
                    document.form.action = '<?= base_url('Admin/actedit_jadwal'); ?>';
                }

                function pergantian(id_jadwal, mata_kuliah) {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Pergantian');
                    $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-body-update-or-create').addClass('d-none');
                    $('#modal-body-delete').removeClass('d-none');
                    $('#modal-body-hapus').addClass('d-none');
                    $('[name="id_jadwal"]').val(id_jadwal);
                    $('#name-delete').html(mata_kuliah);
                    document.form.action = '<?= base_url('Admin/pergantian'); ?>';
                }

                function normalkan(id_jadwal, mata_kuliah) {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Pergantian');
                    $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-body-update-or-create').addClass('d-none');
                    $('#modal-body-delete').removeClass('d-none');
                    $('#modal-body-hapus').addClass('d-none');
                    $('[name="id_jadwal"]').val(id_jadwal);
                    $('#name-delete').html(mata_kuliah);
                    document.form.action = '<?= base_url('Admin/normalkan'); ?>';
                }

                function hapus(id_jadwal, mata_kuliah) {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Hapus');
                    $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-body-update-or-create').addClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('#modal-body-hapus').removeClass('d-none');
                    $('[name="id_jadwal"]').val(id_jadwal);
                    $('#name-hapus').html(mata_kuliah);
                    document.form.action = '<?= base_url('Admin/acthapus_jadwal'); ?>';
                }
            </script>