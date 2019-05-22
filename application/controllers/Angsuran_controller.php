<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * author inogalwargan
 */
class Angsuran_controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Anggota_model");
		$this->load->model("Pinjaman_model");
		$this->load->model("Angsuran_model");
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data["angsuran"] = $this->Angsuran_model->getListAngsuran();
		// var_dump($data);
		$this->load->view("angsuran/lihat_angsuran", $data);
	}

	public function detail($id)
	{
		// $data['anggota'] = $this->SimpananWajib_model->detail_simpanan_pokokall();
		$data['simpanan_wajib'] = $this->SimpananWajib_model->detail_simpanan_wajib($id);
		$data['tot'] = $this->SimpananWajib_model->total_simpanan_wajib($id);
		$this->load->view("simpanan_wajib/detail_simpanan_wajib", $data);
	}

	public function list_anggota()
	{
		$data['anggota'] = $this->Anggota_model->getAll();
		$this->load->view("angsuran/angsuran_anggota", $data);
	}

	public function listPinjamanAnggota()
	{
		$data["pinjaman_anggota"] = $this->Angsuran_model->listPinjamanAnggota();
		$this->load->view("angsuran/list_pinjaman_anggota", $data);
	}

	public function add($id)
	{
		$anggota = $this->Anggota_model;
		$angsuran = $this->Angsuran_model;
		$validation = $this->form_validation;
		$validation->set_rules($angsuran->rules());

		if ($validation->run()) {
			$angsuran->save();
			$this->session->set_flashdata('success', 'Tambah Pinjaman Sebesar Rp. ' . $angsuran->jumlah_angsuran . ' Berhasil Disimpan');
			redirect('Angsuran_controller/index');
		}
		$data['angsuran'] = $this->Pinjaman_model->getById($id);
		$this->load->view("angsuran/tambah_angsuran", $data);
	}

	public function edit($id)
	{
		$anggota = $this->Anggota_model; //object model
		$angsuran = $this->Angsuran_model; //object model
		$validation = $this->form_validation; //object validasi
		$validation->set_rules($angsuran->rules()); //terapkan rules di Anggota_model.php

		if ($validation->run()) { //lakukan validasi form
			$angsuran->update($id); // update data
			$this->session->set_flashdata('success', 'Data Pinjaman Sebesar Rp. ' . $angsuran->getById($id)->jumlah_angsuran . ' Berhasil Diubah');
			redirect($_SERVER ['HTTP_REFERER']);

		}
		// $data['anggota'] = $this->Anggota_model->getById($id);

		$data['angsuran'] = $this->Angsuran_model->getById($id);
		$this->load->view('angsuran/edit_angsuran', $data);
	}

	// public function hide($id){
	// 	$this->Anggota_model->update($id);
	// 	$this->session->set_flashdata('success', 'Data Pegawai Berhasil Dihapus');
	// 	redirect('Anggota_controller/index');
	// }

	/**
	 * this function for lhat total angsuran yang telah dibayarkan masing2 anggota
	 */

	public function detailAngsuran($id)
	{
		$data["angsuran_detail"] = $this->Angsuran_model->detail_angsuran($id);
		$this->load->view('angsuran/detail_angsuran', $data);
	}

	public function delete($id)
	{
		$this->Angsuran_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
		$this->session->set_flashdata('success', 'Data Angsuran Berhasil Dihapus');
		redirect($_SERVER['HTTP_REFERER']);
	}
}
