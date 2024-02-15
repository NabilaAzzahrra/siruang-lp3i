<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'm');
        if (!$this->session->userdata('status_login')) {
			redirect('Auth');
		}
    }

    public function logout()
	{
		$this->session->unset_userdata('status_login');
		$this->session->set_flashdata('logout', TRUE);
		redirect('Auth');
	}

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */

    public function sidebar()
    {
        $data = array(
            'ruang' => "",
            'ruang_dot' => "",
            'kelas' => "",
            'kelas_dot' => "",
            'mata_kuliah' => "",
            'mata_kuliah_dot' => "",
            'jadwal' => "",
            'jadwal_dot' => "",
            'dosen' => "",
            'dosen_dot' => "",
            'v_pemesanan' => "",
            'v_pemesanan_dot' => "",
            'k_pemesanan' => "",
            'k_pemesanan_dot' => "",

            'dashboard' => "close",
            'dashboard_status' => "",
            'data' => "close",
            'data_status' => "",
            'pemesanan' => "close",
            'pemesanan_status' => "",
        );

        // $select = $this->db->select('*');
        // $select = $this->db->where('s_verifikasi', 'belum verifikasi');
        // $data['belum'] = $this->m->Get_All('b_ruang', $select);

        $this->session->set_userdata($data);
    }

    public function index()
    {
        $this->sidebar();
        $data = array(
            'dashboard' => "open",
            'dashboard_status' => " active",
        );
        $this->session->set_userdata($data);

        $data['title'] = 'Dashboard';

        $select = $this->db->select('*');
        $data['read'] = $this->m->Get_All('ruang', $select);

        $select = $this->db->select('*');
        $select = $this->db->join('dosen', 'dosen.id_dosen=jadwal.id_dosen');
        $select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=jadwal.id_matkul');
        $select = $this->db->join('kelas', 'kelas.id_kelas=jadwal.id_kelas');
        $data['jadwal'] = $this->m->Get_All('jadwal', $select);

        $select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
        $select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
        $select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
        $select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
		$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
		$Get = $this->db->query('Select * from tbl_konfigurasi');
		foreach ($Get->result() as $u) {
			if ($u->semester == "Ganjil") {
				$select = $this->db->where('b_ruang.semester', 'Ganjil');
			} else {
				$select = $this->db->where('b_ruang.semester', 'Genap');
			}
		}
        $data['b_ruang'] = $this->m->Get_All('b_ruang', $select);

        $select = $this->db->select('*');
        $idk = $this->session->userdata('username');
        $select = $this->db->join('user', 'user.kelas=kelas.id_kelas');
        $select = $this->db->where('user.username', $this->session->userdata('username'));
        $data['kelas'] = $this->m->Get_All('kelas', $select);

        $data['matkul'] = $this->m->Get_All('mata_kuliah', $select);
        $data['dosen'] = $this->m->Get_All('dosen', $select);

        $select = $this->db->select('*');
        $select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=konfigurasi.id_tahun_akademik');
        $data['tahun_akademik'] = $this->m->Get_All('konfigurasi', $select);

        $GetP = $this->db->query('select* FROM tbl_b_ruang');

        foreach ($GetP->result() as $p) {
            $tanggal = $p->tgl_pakai;
            $this->db->query("UPDATE tbl_b_ruang SET hari = '" . date('l', strtotime($tanggal)) . "' WHERE id_b_ruang = '" . $p->id_b_ruang . "'");
            $sesi = $p->sesi;
            if ($sesi == "Sesi 1") {
                $this->db->query("UPDATE tbl_b_ruang SET dari_pukul = '08:00:00', sampai_pukul = '09:40:00' WHERE id_b_ruang ='" . $p->id_b_ruang . "'");
            } else if ($sesi == "Sesi 2") {
                $this->db->query("UPDATE tbl_b_ruang SET dari_pukul = '09:50:00', sampai_pukul = '11:30:00' WHERE id_b_ruang ='" . $p->id_b_ruang . "'");
            } else if ($sesi == "Sesi 3") {
                $this->db->query("UPDATE tbl_b_ruang SET dari_pukul = '12:30:00', sampai_pukul = '14:10:00' WHERE id_b_ruang ='" . $p->id_b_ruang . "'");
            } else if ($sesi == "Sesi 4") {
                $this->db->query("UPDATE tbl_b_ruang SET dari_pukul = '14:20:00', sampai_pukul = '16:00:00' WHERE id_b_ruang ='" . $p->id_b_ruang . "'");
            } else if ($sesi == "Sesi 5") {
                $this->db->query("UPDATE tbl_b_ruang SET dari_pukul = '16:10:00', sampai_pukul = '17:50:00' WHERE id_b_ruang ='" . $p->id_b_ruang . "'");
            } else if ($sesi == "Sesi 6") {
                $this->db->query("UPDATE tbl_b_ruang SET dari_pukul = '18:30:00', sampai_pukul = '20:10:00' WHERE id_b_ruang ='" . $p->id_b_ruang . "'");
            }
        }

        $data['tgl'] = date('Y-m-d');

        if (count($data['read']) == 0) {
            redirect(base_url('Not_Found'));
        }

        // JADWAL HARI INI //
		$select = $this->db->select('*');
		$select = $this->db->join('dosen', 'dosen.id_dosen=jadwal.id_dosen');
		$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=jadwal.id_matkul');
		$select = $this->db->join('kelas', 'kelas.id_kelas=jadwal.id_kelas');
		$select = $this->db->join('ruang', 'ruang.id_ruang=jadwal.id_ruang');
		$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=jadwal.id_tahun_akademik');
		$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
		$select = $this->db->where('hari', date('l'));
		$data['jadwal_hariini'] = $this->m->Get_All('jadwal', $select);

		// PERGANTIAN HARI INI //
		$select = $this->db->select('*');
		$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
		$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
		$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
		$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
		$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
		$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
		// $select = $this->db->where('b_ruang.hari', date('l'));
		$select = $this->db->where('b_ruang.tgl_pakai', date('Y-m-d'));
		$select = $this->db->order_by('b_ruang.s_verifikasi');
		$data['pemesanan_hariini'] = $this->m->Get_All('b_ruang', $select);
		
		$data['jenis_kegiatan'] = $this->m->Get_All('jenis_kegiatan', $select);

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('user/index');
        $this->load->view('template/footer');
        $this->load->view('template/script');
    }

    public function actadd_b_ruang()
    {
        $data = array(
            'id_b_ruang' => $this->input->post('id_b_ruang'),
            'id_ruang' => $this->input->post('id_ruang'),
            'id_kelas' => $this->input->post('id_kelas'),
            'id_mata_kuliah' => $this->input->post('id_mata_kuliah'),
            'id_dosen' => $this->input->post('id_dosen'),
            'tgl_pakai' => $this->input->post('tgl_pakai'),
            'nama_pengguna' => $this->input->post('nama_pengguna'),
			'no_hp' => $this->input->post('no_hp'),
            'sesi' => $this->input->post('sesi'),
            'status' => $this->input->post('status'),
            'id_tahun_akademik' => $this->input->post('tahun_akademik'),
            'semester' => $this->input->post('semester'),
            'user' => $this->session->userdata('username'),
        );

        $this->m->Save($data, 'b_ruang');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Pesan Ruang Berhasil, Silahkan Konfirmasi ke bagian Pendidikan</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('User/index');
    }

    public function v_pemesanan()
    {
        $sts = "all";
        $ver = "all";

        if (isset($_GET['sts'])) {
            $sts = $_GET['sts'];
        }
        if (isset($_GET['verifikasi'])) {
            $ver = $_GET['verifikasi'];
        }

        $this->sidebar();
        $data = array(
            'pemesanan' => "open",
            'pemesanan_status' => " active",
            'v_pemesanan' => " active",
            'v_pemesanan_dot' => "dot-",
        );
        $this->session->set_userdata($data);

        $data['title'] = 'Pemesanan';
        $idk = $this->session->userdata('username');

        $select = $this->db->select('*');
        $select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
        $select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
        $select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
        $select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
        $select = $this->db->where('kelas.kelas', $idk);
        $select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
        $select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
        $Get = $this->db->query('Select * from tbl_konfigurasi');
        foreach ($Get->result() as $u) {
            if ($u->semester == "Ganjil") {
                $select = $this->db->where('b_ruang.semester', 'Ganjil');
            } else {
                $select = $this->db->where('b_ruang.semester', 'Genap');
            }
        }
        $select = $this->db->order_by('b_ruang.s_verifikasi');
        $data['read'] = $this->m->Get_All('b_ruang', $select);

        $data['kelas'] = $this->m->Get_All('kelas', $select);
        $data['matkul'] = $this->m->Get_All('mata_kuliah', $select);
        $data['dosen'] = $this->m->Get_All('dosen', $select);

        $data['dari'] = date('Y-m-d');
        $data['sampai'] = date('Y-m-d', strtotime($this->input->get('sampai') . ' + 1 days'));

        if (count($data['read']) < 0) {
            redirect(base_url('Not_Found'));
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('user/pemesanan');
        $this->load->view('template/footer');
        $this->load->view('template/script');
    }

    public function actedit_pemesanan()
    {
        $where = array(
            'id_b_ruang' => $this->input->post('id_b_ruang'),
        );

        $data = array(
            'id_kelas' => $this->input->post('id_kelas'),
            'id_mata_kuliah' => $this->input->post('id_mata_kuliah'),
            'id_dosen' => $this->input->post('id_dosen'),
        );

        $this->m->Update($where, $data, 'b_ruang');
        $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Pemesanan berhasil diubah</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('User/v_pemesanan');
    }

    public function acthapus_pemesanan()
    {
        $where = array(
            'id_b_ruang' => $this->input->post('id_b_ruang'),
        );

        $this->m->Delete($where, 'b_ruang');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Pesanan berhasil dibatalkan</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('User/v_pemesanan');
    }

    public function profile()
    {
        $data['title'] = 'Profile';

        $select = $this->db->select('*');
        $select = $this->db->where('username', $this->session->userdata('username'));
        $data['read'] = $this->m->Get_All('user', $select);

        if (count($data['read']) == 0) {
            redirect(base_url('Not_Found'));
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('user/profile');
        $this->load->view('template/footer');
        $this->load->view('template/script');
    }

    public function actedit_profile()
    {
        $where = array(
            'id_user' => $this->input->post('id_user'),
        );

        $data = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'nama' => $this->input->post('nama'),
        );

        $this->m->Update($where, $data, 'user');
        $this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Profile berhasil diubah</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
        redirect('User/profile');
    }

    public function cari()
    {
        $this->sidebar();
        $data = array(
            'dashboard' => "open",
            'dashboard_status' => " active",
        );
        $this->session->set_userdata($data);

        $data['title'] = 'Dashboard';

        $select = $this->db->select('*');
        $data['read'] = $this->m->Get_All('ruang', $select);

        $select = $this->db->select('*');
        $select = $this->db->join('dosen', 'dosen.id_dosen=jadwal.id_dosen');
        $select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=jadwal.id_matkul');
        $select = $this->db->join('kelas', 'kelas.id_kelas=jadwal.id_kelas');
        $data['jadwal'] = $this->m->Get_All('jadwal', $select);

        $select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
        $select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
        $select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
        $data['b_ruang'] = $this->m->Get_All('b_ruang', $select);

        $data['kelas'] = $this->m->Get_All('kelas', $select);
        $data['matkul'] = $this->m->Get_All('mata_kuliah', $select);
        $data['dosen'] = $this->m->Get_All('dosen', $select);

        $select = $this->db->select('*');
        $select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=konfigurasi.id_tahun_akademik');
        $data['tahun_akademik'] = $this->m->Get_All('konfigurasi', $select);
        
         $select = $this->db->select('*');
        $idk = $this->session->userdata('username');
        $select = $this->db->join('user', 'user.kelas=kelas.id_kelas');
        $select = $this->db->where('user.username', $this->session->userdata('username'));
        $data['kelas'] = $this->m->Get_All('kelas', $select);

        // JADWAL HARI INI //
		$select = $this->db->select('*');
		$select = $this->db->join('dosen', 'dosen.id_dosen=jadwal.id_dosen');
		$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=jadwal.id_matkul');
		$select = $this->db->join('kelas', 'kelas.id_kelas=jadwal.id_kelas');
		$select = $this->db->join('ruang', 'ruang.id_ruang=jadwal.id_ruang');
		$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=jadwal.id_tahun_akademik');
		$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
		$select = $this->db->where('hari', date('l', strtotime($_GET['tgl'])));
		$data['jadwal_hariini'] = $this->m->Get_All('jadwal', $select);

		// PERGANTIAN HARI INI //
		$select = $this->db->select('*');
		$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
		$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
		$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
		$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
		$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
		$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
		// $select = $this->db->where('b_ruang.hari', date('l'));
		$select = $this->db->where('b_ruang.tgl_pakai',  $_GET['tgl']);
		$select = $this->db->order_by('b_ruang.s_verifikasi');
		$data['pemesanan_hariini'] = $this->m->Get_All('b_ruang', $select);

        $GetP = $this->db->query('select* FROM tbl_b_ruang');

        foreach ($GetP->result() as $p) {
            $tanggal = $p->tgl_pakai;
            $this->db->query("UPDATE tbl_b_ruang SET hari = '" . date('l', strtotime($tanggal)) . "' WHERE id_b_ruang = '" . $p->id_b_ruang . "'");
            $sesi = $p->sesi;
            if ($sesi == "Sesi 1") {
                $this->db->query("UPDATE tbl_b_ruang SET dari_pukul = '08:00:00', sampai_pukul = '09:40:00' WHERE id_b_ruang ='" . $p->id_b_ruang . "'");
            } else if ($sesi == "Sesi 2") {
                $this->db->query("UPDATE tbl_b_ruang SET dari_pukul = '09:50:00', sampai_pukul = '11:30:00' WHERE id_b_ruang ='" . $p->id_b_ruang . "'");
            } else if ($sesi == "Sesi 3") {
                $this->db->query("UPDATE tbl_b_ruang SET dari_pukul = '12:30:00', sampai_pukul = '14:10:00' WHERE id_b_ruang ='" . $p->id_b_ruang . "'");
            } else if ($sesi == "Sesi 4") {
                $this->db->query("UPDATE tbl_b_ruang SET dari_pukul = '14:20:00', sampai_pukul = '16:00:00' WHERE id_b_ruang ='" . $p->id_b_ruang . "'");
            } else if ($sesi == "Sesi 5") {
                $this->db->query("UPDATE tbl_b_ruang SET dari_pukul = '16:10:00', sampai_pukul = '17:50:00' WHERE id_b_ruang ='" . $p->id_b_ruang . "'");
            } else if ($sesi == "Sesi 6") {
                $this->db->query("UPDATE tbl_b_ruang SET dari_pukul = '18:30:00', sampai_pukul = '20:10:00' WHERE id_b_ruang ='" . $p->id_b_ruang . "'");
            }
        }

        $data['tgl'] = date('Y-m-d');

        if (count($data['read']) == 0) {
            redirect(base_url('Not_Found'));
        }

        $data['jenis_kegiatan'] = $this->m->Get_All('jenis_kegiatan', $select);

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('user/cari');
        $this->load->view('template/footer');
        $this->load->view('template/script');
    }

    public function k_pemesanan()
    {
        $this->sidebar();
        $data = array(
            'k_pemesanan' => "open",
            'k_pemesanan_status' => " active",
        );
        $this->session->set_userdata($data);

        $data['title'] = 'Keterangan Pemesanan';
        $idk = $this->session->userdata('username');

        $select = $this->db->select('*');
        $select = $this->db->join('dosen', 'dosen.id_dosen=jadwal.id_dosen');
        $select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=jadwal.id_matkul');
        $select = $this->db->join('kelas', 'kelas.id_kelas=jadwal.id_kelas');
        $select = $this->db->join('ruang', 'ruang.id_ruang=jadwal.id_ruang');
        $select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=jadwal.id_tahun_akademik');
        $select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
        $Get = $this->db->query('Select * from tbl_konfigurasi');
        foreach ($Get->result() as $u) {
            if ($u->semester == "Ganjil") {
                $select = $this->db->where('jadwal.semester', 'Ganjil');
            } else {
                $select = $this->db->where('jadwal.semester', 'Genap');
            }
        }
        $select = $this->db->where('hari', date('l'));
        $data['read'] = $this->m->Get_All('jadwal', $select);

        $select = $this->db->select('*');
        $select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
        $select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
        $select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
        $select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
        $select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
        $select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
        $Get = $this->db->query('Select * from tbl_konfigurasi');
        foreach ($Get->result() as $u) {
            if ($u->semester == "Ganjil") {
                $select = $this->db->where('b_ruang.semester', 'Ganjil');
            } else {
                $select = $this->db->where('b_ruang.semester', 'Genap');
            }
        }
        $select = $this->db->where('b_ruang.hari', date('l'));
        $select = $this->db->where('b_ruang.tgl_pakai', date('Y-m-d'));
        $select = $this->db->order_by('b_ruang.s_verifikasi');
        $data['pemesanan'] = $this->m->Get_All('b_ruang', $select);

        $data['tahun_akademik'] = $this->m->Get_All('tahun_akademik', $select);

        $select = $this->db->select('*');
        $select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
        $data['ta'] = $this->m->Get_All('tahun_akademik', $select);

        $data['tgl'] = date('Y-m-d');


        if (count($data['read']) < 0) {
            redirect(base_url('Not_Found'));
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('user/k_pemesanan');
        $this->load->view('template/footer');
        $this->load->view('template/script');
    }

    public function cari_kpemesanan()
    {
        $this->sidebar();
        $data = array(
            'k_pemesanan' => "open",
            'k_pemesanan_status' => " active",
        );
        $this->session->set_userdata($data);

        $data['title'] = 'Keterangan Pemesanan';

        $select = $this->db->select('*');
        $select = $this->db->join('dosen', 'dosen.id_dosen=jadwal.id_dosen');
        $select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=jadwal.id_matkul');
        $select = $this->db->join('kelas', 'kelas.id_kelas=jadwal.id_kelas');
        $select = $this->db->join('ruang', 'ruang.id_ruang=jadwal.id_ruang');
        $select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=jadwal.id_tahun_akademik');
        $select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
        $select = $this->db->where('hari', date('l', strtotime($_GET['tgl'])));
        $data['read'] = $this->m->Get_All('jadwal', $select);

        // $select = $this->db->select('*');
        // $select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
        // $select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
        // $select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
        // $select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
        // $select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
        // $select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
        // $select = $this->db->where('b_ruang.hari', date('l', strtotime($_GET['tgl'])));
        // $select = $this->db->where('b_ruang.tgl_pakai', $_GET['tgl']);
        // $select = $this->db->where('b_ruang.s_verifikasi', $_GET['verifikasi']);
        // $select = $this->db->where('b_ruang.id_tahun_akademik', $_GET['thn_ak']);
        // $select = $this->db->order_by('b_ruang.s_verifikasi');
        // $data['pemesanan'] = $this->m->Get_All('b_ruang', $select);

        if ($_GET['verifikasi'] == "all" && $_GET['thn_ak'] == "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
			$select = $this->db->where('b_ruang.hari', date('l', strtotime($_GET['tgl'])));
			$select = $this->db->where('b_ruang.tgl_pakai', $_GET['tgl']);
			// $select = $this->db->where('b_ruang.s_verifikasi', $_GET['verifikasi']);
			// $select = $this->db->where('b_ruang.id_tahun_akademik', $_GET['thn_ak']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['pemesanan'] = $this->m->Get_All('b_ruang', $select);
		} else if ($_GET['verifikasi'] == "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
			$select = $this->db->where('b_ruang.hari', date('l', strtotime($_GET['tgl'])));
			$select = $this->db->where('b_ruang.tgl_pakai', $_GET['tgl']);
			// $select = $this->db->where('b_ruang.s_verifikasi', $_GET['verifikasi']);
			$select = $this->db->where('b_ruang.id_tahun_akademik', $_GET['thn_ak']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['pemesanan'] = $this->m->Get_All('b_ruang', $select);
		} else if ($_GET['thn_ak'] == "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
			$select = $this->db->where('b_ruang.hari', date('l', strtotime($_GET['tgl'])));
			$select = $this->db->where('b_ruang.tgl_pakai', $_GET['tgl']);
			$select = $this->db->where('b_ruang.s_verifikasi', $_GET['verifikasi']);
			// $select = $this->db->where('b_ruang.id_tahun_akademik', $_GET['thn_ak']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['pemesanan'] = $this->m->Get_All('b_ruang', $select);
		} else if ($_GET['verifikasi'] != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
			$select = $this->db->where('b_ruang.hari', date('l', strtotime($_GET['tgl'])));
			$select = $this->db->where('b_ruang.tgl_pakai', $_GET['tgl']);
			$select = $this->db->where('b_ruang.s_verifikasi', $_GET['verifikasi']);
			$select = $this->db->where('b_ruang.id_tahun_akademik', $_GET['thn_ak']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['pemesanan'] = $this->m->Get_All('b_ruang', $select);
		} else if ($_GET['thn_ak'] != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
			$select = $this->db->where('b_ruang.hari', date('l', strtotime($_GET['tgl'])));
			$select = $this->db->where('b_ruang.tgl_pakai', $_GET['tgl']);
			$select = $this->db->where('b_ruang.s_verifikasi', $_GET['verifikasi']);
			$select = $this->db->where('b_ruang.id_tahun_akademik', $_GET['thn_ak']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['pemesanan'] = $this->m->Get_All('b_ruang', $select);
		} else {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
			$select = $this->db->where('b_ruang.hari', date('l', strtotime($_GET['tgl'])));
			$select = $this->db->where('b_ruang.tgl_pakai', $_GET['tgl']);
			// $select = $this->db->where('b_ruang.s_verifikasi', $_GET['verifikasi']);
			// $select = $this->db->where('b_ruang.id_tahun_akademik', $_GET['thn_ak']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['pemesanan'] = $this->m->Get_All('b_ruang', $select);
		}

        $data['tahun_akademik'] = $this->m->Get_All('tahun_akademik', $select);


        $data['tgl'] = date('Y-m-d');


        if (count($data['read']) < 0) {
            redirect(base_url('Not_Found'));
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/navbar', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('user/cari_kpemesanan');
        $this->load->view('template/footer');
        $this->load->view('template/script');
    }
}
