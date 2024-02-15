<!DOCTYPE html>


<body class="A4 landscape">
    <div class="sheet">
        <table class="text-center mt-10 mb-2" align="center">
            <td>
                <pre><img src="https://plb.ac.id/new/wp-content/uploads/2022/01/logo-Politeknik-LP3I.png" width="110px" height="110px"></pre>
            </td>
            <td class="text-center" align="center">
                <h1>Politeknik LP3I Kampus Tasikmalaya</h1>
                <h4 class="text-center">Jalan Ir. H. Juanda KM. 2 No. 106, Panglayungan, Kec. Cipedes, Tasikmalaya, Jawa Barat 46151 Telepon: (0265) 311766</h4>
            </td>
        </table>

        <hr noshade size=4 width="98%">

        <div style="width:100%" align="center">
            <h2>Laporan Pemesanan</h2>
            <h4><?= date('d/m/Y', strtotime($_GET['nm_dari'])); ?> s/d <?= date('d/m/Y', strtotime($_GET['nm_sampai'])); ?><br></h4>
        </div>
        <div>
            <table border="1" cellspacing="0" cellpadding="5" style="margin:auto">
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
                    foreach ($read as $r) {
                        if ($r->s_verifikasi == "sudah verifikasi") {
                            $verifikasi = "Sudah";
                        } else if ($r->s_verifikasi == "belum verifikasi") {
                            $verifikasi = "Belum";
                        } else {
                            $verifikasi = "Ditolak";
                        }
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->ruang ?></td>
                            <td><?= $r->kelas ?></td>
                            <td><?= $r->mata_kuliah ?></td>
                            <td><?= $r->nama_dosen ?></td>
                            <td><?= $r->tgl_pakai ?></td>
                            <td><?= $r->hari ?></td>
                            <td><?= date('H:i', strtotime($r->dari_pukul)) ?></td>
                            <td><?= date('H:i', strtotime($r->sampai_pukul)) ?></td>
                            <td><?= $r->sesi ?></td>
                            <td><?= $r->status ?></td>
                            <td><?= $verifikasi ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table><br>
        </div>
    </div>

</body>
<script>
    window.print();
</script>