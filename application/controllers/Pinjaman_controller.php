<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* author inogalwargan
*/

class Pinjaman_controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Anggota_model");
        $this->load->model("Pinjaman_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["pinjaman"] = $this->Pinjaman_model->getListPinjaman();
        $this->load->view("pinjaman/lihat_pinjaman", $data);
    }

    public function detail($id){
        // $data['anggota'] = $this->SimpananWajib_model->detail_simpanan_pokokall();
        $data['simpanan_wajib'] = $this->SimpananWajib_model->detail_simpanan_wajib($id);
        $data['tot'] = $this->SimpananWajib_model->total_simpanan_wajib($id);
        $this->load->view("simpanan_wajib/detail_simpanan_wajib", $data);
    }

    public function list_anggota(){
    	$data['anggota'] = $this->Anggota_model->getAll();
        $this->load->view("pinjaman/list_anggota_pinjaman", $data);
    }

    public function add($id)
    {   
        $anggota = $this->Anggota_model;
        $pinjaman = $this->Pinjaman_model;
        $validation = $this->form_validation;
        $validation->set_rules($pinjaman->rules());

        if ($validation->run()) {
            $pinjaman->save();
            $this->session->set_flashdata('success', 'Tambah Pinjaman Sebesar Rp. '.$pinjaman->jumlah_pinjaman.' Berhasil Disimpan');
            redirect('Pinjaman_controller/index');
        }
        $data['anggota'] = $this->Anggota_model->getById($id);
        $this->load->view("pinjaman/tambah_pinjaman", $data);
    }

    public function edit($id){
        $anggota = $this->Anggota_model; //object model
    	$pinjaman = $this->Pinjaman_model; //object model
        $validation = $this->form_validation; //object validasi
        $validation->set_rules($pinjaman->rules()); //terapkan rules di Anggota_model.php

        if ($validation->run()) { //lakukan validasi form
            $pinjaman->update($id); // update data
            $this->session->set_flashdata('success', 'Data Pinjaman Sebesar Rp. '.$pinjaman->getById($id)->jumlah_pinjaman.' Berhasil Diubah');
            redirect($_SERVER ['HTTP_REFERER']);

        }
         // $data['anggota'] = $this->Anggota_model->getById($id);
     
        $data['pinjaman'] = $this->Pinjaman_model->getById($id);
        $this->load->view('pinjaman/edit_pinjaman', $data);
    }

    // public function hide($id){
    // 	$this->Anggota_model->update($id);
    // 	$this->session->set_flashdata('success', 'Data Pegawai Berhasil Dihapus');
    // 	redirect('Anggota_controller/index');
    // }

    public function delete($id){
	    $this->Pinjaman_model->delete($id); // Panggil fungsi delete() yang ada di SiswaModel.php
	    $this->session->set_flashdata('success', 'Data Pinjaman Berhasil Dihapus');
	    redirect($_SERVER['HTTP_REFERER']);
	}
}
