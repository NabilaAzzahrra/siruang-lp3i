<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Models', 'm');
    }
    public function index()
    {
        $this->session->sess_destroy();
        $this->load->view('logs/login');
    }
    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $namepass = $this->input->post('username', 'password');
        $cek = $this->m->Masuk($username, $password, $namepass);
        if ($cek == 'usernotfound') {
            // $this->session->set_flashdata('usernotfound', true);
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size: 12px; align:center;">
                <strong>Username atau Password Salah</strong>
            </div>');
            redirect('Auth');
        } elseif ($cek == 'passnotfound') {
            // $this->session->set_flashdata('passnotfound', true);
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size: 12px; align:center;">
            <strong>Username atau Password Salah</strong>
        </div>');
            redirect('Auth');
        } else {
            foreach ($cek as $d) {
                $username = $d->username;
                $nama = $d->nama;
                $kelas = $d->kelas;
                $akses = $d->akses;
                $status_login = TRUE;
            }
            $data = array(
                'username' => $username,
                'nama' => $nama,
                'kelas' => $kelas,
                'akses' => $akses,
                'status_login' => $status_login,
            );
            $this->session->set_userdata($data);
            if ($akses == 'admin') {
                $this->session->set_flashdata('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert" style="font-size: 12px; align:center;">
                <strong>Selamat Datang</strong>
            </div>');
                redirect('Admin');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert" style="font-size: 12px; align:center;">
                <strong>Selamat Datang</strong>
            </div>');
                redirect('User');
            }
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('status_login');
        // $this->session->set_flashdata('logout', TRUE);
        $this->session->set_flashdata('pesan', '<div class="alert alert-info alert-dismissible fade show" role="alert" style="font-size: 12px; align:center;">
                <strong>Berhasil Keluar dari Sesi Anda</strong>
            </div>');
        redirect('Auth');
    }
}
