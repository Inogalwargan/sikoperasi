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
			'rules' => 'numeric']
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
		$this->name = $post["nik"];
		$this->name = $post["nama"];
		$this->name = $post["alamat"];
		$this->name = $post["nohp"];
		$this->db->insert($this->_table, $this);
	}

	public function update(){
		$post = $this->input->post();
		$this->id_pegawai = $post["id"];
		$this->nik = $post["nik"];
		$this->nama = $post["alamat"];
		$this->nohp = $post["nohp"];
		$this->db->update($this->_table, $this, array('id_pegawai' => $post['id']));
	}

	public function delete($id){
		return $this->db->delete($this->_table, array('id_pegawai' =>$post['id']));
	}
}


?>