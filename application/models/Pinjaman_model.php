<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 
*/
class Pinjaman_model extends CI_Model
{
	
	private $_table= "pinjaman";

	public $id_pinjaman;
	public $id_anggota;
	public $no_pinjaman;
	public $jumlah_pinjaman;
	public $tanggal_peminjaman;
	public $lama;
	public $bunga;

	

	public function rules()
	{
		return [
			['field' => 'id_anggota',
			'label' => 'id_anggota',
			'rules' => 'required'],

			['field' => 'no_pinjaman',
			'label' => 'no_pinjaman',
			'rules' => 'required'],

			['field' => 'jumlah_pinjaman',
			'label' => 'jumlah_pinjaman',
			'rules' => 'required|numeric'],

			['field' => 'lama',
			'label' => 'lama',
			'rules' => 'required|numeric'],

			['field' => 'bunga',
			'label' => 'bunga',
			'rules' => 'required|numeric'],

		];
	}

	public function getALL(){
		return $this->db->get($this->_table)->result();
	}

	public function getListPinjaman(){
		$this->db->select('*');
		$this->db->from('anggota');
		$this->db->join('pinjaman', 'anggota.id_anggota = pinjaman.id_anggota');
		$query = $this->db->get();
		return $query->result();
	}

	public function detail_simpanan_wajib($id){
		$this->db->select('*');
        $this->db->from('simpanan_wajib');
        $this->db->join('anggota', 'simpanan_wajib.id_anggota = anggota.id_anggota');
        $this->db->where('anggota.id_anggota', $id);
        $query = $this->db->get();
        return $query->result();
	}

	public function total_simpanan_wajib($id){
		$this->db->select_sum('s.jumlah');
        $this->db->from('simpanan_wajib as s');
        $this->db->join('anggota as a', 's.id_anggota = a.id_anggota');
        $this->db->where('a.id_anggota', $id);
        $query = $this->db->get();
        return $query->result();
	}

	// public function detail_simpanan_pokokall(){
	// 	$this->db->select('*');
 //        $this->db->from('simpanan_wajib');
 //        $this->db->join('anggota', 'simpanan_wajib.id_anggota = anggota.id_anggota');
 //        // $this->db->where('anggota.id_anggota', $id);
 //        $query = $this->db->get();
 //        return $query->result();
	// }

	// public function detail_simpanan_pokok2($id){
	// 	$this->db->select('*');
 //        $this->db->from('simpanan_wajib');
 //        $this->db->join('anggota', 'simpanan_wajib.id_anggota = anggota.id_anggota');
 //        $this->db->where('simpanan_wajib.id_simpanan_pokok', $id);
 //        $query = $this->db->get();
 //        return $query->result();
	// }

	// public function detail_pasangan($id){
	// 	$this->db->select('*');
 //        $this->db->from('pasangan');
 //        $this->db->join('anggota', 'pasangan.id_anggota = anggota.id_anggota');
 //        $this->db->where('anggota.id_anggota', $id);
 //        $query = $this->db->get();
 //        return $query->result();
	// }

	public function getById($id){
		return $this->db->get_where($this->_table, ["id_pinjaman" => $id])->row();
	}

	public function save(){
		$post = $this->input->post();
		$this->id_pinjaman = uniqid();
		$this->id_anggota = $post["id_anggota"];
		$this->no_pinjaman = $post["no_pinjaman"];
		$this->jumlah_pinjaman = $post["jumlah_pinjaman"];
		$this->tanggal_peminjaman = date('y-m-d');
		$this->lama = $post["lama"];
		$this->bunga = $post["bunga"];
		$this->db->insert($this->_table, $this);
	}
	
	public function update($id){
		$data = array(
			"id_anggota" => $this->input->post('id_anggota'),
			"no_pinjaman" => $this->input->post('no_pinjaman'),
			"jumlah_pinjaman" => $this->input->post('jumlah_pinjaman'),
			"tanggal_peminjaman" => $this->tanggal_dibayar = date('y-m-d'),
			"lama" => $this->input->post('lama'),
			"bunga" => $this->input->post('bunga'),
		);

		$this->db->where('id_pinjaman', $id);
	    $this->db->update('pinjaman', $data); // Untuk mengeksekusi perintah update data
	}

	// public function hide($id){
	// 	$this->db->where('id_anggota', $id);
	// 	$this->_table->update('set_aktif == False');

	// }

	// Fungsi untuk melakukan menghapus data siswa berdasarkan NIS siswa
	public function delete($id){
		$this->db->where('id_pinjaman', $id);
	    $this->db->delete('pinjaman'); // Untuk mengeksekusi perintah delete data
	}
}


?>