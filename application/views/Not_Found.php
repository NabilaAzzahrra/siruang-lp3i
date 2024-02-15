<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Not_Found extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        $data['title'] = 'Error';

        $this->load->view('templates/header', $data);
        //$this->load->view('templates/sidebar');
        $this->load->view('404');
        // $this->load->view('templates/footer');

    }
}
