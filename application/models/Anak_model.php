<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* author inogalwargan
*/

class Anak_model extends CI_Model
{
	
	private $_table= "anak";

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

			['field' => 'nama_anak',
			'label' => 'nama_anak',
			'rules' => 'required'],

			['field' => 'jenjang_sekolah',
			'label' => 'jenjang_sekolah',
			'rules' => 'required'],

			['field' => 'nama_sekolah',
			'label' => 'nama_sekolah',
			'rules' => 'required']
		];
	}

	public function getALL(){
		return $this->db->get($this->_table)->result();
	}

	public function getById($id){
		return $this->db->get_where($this->_table, ["id_anak" => $id])->row();
	}

	// public function save(){

	// 	$post = $this->input->post();
	// 	$this->id_anak = uniqid();
	// 	$this->id_anggota = $post["id_anggota"];
	// 	$this->nama_anak = $post["nama_anak"];
	// 	$this->jenjang_sekolah = $post["jenjang_sekolah"];
	// 	$this->nama_sekolah = $post["nama_sekolah"];
	// 	$this->db->insert($this->_table, $this);
	// }
	

	public function save_batch($data){
		return $this->db->insert_batch('anak', $data);
	}

	public function update($id){
		$data = array(
			"id_anggota" => $this->input->post('id_anggota'),
			"nama_anak" => $this->input->post('nama_anak'),
			"jenjang_sekolah" => $this->input->post('jenjang_sekolah'),
			"nama_sekolah" => $this->input->post('nama_sekolah')
		);

		$this->db->where('id_anak', $id);
	    $this->db->update('anak', $data); // Untuk mengeksekusi perintah update data
	}

	public function delete($id){
		$this->db->where('id_anak', $id);
	    $this->db->delete('anak'); // Untuk mengeksekusi perintah delete data
	}
}


?>