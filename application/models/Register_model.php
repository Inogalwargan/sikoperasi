<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Register_model extends CI_Model
{
	private $_table= "user";

	public $id_user;
	public $username;
	public $password;
	public $nama;
	public $jenis_kelamin;
	public $nohp;

	public function rules()
	{
		return [
			['field' => 'username',
				'label' => 'username',
				'rules' => 'required|max_length[20]'],

			['field' => 'password',
				'label' => 'password',
				'rules' => 'required|max_length[50]'],

			['field' => 'nama',
				'label' => 'nama',
				'rules' => 'required|max_length[225]'],

			['field' => 'jenis_kelamin',
				'label' => 'jenis_kelamin',
				'rules' => 'required'],

			['field' => 'nohp',
				'label' => 'nohp',
				'rules' => 'required|numeric|max_length[12]'],
		];
	}

	public function getALL()
	{
		return $this->db->get($this->_table)->result();
	}

	public function save(){
		$post = $this->input->post();
		$this->id_user = uniqid();
		$this->username = $post["username"];
		$this->password = $post["password"];
		$this->nama = $post["nama"];
		$this->jenis_kelamin = $post["jenis_kelamin"];
		$this->nohp = $post["nohp"];
		$this->db->insert($this->_table, $this);
	}

}

/* End of file .php */
