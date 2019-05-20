<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *
 */
class Angsuran_model extends CI_Model
{

	private $_table = "angsuran";

	public $id_pinjaman;
	public $no_angsuran;
	public $jumlah_angsuran;
	public $tanggal;

	public function rules()
	{
		return [
			['field' => 'id_pinjaman',
				'label' => 'id_pinjaman',
				'rules' => 'required'],

			['field' => 'no_angsuran',
				'label' => 'no_angsuran',
				'rules' => 'required'],

			['field' => 'jumlah_angsuran',
				'label' => 'jumlah_angsuran',
				'rules' => 'required|numeric'],

		];
	}

	public function getALL()
	{
		return $this->db->get($this->_table)->result();
	}


	/**
	 * @return mixed
	 */
	public function getListAngsuran()
	{
		$this->db->select('*');
		$this->db->from('anggota');
		$this->db->join('pinjaman', 'anggota.id_anggota = pinjaman.id_anggota');
		$this->db->join('angsuran', 'angsuran.id_pinjaman = pinjaman.id_pinjaman');
		$query = $this->db->get();
		return $query->result();
	}

	public function listPinjamanAnggota()
	{
		$this->db->select('*');
		$this->db->from('anggota');
		$this->db->join('pinjaman', 'anggota.id_anggota = pinjaman.id_anggota');
		$query = $this->db->get();
		return $query->result();
	}

	public function detail_simpanan_wajib($id)
	{
		$this->db->select('*');
		$this->db->from('simpanan_wajib');
		$this->db->join('anggota', 'simpanan_wajib.id_anggota = anggota.id_anggota');
		$this->db->where('anggota.id_anggota', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function total_simpanan_wajib($id)
	{
		$this->db->select_sum('s.jumlah');
		$this->db->from('simpanan_wajib as s');
		$this->db->join('anggota as a', 's.id_anggota = a.id_anggota');
		$this->db->where('a.id_anggota', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function detail_angsuran($id)
	{
		$this->db->select('a.*, p.*, SUM(ag.jumlah_angsuran) as total');
		$this->db->from('anggota as a');
		$this->db->join('pinjaman as p', 'a.id_anggota = p.id_anggota');
		$this->db->join('angsuran as ag', 'p.id_pinjaman = ag.id_pinjaman');
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

	public function getById($id)
	{
		return $this->db->get_where($this->_table, ["id_angsuran" => $id])->row();
	}

	public function save()
	{
		$post = $this->input->post();
		$this->id_angsuran = uniqid();
		$this->id_pinjaman = $post["id_pinjaman"];
		$this->no_angsuran = $post["no_angsuran"];
		$this->jumlah_angsuran = $post["jumlah_angsuran"];
		$this->tanggal = date('y-m-d');
		$this->db->insert($this->_table, $this);
	}

	public function update($id)
	{
		$data = array(
			"id_pinjaman" => $this->input->post('id_pinjaman'),
			"no_angsuran" => $this->input->post('no_angsuran'),
			"jumlah_angsuran" => $this->input->post('jumlah_angsuran'),
			"jumlah_angsuran" => $this->input->post('jumlah_angsuran'),
			"tanggal" => $this->tanggal = date('y-m-d'),
		);

		$this->db->where('id_angsuran', $id);
		$this->db->update('angsuran', $data); // Untuk mengeksekusi perintah update data
	}

	// public function hide($id){
	// 	$this->db->where('id_anggota', $id);
	// 	$this->_table->update('set_aktif == False');

	// }

	// Fungsi untuk melakukan menghapus data siswa berdasarkan NIS siswa
	public function delete($id)
	{
		$this->db->where('id_angsuran', $id);
		$this->db->delete('angsuran'); // Untuk mengeksekusi perintah delete data
	}
}


?>
