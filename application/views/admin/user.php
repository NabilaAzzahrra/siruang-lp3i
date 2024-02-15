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
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Username</th>
                                        <th class="text-center">Password</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Akses</th>
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
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td><?= $r->username ?></td>
                                            <td><?= str_repeat("*", strlen($r->password)); ?></td>
                                            <td><?= $r->nama ?></td>
                                            <td><?= $r->akses ?></td>
                                            <td><?= $r->kelas ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a onclick="return ubah(`<?= $r->id_user ?>`,`<?= $r->username ?>`,`<?= $r->password ?>`,`<?= $r->nama ?>`,`<?= $r->akses ?>`,`<?= $r->id_kelas ?>`)" class="btn btn-success btn-sm" href="#">
                                                        <i class="fas fa-edit"></i> Ubah
                                                    </a>
                                                    <a onclick="return hapus(`<?= $r->username ?>`,`<?= $r->nama ?>`)" class="btn btn-danger btn-sm" href="#">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>

                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
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
                    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 id="modal-header" class="modal-title"></h4>
                                <button type="button" class="close" data-dismiss="modal" aria-d-none="true">&times;</button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="username">
                                <input type="hidden" name="id_user">
                                <span id="modal-body-update-or-create">
                                    <!-- <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" placeholder="Username" value="<?= set_value('username') ?>">
                                    </div> -->
                                    <div class="form-group">
                                        <label>Username</label>
                                        <select name="username" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Username">
                                            <option value="">--PILIH--</option>
                                            <?php foreach ($kelas as $k) {
                                            ?>
                                                <option value="<?= $k->kelas ?>"><?= $k->kelas ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" placeholder="Password" id="myInput" value="<?= set_value('password') ?>">
                                        <input type="checkbox" onclick="myFunction()"> Show Password
                                    </div>
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" placeholder="Nama" value="<?= set_value('nama') ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Akses</label>
                                        <select name="akses" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Akses">
                                            <option value="">--PILIH--</option>
                                            <option value="admin">Admin</option>
                                            <option value="user">User</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Kelas</label>
                                        <select name="id_kelas" class="form-control select2" style="width: 100%;" data-placeholder="Pilih Kelas">
                                            <option value="">--PILIH--</option>
                                            <?php foreach ($kelas as $k) { ?>
                                                <option value="<?= $k->id_kelas ?>"><?= $k->kelas ?></option>
                                            <?php } ?>
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
                function myFunction() {
                    var x = document.getElementById("myInput");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                }

                function tambah() {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Tambah User');
                    $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-body-update-or-create').removeClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('[name="username"]').val();
                    $('[name="password"]').val();
                    $('[name="nama"]').val();
                    $('[name="akses"]').val();
                    $('[name="id_kelas"]').val();
                    document.form.action = '<?= base_url('Admin/actadd_user'); ?>';
                }


                function ubah(id_user, username, password, nama, akses, id_kelas) {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Ubah Kelas');
                    $('#batal').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-button').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-body-update-or-create').removeClass('d-none');
                    $('#modal-body-delete').addClass('d-none');
                    $('[name="id_user"]').val(id_user);
                    $('[name="username"]').val(username);
                    $('[name="password"]').val(password);
                    $('[name="nama"]').val(nama);
                    $('[name="akses"]').val(akses).trigger('change');
                    $('[name="id_kelas"]').val(id_kelas).trigger('change');
                    document.form.action = '<?= base_url('Admin/actedit_user'); ?>';
                }

                function hapus(username, nama) {
                    $('#Modal').modal('show');
                    $('#modal-header').html('Hapus Kelas');
                    $('#batal').removeClass('bg-gradient-danger').addClass('bg-gradient-success');
                    $('#modal-button').removeClass('bg-gradient-success').addClass('bg-gradient-danger');
                    $('#modal-body-update-or-create').addClass('d-none');
                    $('#modal-body-delete').removeClass('d-none');
                    $('[name="username"]').val(username);
                    $('#name-delete').html(nama);
                    document.form.action = '<?= base_url('Admin/acthapus_user'); ?>';
                }
            </script>