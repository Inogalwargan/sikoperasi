<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Pegawai_model extends CI_Model
{
	
	private $_table= "pegawai";

	public $id_pegawai;
	public $nik;
	public $nama;
	public $alamat;
	public $nohp;

	public function rules()
	{
		return [
			['field' => 'nik',
			'label' => 'nik',
			'rules' => 'required'],

			['field' => 'nama',
			'label' => 'nama',
			'rules' => 'required'],

			['field' => 'alamat',
			'label' => 'alamat',
			'rules' => 'required'],

			['field' => 'nohp',
			'label' => 'nohp',
			'rules' => 'required|numeric|max_length[15]']
		];
	}

	public function getALL(){
		return $this->db->get($this->_table)->result();
	}

	public function getById($id){
		return $this->db->get_where($this->_table, ["id_pegawai" => $id])->row();
	}

	public function save(){
		$post = $this->input->post();
		$this->id_pegawai = uniqid();
		$this->nik = $post["nik"];
		$this->nama = $post["nama"];
		$this->alamat = $post["alamat"];
		$this->nohp = $post["nohp"];
		$this->db->insert($this->_table, $this);
	}

	// public function update(){
	// 	$post = $this->input->post();
	// 	$this->id_pegawai = $post["id"];
	// 	$this->nik = $post["nik"];
	// 	$this->nama = $post["alamat"];
	// 	$this->nohp = $post["nohp"];
	// 	$this->db->update($this->_table, $this, array('id_pegawai' => $post['id']));
	// }

	// public function delete($id){
	// 	return $this->db->delete($this->_table, array('id_pegawai' =>$post['id']));
	// }

	// Fungsi untuk melakukan ubah data siswa berdasarkan NIS siswa
	public function update($id){
		$data = array(
			"nik" => $this->input->post('nik'),
			"nama" => $this->input->post('nama'),
			"alamat" => $this->input->post('alamat'),
			"nohp" => $this->input->post('nohp')
		);

		$this->db->where('id_pegawai', $id);
	    $this->db->update('pegawai', $data); // Untuk mengeksekusi perintah update data
	}

	// Fungsi untuk melakukan menghapus data siswa berdasarkan NIS siswa
	public function delete($id){
		$this->db->where('id_pegawai', $id);
    $this->db->delete('pegawai'); // Untuk mengeksekusi perintah delete data
	}
}


?>