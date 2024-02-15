            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <?php echo $this->session->flashdata('pesan'); ?>
                    <div class="card">
                        <div class="card-header">
                            <a class="btn btn-primary btn-sm" onclick="return tambah()" href="#">
                                <i class="fas fa-plus"></i> Tambah
                            </a>
                            <!-- <h3 class="card-title">DataTable with default features</h3> -->
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;" class="text-center">No</th>
                                        <th class="text-center">Prodi</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($read as $r) {
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $r->prodi ?></td>
                                            <td><?= $r->kelas ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a class="btn btn-success btn-sm" onclick="return edit(`<?= $r->id_kelas ?>`,`<?= $r->prodi ?>`,`<?= $r->kelas ?>`)" href="#">
                                                        <i class="fas fa-edit"></i> Ubah
                                                    </a>
                                                    <a class="btn btn-danger btn-sm" onclick="return hapus(`<?= $r->id_kelas ?>`,`<?= $r->kelas ?>`)" href="#">
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
                                <input type="hidden" name="id_kelas">
                                <span id="modal-body-update-or-create">
                                    <div class="form-group">
                                        <label>Prodi</label>
                                        <input type="text" name="prodi" class="form-control" placeholder="Prodi">
                                    </div>
                                    <div class="form-group">
                                        <label>Kelas</label>
                                        <input type="text" name="kelas" class="form-control" placeholder="Kelas">
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
                function tambah() {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Tambah Kelas');
                    $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-body-update-or-create').removeClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('[name="id_kelas"]').val();
                    $('[name="prodi"]').val();
                    $('[name="kelas"]').val();
                    document.form.action = '<?= base_url('Admin/actadd_kelas'); ?>';
                }


                function edit(id_kelas, prodi, kelas) {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Ubah Kelas');
                    $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-body-update-or-create').removeClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('[name="id_kelas"]').val(id_kelas);
                    $('[name="prodi"]').val(prodi);
                    $('[name="kelas"]').val(kelas);
                    document.form.action = '<?= base_url('Admin/actedit_kelas'); ?>';
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