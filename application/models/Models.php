<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Models extends CI_Model
{

    public function get_data($table)
    {
        return $this->db->get($table);
    }

    public function insert_data($data, $table)
    {
        return $this->db->insert($table, $data);
    }

    public function update_data($where, $data, $table)
    {
        return $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }

    public function Get_All($table, $select)
    {
        $select;
        $query = $this->db->get($table);
        return $query->result();
    }

    public function Get_Where($where, $table)
    {
        $query = $this->db->get_where($table, $where);
        return $query->result();
    }
    function Save($data, $table)
    {
        $result = $this->db->insert($table, $data);
        return $result;
        return $this->db->affected_rows();
    }
    function Update($where, $data, $table)
    {
        $this->db->update($table, $data, $where);
        return $this->db->affected_rows();
    }
    function Update_All($data, $table)
    {
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }
    function Delete($where, $table)
    {
        $result = $this->db->delete($table, $where);
        return $result;
    }
    function Delete_All($table)
    {
        $result = $this->db->delete($table);
        return $result;
    }
    public function detail_data($id_perusahaan)
    {
        return $this->db->select('*')->from('perusahaan')->where('id_perusahaan', $id_perusahaan)->get();
    }
    public function Masuk($username, $password)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get();
        $cekuser = $this->db->select('*')->from('user')->where('username', $username)->get();
        $cekpass = $this->db->select('*')->from('user')->where('password', $password)->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } elseif ($cekuser->num_rows() == null) {
            return 'usernotfound';
        } elseif ($cekpass->num_rows() == null) {
            return 'passnotfound';
        } else {
            return false;
        }
    }

    public function ambil_id_film($id)
    {
        $this->db->from('film');
        $this->db->where('id_film', $id);
        $result = $this->db->get('');
        // periksa apakah datanya ada
        if ($result->num_rows() > 0) {
            return $result->row(); //ambil data berdasarkan row id
        }
    }

    public function update_film($id, $data)
    {
        $this->db->where('id_film', $id);
        return $this->db->update('film', $data);
    }

    public function delete_film($id)
    {
        $this->db->where('id_film', $id);
        $this->db->delete('film');
        return TRUE;
    }

    function input_multiple()
    {
        $updates = $this->input->post('jam_tayang');

        foreach ($updates as $update) {
            $data = array(
                'id_film' => date('Ymdhis'),
                'jam_tayang' => $this->input->post('jam_tayang'),
            );
            // $this->db->where('nim', $update);
            $this->db->insert('jam_tayang', $data);
        }
    }

    function input_multiple_jam()
    {
        $updates = $this->input->post('id_film');

        foreach ($updates as $update) {
            $data = array(
                'id_film' => $update,
                'jam_tayang' => $this->input->post('jam_tayang'),
            );
            $this->db->insert('jam_tayang', $data);
        }
    }

    public function save_batch($data)
    {
        return $this->db->insert_batch('jam_tayang', $data);
    }

    public function update_jtayang()
    {
        $updates = $this->input->post('id_film');

        foreach ($updates as $update) {
            $data = array(
                'jam_tayang' => $this->input->post('jam_tayang'),
            );
            $this->db->where('id_film', $update);
            $this->db->update('jam_tayang', $data);
        }
    }

    public function student_list()
    {
        return $this->db->select('s.*, as.id_m_transaksi')
            ->from('m_transaksi as s')
            ->join('dtm_transaksi as as', 'as.id_m_transaksi = s.id_m_transaksi', 'left')
            ->get()
            ->result();
    }
}
