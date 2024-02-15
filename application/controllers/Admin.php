<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
			'tahun_akademik' => "",
			'tahun_akademik_dot' => "",
			'konfigurasi' => "",
			'konfigurasi_dot' => "",
			'user' => "",
			'user_dot' => "",
			'jenis_kegiatan' => "",
			'jenis_kegiatan_dot' => "",

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
		$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=jadwal.id_tahun_akademik');
		$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
		$data['jadwal'] = $this->m->Get_All('jadwal', $select);
		// return print_r($data['jadwal']);

		$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
		$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
		$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
		$data['b_ruang'] = $this->m->Get_All('b_ruang', $select);

		$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
		$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
		$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
		$data['br'] = $this->m->Get_All('b_ruang', $select);

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

		if (count($data['read']) < 0) {
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
		$this->load->view('index');
		$this->load->view('template/footer');
		$this->load->view('template/script');
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
		
		$data['jenis_kegiatan'] = $this->m->Get_All('jenis_kegiatan', $select);

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

		if (count($data['read']) < 0) {
			redirect(base_url('Not_Found'));
		}

		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/cari');
		$this->load->view('template/footer');
		$this->load->view('template/script');
	}
	
	public function jenis_kegiatan()
	{
		$this->sidebar();
		$data = array(
			'data' => "open",
			'data_status' => " active",
			'jenis_kegiatan' => " active",
			'jenis_kegiatan_dot' => "dot-",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'Jenis Kegiatan';

		$select = $this->db->select('*');
		$data['read'] = $this->m->Get_All('jenis_kegiatan', $select);

		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/jenis_kegiatan');
		$this->load->view('template/footer');
		$this->load->view('template/script');
	}

	public function actadd_jenis_kegiatan()
	{
		$data = array(
			'id_kegiatan' => $this->input->post('id_kegiatan'),
			'nama_kegiatan' => $this->input->post('nama_kegiatan'),
		);

		$this->m->Save($data, 'jenis_kegiatan');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Jenis Kegiatan Berhasil ditambahkan</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
		redirect('Admin/jenis_kegiatan');
	}

	public function actedit_jenis_kegiatan()
	{
		$where = array(
			'id_kegiatan' => $this->input->post('id_kegiatan'),
		);
		$data = array(
			'nama_kegiatan' => $this->input->post('nama_kegiatan'),
		);

		$this->m->Update($where, $data, 'jenis_kegiatan');
		$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Jenis Kegiatan Berhasil diubah</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
		redirect('Admin/jenis_kegiatan');
	}

	public function acthapus_jenis_kegiatan()
	{
		$where = array(
			'id_kegiatan' => $this->input->post('id_kegiatan'),
		);
		$this->m->Delete($where, 'jenis_kegiatan');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Jenis Kegiatan Berhasil dihapus</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
		redirect('Admin/jenis_kegiatan');
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
			'sesi' => $this->input->post('sesi'),
			'status' => $this->input->post('status'),
			'nama_pengguna' => $this->input->post('nama_pengguna'),
			'no_hp' => $this->input->post('no_hp'),
			'id_tahun_akademik' => $this->input->post('tahun_akademik'),
			'semester' => $this->input->post('semester'),
			's_verifikasi' => 'sudah verifikasi',
		);

		$this->m->Save($data, 'b_ruang');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Pesan Ruang Berhasil</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
		redirect('Admin/index');
	}

	public function ruang()
	{
		$this->sidebar();
		$data = array(
			'data' => "open",
			'data_status' => " active",
			'ruang' => " active",
			'ruang_dot' => "dot-",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'Ruang';

		$select = $this->db->select('*');
		$data['read'] = $this->m->Get_All('ruang', $select);

		if (count($data['read']) < 0) {
			redirect(base_url('Not_Found'));
		}

		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/ruang');
		$this->load->view('template/footer');
		$this->load->view('template/script');
	}

	public function actadd_ruang()
	{
		$data = array(
			'id_ruang' => $this->input->post('id_ruang'),
			'ruang' => $this->input->post('ruang')
		);

		$this->m->Save($data, 'ruang');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data berhasil ditambahkan</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
		redirect('Admin/ruang');
	}

	public function actedit_ruang()
	{
		$where = array(
			'id_ruang' => $this->input->post('id_ruang'),
		);

		$data = array(
			'ruang' => $this->input->post('ruang')
		);

		$this->m->Update($where, $data, 'ruang');
		redirect('Admin/ruang');
	}

	public function acthapus_ruang()
	{
		$where = array(
			'id_ruang' => $this->input->post('id_ruang'),
		);

		$this->m->Delete($where, 'ruang');
		redirect('Admin/ruang');
	}

	public function dosen()
	{
		$this->sidebar();
		$data = array(
			'data' => "open",
			'data_status' => " active",
			'dosen' => " active",
			'dosen_dot' => "dot-",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'Dosen';

		$select = $this->db->select('*');
		$data['read'] = $this->m->Get_All('dosen', $select);

		if (count($data['read']) < 0) {
			redirect(base_url('Not_Found'));
		}

		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/dosen');
		$this->load->view('template/footer');
		$this->load->view('template/script');
	}

	public function actadd_dosen()
	{
		$data = array(
			'id_dosen' => $this->input->post('id_dosen'),
			'nama_dosen' => $this->input->post('nama_dosen')
		);

		$this->m->Save($data, 'dosen');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil ditambahkan</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
		redirect('Admin/dosen');
	}

	public function actedit_dosen()
	{
		$where = array(
			'id_dosen' => $this->input->post('id_dosen'),
		);

		$data = array(
			'nama_dosen' => $this->input->post('nama_dosen')
		);

		$this->m->Update($where, $data, 'dosen');
		$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Data Berhasil diubah</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
		redirect('Admin/dosen');
	}

	public function acthapus_dosen()
	{
		$where = array(
			'id_dosen' => $this->input->post('id_dosen'),
		);

		$this->m->Delete($where, 'dosen');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data Berhasil dihapus</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
		redirect('Admin/dosen');
	}

	public function kelas()
	{
		$this->sidebar();
		$data = array(
			'data' => "open",
			'data_status' => " active",
			'kelas' => " active",
			'kelas_dot' => "dot-",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'Kelas';

		$select = $this->db->select('*');
		$data['read'] = $this->m->Get_All('kelas', $select);

		if (count($data['read']) < 0) {
			redirect(base_url('Not_Found'));
		}

		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/kelas');
		$this->load->view('template/footer');
		$this->load->view('template/script');
	}

	public function actadd_kelas()
	{
		$data = array(
			'id_kelas' => $this->input->post('id_kelas'),
			'kelas' => $this->input->post('kelas'),
			'prodi' => $this->input->post('prodi'),
		);

		$this->m->Save($data, 'kelas');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil ditambahkan</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
		redirect('Admin/kelas');
	}

	public function actedit_kelas()
	{
		$where = array(
			'id_kelas' => $this->input->post('id_kelas'),
		);

		$data = array(
			'kelas' => $this->input->post('kelas'),
			'prodi' => $this->input->post('prodi'),
		);

		$this->m->Update($where, $data, 'kelas');
		$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Data Berhasil diubah</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
		redirect('Admin/kelas');
	}

	public function acthapus_kelas()
	{
		$where = array(
			'id_kelas' => $this->input->post('id_kelas'),
		);

		$this->m->Delete($where, 'kelas');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data Berhasil dihapus</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
		redirect('Admin/kelas');
	}

	public function mata_kuliah()
	{
		$this->sidebar();
		$data = array(
			'data' => "open",
			'data_status' => " active",
			'mata_kuliah' => " active",
			'mata_kuliah_dot' => "dot-",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'Mata Kuliah';

		$select = $this->db->select('*');
		$data['read'] = $this->m->Get_All('mata_kuliah', $select);

		if (count($data['read']) < 0) {
			redirect(base_url('Not_Found'));
		}

		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/mata_kuliah');
		$this->load->view('template/footer');
		$this->load->view('template/script');
	}

	public function actadd_mata_kuliah()
	{
		$data = array(
			'id_mata_kuliah' => $this->input->post('id_mata_kuliah'),
			'mata_kuliah' => $this->input->post('mata_kuliah'),
		);

		$this->m->Save($data, 'mata_kuliah');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil ditambahkan</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
		redirect('Admin/mata_kuliah');
	}

	public function actedit_mata_kuliah()
	{
		$where = array(
			'id_mata_kuliah' => $this->input->post('id_mata_kuliah'),
		);

		$data = array(
			'mata_kuliah' => $this->input->post('mata_kuliah'),
		);

		$this->m->Update($where, $data, 'mata_kuliah');
		$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Data Berhasil diubah</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
		redirect('Admin/mata_kuliah');
	}

	public function acthapus_mata_kuliah()
	{
		$where = array(
			'id_mata_kuliah' => $this->input->post('id_mata_kuliah'),
		);

		$this->m->Delete($where, 'mata_kuliah');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data Berhasil dihapus</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
		redirect('Admin/mata_kuliah');
	}

	public function jadwal()
	{
		$ruang = "All";
		$kelas = "All";
		$hari = "All";
		$ta = "All";

		if (isset($_GET['ruang'])) {
			$ruang = $_GET['ruang'];
		}
		if (isset($_GET['kelas'])) {
			$kelas = $_GET['kelas'];
		}
		if (isset($_GET['hari'])) {
			$hari = $_GET['hari'];
		}
		if (isset($_GET['ta'])) {
			$ta = $_GET['ta'];
		}

		$this->sidebar();
		$data = array(
			'data' => "open",
			'data_status' => " active",
			'jadwal' => " active",
			'jadwal_dot' => "dot-",
		);
		$this->session->set_userdata($data);
		$data['title'] = 'Jadwal';

		$select = $this->db->select('*');
		$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=jadwal.id_matkul');
		$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=jadwal.id_tahun_akademik');
		$select = $this->db->join('dosen', 'dosen.id_dosen=jadwal.id_dosen');
		$select = $this->db->join('kelas', 'kelas.id_kelas=jadwal.id_kelas');
		$select = $this->db->join('ruang', 'ruang.id_ruang=jadwal.id_ruang');
		$data['read'] = $this->m->Get_All('jadwal', $select);

		$select = $this->db->select('*');
		$data['matkul'] = $this->m->Get_All('mata_kuliah', $select);

		$select = $this->db->select('*');
		$data['kelas'] = $this->m->Get_All('kelas', $select);

		$select = $this->db->select('*');
		$data['ruang'] = $this->m->Get_All('ruang', $select);

		$select = $this->db->select('*');
		$data['dosen'] = $this->m->Get_All('dosen', $select);
		
		$select = $this->db->select('*');
		$data['taa'] = $this->m->Get_All('tahun_akademik', $select);

		$select = $this->db->select('*');
		$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=konfigurasi.id_tahun_akademik');
		$data['tahun_akademik'] = $this->m->Get_All('konfigurasi', $select);

		if (count($data['read']) < 0) {
			redirect(base_url('Not_Found'));
		}

		if ($ruang != "All" && $kelas != "All") {
			$select = $this->db->select('*');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=jadwal.id_matkul');
			$select = $this->db->join('dosen', 'dosen.id_dosen=jadwal.id_dosen');
			$select = $this->db->join('kelas', 'kelas.id_kelas=jadwal.id_kelas');
			$select = $this->db->join('ruang', 'ruang.id_ruang=jadwal.id_ruang');
			$select = $this->db->where('ruang.id_ruang', $_GET['ruang']);
			$select = $this->db->where('kelas.id_kelas', $_GET['kelas']);
			$data['read'] = $this->m->Get_All('jadwal', $select);
		}else if ($ruang != "All" && $hari != "All") {
			$select = $this->db->select('*');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=jadwal.id_matkul');
			$select = $this->db->join('dosen', 'dosen.id_dosen=jadwal.id_dosen');
			$select = $this->db->join('kelas', 'kelas.id_kelas=jadwal.id_kelas');
			$select = $this->db->join('ruang', 'ruang.id_ruang=jadwal.id_ruang');
			$select = $this->db->where('ruang.id_ruang', $_GET['ruang']);
			$select = $this->db->where('jadwal.hari', $_GET['hari']);
			$data['read'] = $this->m->Get_All('jadwal', $select);
		}else if ($kelas != "All" && $hari != "All") {
			$select = $this->db->select('*');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=jadwal.id_matkul');
			$select = $this->db->join('dosen', 'dosen.id_dosen=jadwal.id_dosen');
			$select = $this->db->join('kelas', 'kelas.id_kelas=jadwal.id_kelas');
			$select = $this->db->join('ruang', 'ruang.id_ruang=jadwal.id_ruang');
			$select = $this->db->where('kelas.id_kelas', $_GET['kelas']);
			$select = $this->db->where('jadwal.hari', $_GET['hari']);
			$data['read'] = $this->m->Get_All('jadwal', $select);
		}else if ($ruang != "All") {
			$select = $this->db->select('*');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=jadwal.id_matkul');
			$select = $this->db->join('dosen', 'dosen.id_dosen=jadwal.id_dosen');
			$select = $this->db->join('kelas', 'kelas.id_kelas=jadwal.id_kelas');
			$select = $this->db->join('ruang', 'ruang.id_ruang=jadwal.id_ruang');
			$select = $this->db->where('ruang.id_ruang', $_GET['ruang']);
			$data['read'] = $this->m->Get_All('jadwal', $select);
		}else if($kelas != "All"){
			$select = $this->db->select('*');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=jadwal.id_matkul');
			$select = $this->db->join('dosen', 'dosen.id_dosen=jadwal.id_dosen');
			$select = $this->db->join('kelas', 'kelas.id_kelas=jadwal.id_kelas');
			$select = $this->db->join('ruang', 'ruang.id_ruang=jadwal.id_ruang');
			$select = $this->db->where('kelas.id_kelas', $_GET['kelas']);
			$data['read'] = $this->m->Get_All('jadwal', $select);
		}else if($hari != "All"){
			$select = $this->db->select('*');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=jadwal.id_matkul');
			$select = $this->db->join('dosen', 'dosen.id_dosen=jadwal.id_dosen');
			$select = $this->db->join('kelas', 'kelas.id_kelas=jadwal.id_kelas');
			$select = $this->db->join('ruang', 'ruang.id_ruang=jadwal.id_ruang');
			$select = $this->db->where('jadwal.hari', $_GET['hari']);
			$data['read'] = $this->m->Get_All('jadwal', $select);
		}else if($ta != "All"){
			$select = $this->db->select('*');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=jadwal.id_matkul');
			$select = $this->db->join('dosen', 'dosen.id_dosen=jadwal.id_dosen');
			$select = $this->db->join('kelas', 'kelas.id_kelas=jadwal.id_kelas');
			$select = $this->db->join('ruang', 'ruang.id_ruang=jadwal.id_ruang');
			$select = $this->db->where('jadwal.id_tahun_akademik', $_GET['ta']);
			$data['read'] = $this->m->Get_All('jadwal', $select);
		}else {
			$select = $this->db->select('*');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=jadwal.id_matkul');
			$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=jadwal.id_tahun_akademik');
			$select = $this->db->join('dosen', 'dosen.id_dosen=jadwal.id_dosen');
			$select = $this->db->join('kelas', 'kelas.id_kelas=jadwal.id_kelas');
			$select = $this->db->join('ruang', 'ruang.id_ruang=jadwal.id_ruang');
			$data['read'] = $this->m->Get_All('jadwal', $select);
		}


		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/jadwal');
		$this->load->view('template/footer');
		$this->load->view('template/script');
	}

	public function actadd_jadwal()
	{
		$data = array(
			'id_jadwal' => $this->input->post('id_jadwal'),
			'id_matkul' => $this->input->post('id_matkul'),
			'id_dosen' => $this->input->post('id_dosen'),
			'id_kelas' => $this->input->post('id_kelas'),
			'id_ruang' => $this->input->post('id_ruang'),
			'hari' => $this->input->post('hari'),
			'dari' => $this->input->post('dari'),
			'sampai' => $this->input->post('sampai'),
			'id_tahun_akademik' => $this->input->post('tahun_akademik'),
			'semester' => $this->input->post('semester'),
		);

		$this->m->Save($data, 'jadwal');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data Berhasil ditambahkan</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
		redirect('Admin/jadwal');
	}

	public function actedit_jadwal()
	{
		$where = array(
			'id_jadwal' => $this->input->post('id_jadwal'),
		);

		$data = array(
			'id_matkul' => $this->input->post('id_matkul'),
			'id_dosen' => $this->input->post('id_dosen'),
			'id_kelas' => $this->input->post('id_kelas'),
			'id_ruang' => $this->input->post('id_ruang'),
			'hari' => $this->input->post('hari'),
			'dari' => $this->input->post('dari'),
			'sampai' => $this->input->post('sampai'),
			// 'id_tahun_akademik' => $this->input->post('id_tahun_akademik'),
			// 'semester' => $this->input->post('semester'),
		);

		$this->m->Update($where, $data, 'jadwal');
		$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Data Berhasil diubah</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
		redirect('Admin/jadwal');
	}

	public function acthapus_jadwal()
	{
		$where = array(
			'id_jadwal' => $this->input->post('id_jadwal'),
		);

		$this->m->Delete($where, 'jadwal');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data Berhasil dihapus</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
		redirect('Admin/jadwal');
	}

	public function pergantian()
	{
		$where = array(
			'id_jadwal' => $this->input->post('id_jadwal'),
		);

		$data = array(
			'status' => 'pergantian'
		);

		$this->m->Update($where, $data, 'jadwal');
		redirect('Admin/jadwal');
	}

	public function normalkan()
	{
		$where = array(
			'id_jadwal' => $this->input->post('id_jadwal'),
		);

		$data = array(
			'status' => 'normal'
		);

		$this->m->Update($where, $data, 'jadwal');
		redirect('Admin/jadwal');
	}

	public function v_pemesanan()
	{
		$sts = "all";
		$ver = "all";
		$thn_ak = "all";
		$smt = "all";

		if (isset($_GET['sts'])) {
			$sts = $_GET['sts'];
		}
		if (isset($_GET['verifikasi'])) {
			$ver = $_GET['verifikasi'];
		}
		if (isset($_GET['thn_ak'])) {
			$thn_ak = $_GET['thn_ak'];
		}
		if (isset($_GET['semester'])) {
			$smt = $_GET['semester'];
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
		$select = $this->db->order_by('b_ruang.s_verifikasi');
		$data['read'] = $this->m->Get_All('b_ruang', $select);

		$data['kelas'] = $this->m->Get_All('kelas', $select);
		$data['matkul'] = $this->m->Get_All('mata_kuliah', $select);
		$data['dosen'] = $this->m->Get_All('dosen', $select);
		$data['thn_ak'] = $this->m->Get_All('tahun_akademik', $select);
		
		$data['dari'] = date('Y-m-d');
		$data['sampai'] = date('Y-m-d', strtotime($this->input->get('sampai') . ' + 1 days'));

		if ($sts != "all" && $ver != "all" && $thn_ak != "all" && $smt != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
			$select = $this->db->where('status', $_GET['sts']);
			$select = $this->db->where('s_verifikasi', $_GET['verifikasi']);
			$select = $this->db->where('tahun_akademik.id_tahun_akademik', $_GET['thn_ak']);
			$select = $this->db->where('b_ruang.semester', $_GET['semester']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($sts != "all" && $ver != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
			$select = $this->db->where('status', $_GET['sts']);
			$select = $this->db->where('s_verifikasi', $_GET['verifikasi']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($sts != "all" && $thn_ak != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->where('status', $_GET['sts']);
			$select = $this->db->where('tahun_akademik.id_tahun_akademik', $_GET['thn_ak']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($ver != "all" && $thn_ak != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->where('s_verifikasi', $_GET['verifikasi']);
			$select = $this->db->where('tahun_akademik.id_tahun_akademik', $_GET['thn_ak']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($ver != "all" && $smt != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->where('s_verifikasi', $_GET['verifikasi']);
			$select = $this->db->where('b_ruang.semester', $_GET['semester']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($thn_ak != "all" && $smt != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->where('tahun_akademik.id_tahun_akademik', $_GET['thn_ak']);
			$select = $this->db->where('b_ruang.semester', $_GET['semester']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($sts != "all" && $smt != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->where('status', $_GET['sts']);
			$select = $this->db->where('b_ruang.semester', $_GET['semester']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($sts != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
			$select = $this->db->where('status', $_GET['sts']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($ver != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
			$select = $this->db->where('s_verifikasi', $_GET['verifikasi']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($thn_ak != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->where('tahun_akademik.id_tahun_akademik', $_GET['thn_ak']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($smt != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->where('b_ruang.semester', $_GET['semester']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($sts == "all" && $ver == "all" && $thn_ak == "all") {
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

			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		}
		
		$data['jenis_kegiatan'] = $this->m->Get_All('jenis_kegiatan', $select);

		// if (count($data['read']) < 0) {
		// 	redirect(base_url('Not_Found'));
		// }

		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/pemesanan');
		$this->load->view('template/footer');
		$this->load->view('template/script');
	}

	public function print()
	{
		$sts = "all";
		$ver = "all";
		$thn_ak = "all";
		$smt = "all";

		if (isset($_GET['nm_sts'])) {
			$sts = $_GET['nm_sts'];
		}
		if (isset($_GET['nm_ver'])) {
			$ver = $_GET['nm_ver'];
		}
		if (isset($_GET['nm_thn'])) {
			$thn_ak = $_GET['nm_thn'];
		}
		if (isset($_GET['nm_smt'])) {
			$smt = $_GET['nm_smt'];
		}

		if ($sts != "all" && $ver != "all" && $thn_ak != "all" && $smt != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
			$select = $this->db->where('status', $_GET['nm_sts']);
			$select = $this->db->where('s_verifikasi', $_GET['nm_ver']);
			$select = $this->db->where('tahun_akademik.id_tahun_akademik', $_GET['nm_thn']);
			$select = $this->db->where('b_ruang.semester', $_GET['nm_smt']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('nm_dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['nm_sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($sts != "all" && $ver != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
			$select = $this->db->where('status', $_GET['nm_sts']);
			$select = $this->db->where('s_verifikasi', $_GET['nm_ver']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('nm_dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['nm_sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($sts != "all" && $thn_ak != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->where('status', $_GET['nm_sts']);
			$select = $this->db->where('tahun_akademik.id_tahun_akademik', $_GET['nm_thn']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('nm_dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['nm_sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($ver != "all" && $thn_ak != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->where('s_verifikasi', $_GET['nm_ver']);
			$select = $this->db->where('tahun_akademik.id_tahun_akademik', $_GET['nm_thn']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('nm_dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['nm_sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($ver != "all" && $smt != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->where('s_verifikasi', $_GET['nm_ver']);
			$select = $this->db->where('b_ruang.semester', $_GET['nm_smt']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('nm_dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['nm_sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($thn_ak != "all" && $smt != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->where('tahun_akademik.id_tahun_akademik', $_GET['nm_thn']);
			$select = $this->db->where('b_ruang.semester', $_GET['nm_smt']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('nm_dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['nm_sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($sts != "all" && $smt != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->where('status', $_GET['nm_sts']);
			$select = $this->db->where('b_ruang.semester', $_GET['nm_smt']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('nm_dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['nm_sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($sts != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
			$select = $this->db->where('status', $_GET['nm_sts']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('nm_dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['nm_sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($ver != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
			$select = $this->db->where('s_verifikasi', $_GET['nm_ver']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('nm_dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['nm_sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($thn_ak != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->where('tahun_akademik.id_tahun_akademik', $_GET['nm_thn']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('nm_dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['nm_sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($smt != "all") {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->where('b_ruang.semester', $_GET['nm_smt']);
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('nm_dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['nm_sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else if ($sts == "all" && $ver == "all" && $thn_ak == "all") {
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

			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		} else {
			$select = $this->db->select('*');
			$select = $this->db->join('ruang', 'ruang.id_ruang=b_ruang.id_ruang');
			$select = $this->db->join('kelas', 'kelas.id_kelas=b_ruang.id_kelas');
			$select = $this->db->join('mata_kuliah', 'mata_kuliah.id_mata_kuliah=b_ruang.id_mata_kuliah');
			$select = $this->db->join('dosen', 'dosen.id_dosen=b_ruang.id_dosen');
			$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=b_ruang.id_tahun_akademik');
			$select = $this->db->join('konfigurasi', 'konfigurasi.id_tahun_akademik=tahun_akademik.id_tahun_akademik');
			$select = $this->db->where('b_ruang.tgl_pakai >=', $this->input->get('nm_dari'));
			$select = $this->db->where('b_ruang.tgl_pakai <=', $_GET['nm_sampai']);
			$select = $this->db->order_by('b_ruang.s_verifikasi');
			$data['read'] = $this->m->Get_All('b_ruang', $select);
		}

		if (count($data['read']) < 0) {
			redirect(base_url('Not_Found'));
		}

		$this->load->view('admin/print', $data);
	}

	public function s_verifikasi()
	{
		$where = array(
			'id_b_ruang' => $this->input->post('id_b_ruang'),
		);

		$data = array(
			's_verifikasi' => 'sudah verifikasi'
		);

		$this->m->Update($where, $data, 'b_ruang');
		$this->session->set_flashdata('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert">
            <strong>Data Berhasil diverifikasi</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
		redirect('Admin/v_pemesanan');
	}

	public function tolak()
	{
		$where = array(
			'id_b_ruang' => $this->input->post('id_b_ruang'),
		);

		$data = array(
			's_verifikasi' => 'ditolak'
		);

		$this->m->Update($where, $data, 'b_ruang');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data Berhasil ditolak</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
		redirect('Admin/v_pemesanan');
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
			'status' => $this->input->post('status'),
		);

		$this->m->Update($where, $data, 'b_ruang');
		$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Data Berhasil diubah</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
		redirect('Admin/v_pemesanan');
	}

	public function acthapus_pemesanan()
	{
		$where = array(
			'id_b_ruang' => $this->input->post('id_b_ruang'),
		);

		$this->m->Delete($where, 'b_ruang');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data Berhasil dihapus</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
		redirect('Admin/v_pemesanan');
	}

	public function user()
	{
		$this->sidebar();
		$data = array(
			'data' => "open",
			'data_status' => " active",
			'user' => " active",
			'user_dot' => "dot-",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'User';

		$select = $this->db->select('*');
		$select = $this->db->join('kelas', 'kelas.id_kelas = user.kelas');
		$data['read'] = $this->m->Get_All('user', $select);

		$GetKelas = $this->db->query('SELECT * FROM tbl_kelas');
		foreach ($GetKelas->result() as $p) {
			$this->db->query("UPDATE tbl_user SET kelas = '" . $p->id_kelas . "' WHERE username = '" . $p->kelas . "'");
		}

		$data['kelas'] = $this->m->Get_All('kelas', $select);

		if (count($data['read']) < 0) {
			redirect(base_url('Not_Found'));
		}

		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/user');
		$this->load->view('template/footer');
		$this->load->view('template/script');
	}

	public function actadd_user()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('username', $this->input->post('username'));
		$cek = $this->db->get();
		if ($cek->num_rows() > 0) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Username sudah ada, silahkan ganti yang lain</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
		} else {
			$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'nama' => $this->input->post('nama'),
				'akses' => $this->input->post('akses'),
				'kelas' => $this->input->post('id_kelas'),
			);

			$this->m->Save($data, 'user');
		}
		redirect('Admin/user');
	}

	public function actedit_user()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('username', $this->input->post('username'));
		$cek = $this->db->get();
		if ($cek->num_rows() > 0) {
			$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
		    <strong>Username sudah ada, silahkan ganti yang lain</strong>
		    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		      <span aria-hidden="true">&times;</span>
		    </button>
		  </div>');
		} else {
			$where = array(
				'id_user' => $this->input->post('id_user'),
			);
			$data = array(
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'nama' => $this->input->post('nama'),
				'akses' => $this->input->post('akses'),
				'kelas' => $this->input->post('id_kelas')
			);

			$this->m->Update($where, $data, 'user');
		}

		redirect('Admin/user');
	}

	public function acthapus_user()
	{
		$where = array(
			'username' => $this->input->post('username'),
		);

		$this->m->Delete($where, 'studio');
		redirect('Admin/user');
	}

	public function tahun_akademik()
	{
		$this->sidebar();
		$data = array(
			'data' => "open",
			'data_status' => " active",
			'tahun_akademik' => " active",
			'tahun_akademik_dot' => "dot-",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'Tahun Akademik';

		$select = $this->db->select('*');
		$data['read'] = $this->m->Get_All('tahun_akademik', $select);

		if (count($data['read']) < 0) {
			redirect(base_url('Not_Found'));
		}

		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/tahun_akademik');
		$this->load->view('template/footer');
		$this->load->view('template/script');
	}

	public function actadd_tahun_akademik()
	{
		$data = array(
			'id_tahun_akademik' => $this->input->post('id_tahun_akademik'),
			'tahun_akademik' => $this->input->post('tahun_akademik')
		);

		$this->m->Save($data, 'tahun_akademik');
		$this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data Berhasil ditambahkan</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
		redirect('Admin/tahun_akademik');
	}

	public function actedit_tahun_akademik()
	{
		$where = array(
			'id_tahun_akademik' => $this->input->post('id_tahun_akademik'),
		);

		$data = array(
			'tahun_akademik' => $this->input->post('tahun_akademik')
		);

		$this->m->Update($where, $data, 'tahun_akademik');
		$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Data Berhasil diubah</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
		redirect('Admin/tahun_akademik');
	}

	public function acthapus_tahun_akademik()
	{
		$where = array(
			'id_tahun_akademik' => $this->input->post('id_tahun_akademik'),
		);

		$this->m->Delete($where, 'tahun_akademik');
		$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Data Berhasil dihapus</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
		redirect('Admin/tahun_akademik');
	}

	public function konfigurasi()
	{
		$this->sidebar();
		$data = array(
			'data' => "open",
			'data_status' => " active",
			'konfigurasi' => " active",
			'konfigurasi_dot' => "dot-",
		);
		$this->session->set_userdata($data);

		$data['title'] = 'Konfigurasi';

		$select = $this->db->select('*');
		$select = $this->db->join('tahun_akademik', 'tahun_akademik.id_tahun_akademik=konfigurasi.id_tahun_akademik');
		$data['read'] = $this->m->Get_All('konfigurasi', $select);

		$data['tahun_akademik'] = $this->m->Get_All('tahun_akademik', $select);

		if (count($data['read']) < 0) {
			redirect(base_url('Not_Found'));
		}

		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/konfigurasi');
		$this->load->view('template/footer');
		$this->load->view('template/script');
	}

	public function actedit_konfigurasi(Type $var = null)
	{
		$where = array(
			'id_konfigurasi' => $this->input->post('id_konfigurasi'),
		);

		$data = array(
			'id_tahun_akademik' => $this->input->post('id_tahun_akademik'),
			'semester' => $this->input->post('smt'),
		);

		$this->m->Update($where, $data, 'konfigurasi');
		$this->session->set_flashdata('pesan', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Data Berhasil diubah</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
		redirect('Admin/konfigurasi');
	}

	public function profile()
	{
		$data['title'] = 'Profile';

		$select = $this->db->select('*');
		$select = $this->db->where('username', $this->session->userdata('username'));
		$data['read'] = $this->m->Get_All('user', $select);

		if (count($data['read']) < 0) {
			redirect(base_url('Not_Found'));
		}

		if (count($data['read']) < 0) {
			redirect(base_url('Not_Found'));
		}

		$this->load->view('template/header', $data);
		$this->load->view('template/navbar', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('admin/profile');
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
        <strong>Data Berhasil diubah</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
		redirect('Admin/profile');
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
		$this->load->view('admin/k_pemesanan');
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
		$this->load->view('admin/cari_kpemesanan');
		$this->load->view('template/footer');
		$this->load->view('template/script');
	}
}
