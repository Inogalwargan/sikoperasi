<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Pasangan_model extends CI_Model
{
	
	private $_table= "pasangan";

	public $id_anak;
	public $id_anggota;
	public $nama_anak;
	public $jenjang_sekolah;
	public $nama_sekolah;

	public function rules()
	{
		return [
			['field' => 'id_anggota',
			'label' => 'id_anggota',
			'rules' => 'required'],

			['field' => 'nama_pasangan',
			'label' => 'nama_pasangan',
			'rules' => 'required'],

			['field' => 'pekerjaan',
			'label' => 'pekerjaan',
			'rules' => 'required'],

			['field' => 'alamat',
			'label' => 'alamat',
			'rules' => 'required']
		];
	}

	public function getALL(){
		return $this->db->get($this->_table)->result();
	}

	public function getById($id){
		return $this->db->get_where($this->_table, ["id_pasangan" => $id])->row();
	}	

	public function save_batch($data){
		return $this->db->insert_batch('pasangan', $data);
	}

	public function update($id){
		$data = array(
			"id_anggota" => $this->input->post('id_anggota'),
			"nama_pasangan" => $this->input->post('nama_pasangan'),
			"pekerjaan" => $this->input->post('pekerjaan'),
			"alamat" => $this->input->post('alamat')
		);

		$this->db->where('id_pasangan', $id);
	    $this->db->update('pasangan', $data); // Untuk mengeksekusi perintah update data
	}

	// Fungsi untuk melakukan menghapus data siswa berdasarkan NIS siswa
	public function delete($id){
		$this->db->where('id_pasangan', $id);
    	$this->db->delete('pasangan'); // Untuk mengeksekusi perintah delete data
	}
}


?>