<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class SimpananPokok_model extends CI_Model
{
	
	private $_table= "simpanan_pokok";

	public $id_anggota;
	public $jumlah;

	public function rules()
	{
		return [
			['field' => 'id_anggota',
			'label' => 'id_anggota',
			'rules' => 'required'],

			['field' => 'jumlah',
			'label' => 'jumlah',
			'rules' => 'required|numeric']
		];
	}

	public function getALL(){
		return $this->db->get($this->_table)->result();
	}

	public function detail_simpanan_pokok($id){
		$this->db->select('*');
        $this->db->from('simpanan_pokok');
        $this->db->join('anggota', 'simpanan_pokok.id_anggota = anggota.id_anggota');
        $this->db->where('anggota.id_anggota', $id);
        $query = $this->db->get();
        return $query->result();
	}

	public function total_simpanan_pokok($id){
		$this->db->select_sum('s.jumlah');
        $this->db->from('simpanan_pokok as s');
        $this->db->join('anggota as a', 's.id_anggota = a.id_anggota');
        $this->db->where('a.id_anggota', $id);
        $query = $this->db->get();
        return $query->result();
	}

		// public function detail_simpanan_pokokall(){
		// 	$this->db->select('*');
	 //        $this->db->from('simpanan_pokok');
	 //        $this->db->join('anggota', 'simpanan_pokok.id_anggota = anggota.id_anggota');
	 //        // $this->db->where('anggota.id_anggota', $id);
	 //        $query = $this->db->get();
	 //        return $query->result();
		// }

		// public function detail_simpanan_pokok2($id){
		// 	$this->db->select('*');
	 //        $this->db->from('simpanan_pokok');
	 //        $this->db->join('anggota', 'simpanan_pokok.id_anggota = anggota.id_anggota');
	 //        $this->db->where('simpanan_pokok.id_simpanan_pokok', $id);
	 //        $query = $this->db->get();
	 //        return $query->result();
		// }

	public function detail_pasangan($id){
		$this->db->select('*');
        $this->db->from('pasangan');
        $this->db->join('anggota', 'pasangan.id_anggota = anggota.id_anggota');
        $this->db->where('anggota.id_anggota', $id);
        $query = $this->db->get();
        return $query->result();
	}

	public function getById($id){
		return $this->db->get_where($this->_table, ["id_simpanan_pokok" => $id])->row();
	}

	public function save(){
		$post = $this->input->post();
		$this->id_anggota = $post["id_anggota"];
		$this->jumlah = $post["jumlah"];
		$this->db->insert($this->_table, $this);
	}
	
	public function update($id){
		$data = array(
			"id_anggota" => $this->input->post('id_anggota'),
			"jumlah" => $this->input->post('jumlah')
		);

		$this->db->where('id_simpanan_pokok', $id);
	    $this->db->update('simpanan_pokok', $data); // Untuk mengeksekusi perintah update data
	}

	public function hide($id){
		$this->db->where('id_anggota', $id);
		$this->_table->update('set_aktif == False');

	}

	// Fungsi untuk melakukan menghapus data siswa berdasarkan NIS siswa
	public function delete($id){
		$this->db->where('id_simpanan_pokok', $id);
    $this->db->delete('simpanan_pokok'); // Untuk mengeksekusi perintah delete data
	}
}


?>